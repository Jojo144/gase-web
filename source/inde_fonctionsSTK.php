<?php
require("fonctions_bd_gase.php");

	/*
	 * AC 15-04-2016 nouvelle connexion mysql
	 * AC 02-05-2016 fonction globale requete() + DB_PREFIX
	 */

/* 
 * AC 29-01-2016 
 *  - ajout d'un paramètre $all pour filtrer les non-visibles
 *  - retourne également la colonne VISIBLE
 */
function SelectionListeSTK($all = false)
{
	$compteur = 0;
	
	$sql = "SELECT s1.STOCK, r.DESIGNATION, f.NOM, c.NOM, r.ID_REFERENCE, r.VISIBLE 
	    FROM ".DB_PREFIX."STOCKS s1, ".DB_PREFIX."REFERENCES r, ".DB_PREFIX."FOURNISSEURS f, ".DB_PREFIX."CATEGORIES c 
	    WHERE s1.DATE = (SELECT MAX(s2.DATE) FROM ".DB_PREFIX."STOCKS s2 WHERE s2.ID_REFERENCE=s1.ID_REFERENCE) 
	    AND r.ID_REFERENCE = s1.ID_REFERENCE 
	    AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR 
	    AND c.ID_CATEGORIE = r.ID_CATEGORIE";
	
	if (!$all) $sql .= "	AND r.VISIBLE=1";
	
	$sql .= "	ORDER BY c.NOM, r.DESIGNATION";
	$listeStocks = NULL;
	$result = requete($sql);
	while ( $row = $result->fetch())
	{		
		$donnees['STOCK'] = $row[0];
		$donnees['DESIGNATION'] = $row[1];
		$donnees['NOM'] = $row[2];
		$donnees['CATEGORIE'] = $row[3];
		$donnees['ID_REFERENCE'] = $row[4];
		$donnees['VISIBLE'] = $row[5] == 0 ? 'NON' : 'OUI';
		
		$listeStocks[$compteur] = $donnees;
		$compteur++;
	}
	
	return $listeStocks;
}

function SelectionStocks($idFournisseur)
{
	$result = requete("SELECT r.CODE_FOURNISSEUR, r.ID_REFERENCE, r.DESIGNATION, c.NOM FROM ".DB_PREFIX."REFERENCES r, ".DB_PREFIX."FOURNISSEURS f, ".DB_PREFIX."CATEGORIES c WHERE f.ID_FOURNISSEUR = '$idFournisseur' AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR AND c.ID_CATEGORIE = r.ID_CATEGORIE ORDER BY c.NOM, r.DESIGNATION");
	
	$compteur = 0;
	$listeStocks = array();
	while ( $row = $result->fetch())
	{		
		$donnees['CODE_FOURNISSEUR'] = $row[0];
		$donnees['ID_REFERENCE'] = $row[1];
		$donnees['DESIGNATION'] = $row[2];
		$stock = SelectionStockRefSTK($donnees['ID_REFERENCE']);
		$donnees['STOCK'] = $stock;
		$donnees['CATEGORIE'] = $row[3];
		
		$listeStocks[$compteur] = $donnees;
		$compteur++;
	}
	
	return $listeStocks;
}
	
function SelectionStockRefSTK($idReference)
{
	$result = requete("SELECT STOCK FROM ".DB_PREFIX."STOCKS WHERE ID_REFERENCE='$idReference' AND DATE = (SELECT MAX(DATE) FROM ".DB_PREFIX."STOCKS WHERE ID_REFERENCE='$idReference')");
	$row = $result->fetch();
	$stock = $row["STOCK"];
	
	
	return $stock;
}

function modifierSTK_generic($idReference, $nouveauStock, $quantite, $type, $idAchat='NULL')
{
	$nouveauStock = str_replace(",", ".", $nouveauStock);
	$quantite = str_replace(",", ".", $quantite);
	
	$requete = "INSERT INTO ".DB_PREFIX."STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, QUANTITE, ID_ACHAT) values('$idReference','$nouveauStock', '$type', NOW(), '$quantite', $idAchat)";
	requete($requete);
	
	//remove an entry form raised alert, for $idReference, if stock is above alert limit
	remove_raised_alerts_if_any($idReference);
}

function ModifierSTK($idReference, $quantite)
{
    $nouveauStock = SelectionStockRefSTK($idReference) + $quantite;
	modifierSTK_generic($idReference, $nouveauStock, $quantite, "APPROVISIONNEMENT");
}

function AchatSTK($idAchat, $idReference, $quantite)
{
    $nouveauStock = SelectionStockRefSTK($idReference) - $quantite;
	modifierSTK_generic($idReference, $nouveauStock, $quantite, "ACHAT", $idAchat);
}

