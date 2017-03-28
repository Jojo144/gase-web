<?php
session_start ();
?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<link rel="stylesheet" href="style_form.css" />
	<title>ACHATS</title>
    </head>


    <?php
    require ("fonctionsStock.php");
    require ("fonctionsCompte.php");
    require ("fonctionsAdherents.php");

    // get path to PHPMailer
    $config = parse_ini_file ( GASE_CONFIG_FILE_PATH, true );
    $PHPMailer_path = $config ["libs"] ["PHPMailer_path"];
    require ($PHPMailer_path . "/PHPMailerAutoload.php");

    $soldeAdherent = SelectionSoldeAdherentMC ( $_SESSION ['adherent'] );
    if (isset ( $_POST ['payer'] )) {
	// Vérifie si le montant de la commande est supérieur à 0.
	$totalTTC = $_SESSION ['montantPanier'];
	// On enlève ça pourautoriser les quantités négatives
	//if ($totalTTC > 0) {
	    // la maison fait crédit de 20Euro max !!
	    if ($totalTTC <= $soldeAdherent + 20) {
		$nbRef = $_SESSION ['nbRefPanier'];
		$idAdherent = $_SESSION ['adherent'];
		DepenseMC ( $idAdherent, $totalTTC );
		$nouveauSolde = SelectionSoldeAdherentMC ( $idAdherent );
		$numeroAchat = EnregistrerAchatAdherent ( $idAdherent, $totalTTC, $nbRef );
		for($compteur = 0; $compteur < $nbRef; $compteur ++) {
		    AchatSTK ( $numeroAchat, $_SESSION ['panier'] ['idRef'] [$compteur], $_SESSION ['panier'] ['qteReference'] [$compteur] );
		}
		
		// only send if user subscribed for it
		if (USE_MAIL && SelectionAdherent_TicketCaisse($idAdherent)) {
		    generate_email ( $idAdherent, $totalTTC );
		}
		
		// check stok for new alert and send email to person that subscribed to it
		if (USE_MAIL)
		    check_for_new_stock_alert();
		
		echo "Achat " . $numeroAchat . " enregistré.<br />";
		echo "<div style=\"text-align:center\">Le solde de votre compte est maintenant de " . round ( $nouveauSolde, 2 ) . " euros.</div>";
		echo "Merci.<br />";
		echo "
			    <br />
			    <li>Pour aller à la page d'accueil : <a href=\"index.php\">cliquez ici</a></li>
			";
	    } else {
		echo "<div style=\"text-align:center; color: #FF0000\">Attention, le total de vos achats et supérieur au solde de votre compte.<br />Veuillez l'approvisionner avant de ré-enregistrer vos achats.</div>";
		echo "
			    <br>
			    <li>Pour modifier votre panier  <a href=\"javascript:window.history.back()\">cliquez ici</a></li>
			    <li>Pour aller à la page d'accueil : <a href=\"index.php\">cliquez ici</a></li>
			";
	    }
	/* } else {
	   include '1listeRefCategorie.php';
	   echo 'Le panier est vide. Pas de commande enregistrée';
	   }*/
    }
    function generate_email($idAdherent, $totalTTC) {
	/**
	 * *********** ENVOI MAIL ***************
	 */
	$date = date ( "d-m-Y H:i:s" );
	$nouveauSolde = SelectionSoldeAdherentMC ( $idAdherent );
	
	// Déclaration de l'adresse de destination
	$mail = stripslashes ( SelectionMailAdherentAD ( $idAdherent ) );
	// usual microsoft shit, which needs special newline
	if (! preg_match ( "#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail )) {
	    $passage_ligne = "\r\n";
	} else {
	    $passage_ligne = "\n";
	}
	/* Message texte */
	$message_txt = "Vos achats du " . $date . "\n";
	for($i = 0; $i < count ( $_SESSION ['panier'] ['nomReference'] ); $i ++) {
	    $message_txt .= "  - " . 
			    // name product
			    stripslashes ( $_SESSION ['panier'] ['nomReference'] [$i] ) . 
			    // quantity bought
			    " " . $_SESSION ['panier'] ['qteReference'] [$i] . " x " . round ( $_SESSION ['panier'] ['prixReference'] [$i] / $_SESSION ['panier'] ['qteReference'] [$i], 2 ) . "euro" . 
			    // total price for this product
			    "  [ " . round ( $_SESSION ['panier'] ['prixReference'] [$i], 2 ) . " euros ]\n";
	}
	$message_txt .= "\nTOTAL TTC : " . round ( $totalTTC, 2 ) . " euros.\n";
	$message_txt .= "Le solde de votre compte est maintenant de : " . round ( $nouveauSolde, 2 ) . " euros.\n";
	$message_txt .= "Merci.";
	
	// =====Définition du sujet (config.ini)
	$subject = get_email_subject () . " Ticket achats";
	
	// =====Création du header de l'e-mail (config.ini)
	$origin = get_email_origin ();
	
	// =====Envoi de l'e-mail
	// if email in debug mode, send to alternate destination...
	// ... this avoid bothering real users while testing
	$debug_destination = get_email_debug_destination ();
	if ($debug_destination != null) {
	    // debug, sent to the test email
	    // send_email_using_gmail($debug_destination, $origin, $subject." -debug- ", $message_txt);
	    $mail = $debug_destination;
	    $subject .= " -debug- ";
	}
	$ret_mail = false;
	// functions require array as input
	$mail_tmp_array = array (
	    $mail 
	);
	if (should_use_gmail ()) {
	    $ret_mail = send_email_using_gmail ( $mail_tmp_array, $origin, $subject, $message_txt );
	} else {
	    $ret_mail = send_email_using_php_mail ( $mail_tmp_array, $origin, $subject, $message_txt );
	}
	if ($ret_mail) {
	    echo "Ticket envoyé à " . $mail . "<br>";
	}
    }

    ?>