function ModifierInventaireSTK($idReference, $quantite)
{
    $nouveauStock = SelectionStockRefSTK($idReference) + $quantite;
	modifierSTK_generic($idReference, $nouveauStock, $quantite, "INVENTAIRE");
}

/** get list of references with stocks below the alert limit
THIS IS NOT the rows of ".DB_PREFIX."ALERTS_STOCK_RAISED */
/*
 * AC 29-01-2016
 *  - ajout d'un paramètre $all pour filtrer les non-visibles
 *  - retourne également la colonne VISIBLE
 */
function getReferencesWithStockAlert($all = false){
    
	//rows with ALERT_STOCK == NULL are ignored by r.ALERT_STOCK != -1 ...
	//... rows with field NULL, can be selected with r.ALERT_STOCK IS NULL (or IS NOT NULL)
	//... != -1 important, in case stock error get stock to below -1
	$sql = "SELECT s1.STOCK, r.DESIGNATION, f.NOM, c.NOM, r.ID_REFERENCE, r.ALERT_STOCK, r.VISIBLE 
	    FROM ".DB_PREFIX."STOCKS s1, ".DB_PREFIX."REFERENCES r, ".DB_PREFIX."FOURNISSEURS f, ".DB_PREFIX."CATEGORIES c 
	    WHERE s1.DATE = 
	        (SELECT MAX(s2.DATE) FROM ".DB_PREFIX."STOCKS s2 WHERE s2.ID_REFERENCE=s1.ID_REFERENCE) 
	    AND r.ID_REFERENCE = s1.ID_REFERENCE 
	    AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR 
	    AND c.ID_CATEGORIE = r.ID_CATEGORIE 
	    AND r.ALERT_STOCK != -1 
	    AND r.ALERT_STOCK >= s1.STOCK";
	if (!$all) $sql .= "	AND r.VISIBLE = 1";
	$sql .= "	ORDER BY c.NOM, r.DESIGNATION";
        $result = requete($sql);
	$listeStocks = null;
	if ($result){  
	    while ( $row = $result->fetch())
	    {
		$donnees['STOCK'] = $row[0];
		$donnees['DESIGNATION'] = $row[1];
		$donnees['NOM'] = $row[2];
		$donnees['CATEGORIE'] = $row[3];
		$donnees['ID_REFERENCE'] = $row[4];
		$donnees['ALERT_STOCK'] = $row[5];
		$donnees['VISIBLE'] = $row[6] == 0 ? 'NON' : 'OUI';
		$listeStocks[] = $donnees;
	    }
	}
	return $listeStocks;
}

/** check for alert, 
send email for an alert that is not already raised,
register new alerts as raised 
It is called at every purchase */
function check_for_new_stock_alert(){
    $alert_array = getReferencesWithStockAlert();
    //get raised alert
	$result = requete("SELECT * FROM ".DB_PREFIX."ALERTS_STOCK_RAISED");
	
	$alert_raised_array = array();
	while ( $row = $result->fetch()){
		$alert_raised_array[] = $row[1];
	}
	//check if alert are already raised...
	//... if not send email and send to raise alert
	for ($i=0; $i < count($alert_array); $i++){
	    if (! in_array($alert_array[$i]['ID_REFERENCE'], $alert_raised_array)){
	        //echo $alert_array[$i]['DESIGNATION']." not raised";
	        send_stock_alert_email($alert_array[$i]);
	        $req = "INSERT INTO ".DB_PREFIX."ALERTS_STOCK_RAISED (ID_REFERENCE) values('".$alert_array[$i]['ID_REFERENCE']."')";
		    requete($req);
		    
	    }else{
	        //echo $alert_array[$i]['DESIGNATION']." ALREADY raised";
	    }
	}
	
}

/** generate and send the stock alert email */
function send_stock_alert_email($reference){
    /************* ENVOI MAIL ****************/
    $date = date("d-m-Y H:i:s");
    
    /* Message texte */
    $message_txt = "Alerte Stock pour la référence ".$reference['DESIGNATION']." - ".$reference['NOM']."\n";
    $message_txt .= "Lancée le ".$date."\n";
    $message_txt .= "Niveau d'alerte : ".$reference['ALERT_STOCK']."\n";
    $message_txt .= "Niveau actuel : ".$reference['STOCK']."\n";

    //=====Définition du sujet (config.ini)
    $subject = get_email_subject()." Alerte Stock - ".$reference['DESIGNATION']." - ".$reference['NOM'];
     
    //=====Création du header de l'e-mail (config.ini)
    $origin = get_email_origin();
     
    //=====Envoi de l'e-mail
    $mail_dst = array();
    //if email in debug mode, send to alternate destination...
    //... this avoid bothering real users while testing
    $debug_destination = get_email_debug_destination();
    if ($debug_destination != null){
        //debug, sent to the test email
        $mail_dst[] = $debug_destination;
        $subject .= " -debug- ";
    }else{
        //populate array with email from all adherents that subscribed to alert notification
	    $result = requete("SELECT MAIL FROM ".DB_PREFIX."ADHERENTS 
	        WHERE RECEIVE_ALERT_STOCK IS NOT NULL
	        AND RECEIVE_ALERT_STOCK = 1 ");
	    
	    while ($row = $result->fetch()){
		    $mail_dst[] = $row[0];
	    }
    }
    //send to all email(s) in array
    if (should_use_gmail()){
        send_email_using_gmail($mail_dst, $origin, $subject, $message_txt);
    }else{
        send_email_using_php_mail($mail_dst, $origin, $subject, $message_txt);
    }
}

/** remove raised alert, if related stock has been updated */
function remove_raised_alerts_if_any($idReference){
	$result = requete("DELETE FROM ".DB_PREFIX."ALERTS_STOCK_RAISED WHERE ID_REFERENCE = '$idReference'");
	
}

/** @return a list of year within which a purchase occured for $ref
for example array(2013, 2014) */
function getYearWithPurchase_forReferenceId($ref){
    $result = requete("SELECT DISTINCT YEAR(DATE) FROM ".DB_PREFIX."STOCKS WHERE ID_REFERENCE = '$ref'");
    $ret = array();
    while ( $row = $result->fetch()){
        if (0 != $row[0]){
            $ret[] = $row[0];
        }
    }
    
    return $ret;
}

////////// Inventaire : Ecarts ////////
function get_inventaires_dates(){
    $result = requete("SELECT distinct DATE_FORMAT(DATE,'%Y-%m-%e')
                            FROM ".DB_PREFIX."STOCKS
                            WHERE OPERATION = 'INVENTAIRE'
                            group by DATE_FORMAT(DATE,'%Y-%m-%e')
                            ORDER BY DATE DESC;");
    $ret = array();
    while ( $row = $result->fetch()){
        if (0 != $row[0]){
            $ret[] = $row[0];
        }
    }
    
    return $ret;
}

function get_ecarts_list_for_date($date){
    $result = requete("SELECT s.QUANTITE, c.NOM, r.DESIGNATION, f.NOM, r.PRIX_TTC, s.DATE
                            FROM ".DB_PREFIX."STOCKS s, ".DB_PREFIX."REFERENCES r, ".DB_PREFIX."CATEGORIES c, ".DB_PREFIX."FOURNISSEURS f
                            WHERE s.OPERATION = 'INVENTAIRE'
                            AND DATE_FORMAT(s.DATE,'%Y-%m-%e') = '$date'
                            AND s.ID_REFERENCE = r.ID_REFERENCE
                            AND r.ID_CATEGORIE = c.ID_CATEGORIE
                            AND r.ID_FOURNISSEUR = f.ID_FOURNISSEUR;");
    $ret = array();
    while ( $row = $result->fetch()){
        $a = array();
        $a["ecart"] = $row[0];
        $a["categorie_nom"] = $row[1];
        $a["ref_designation"] = $row[2];
        $a["fournisseur_nom"] = $row[3];
        $a["ref_prix"] = $row[4];
        $ret[] = $a;
    }
    
    return $ret;
}

////////////: EMAIL SEND //////////////////

/**
@param $dst_array array of emails
*/
function send_email_using_gmail($dst_array, $origin, $subject, $message){
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = get_gmail_user();
    //Password to use for SMTP authentication
    $mail->Password = get_gmail_pass();
    //Set who the message is to be sent from
    ////$mail->setFrom('gasiersdelesclain@example.com', 'Les Gasiers de l\'Esclain');
    $mail->setFrom($origin);
    //Set an alternative reply-to address
    //$mail->addReplyTo('replyto@example.com', 'First Last');
    //Set who the message is to be sent to
    foreach($dst_array as $dst){
        $mail->addAddress($dst);
    }
    //Set the subject line
    $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';
    $mail->Body = $message;
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');
    //send the message, check for errors
    $ret = $mail->send();
    if (! $ret) {
        echo "Mailer Error: " . $mail->ErrorInfo."<br>";
    }
    return $ret;
}

/**
@param $dst_array array of emails
*/
function send_email_using_php_mail($dst_array, $origin, $subject, $message_txt){
    //usual microsoft shit, which needs special newline
    $passage_ligne = "\n";
    /*if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $dst)){
	    $passage_ligne = "\r\n";
    }*/
    
    //=====Création de la boundary
    $boundary = "-----=".md5(rand());

    //=====Création du header de l'e-mail.
    $header = "From: <".$origin.">".$passage_ligne;
    $header.= "Reply-to: <".$origin.">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========
     
    //=====Envoi de l'e-mail
    $dst = implode(", ", $dst_array);
    mail($dst, $subject, $message, $header);
}

	
?>
