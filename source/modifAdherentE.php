
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
    </head>
    <body>
	<title>MODIF. ADHERENT</title>
	<?php require 'fonctionsAdherents.php'; ?>
	<?php include 'menu.php'; ?>

        <?php
	// Si le formulaire a été envoyé
	if (isset ( $_POST ['modifierAdherent'] )) {
	    $idAdherent = $_POST ['idAdherent'];
	    
	    $nom = $_POST ['nom'];
	    $nom = trim ( $nom );
	    
	    if (empty ( $nom )) {
		print ("<center>Le '<b>NOM</b>' de l\'adherent n\'est pas renseigné ! Création à refaire.</center>") ;
	    } else {
		$ticket = (USE_MAIL) ?  $_POST['ticket'] : '0';
		$email = $_POST ['email'];
		if (empty($email) && $ticket) {
		    print ("<center>Pour envoyer un ticket de caisse, il faut renseigner l '<b>EMAIL</b>' ! Modifications non effectuée</center>") ;
		} else {
		    $prenom = $_POST ['prenom'];
		    $prenom = trim ( $prenom );
		    
		    $email = $_POST ['email'];
		    $telephone_fixe = $_POST ['telephoneFixe'];
		    $telephone_portable = $_POST ['telephonePortable'];
		    
		    $adresse = $_POST ['adresse'];
		    $adresse = trim ( $adresse );
		    
		    $commentaire = $_POST ['commentaire'];
		    $commentaire = trim ( $commentaire );
		    
		    $visible = $_POST ['visible'];
		    $stock_alert = (USE_MAIL) ? $_POST['receive_alert_stock'] : '0';
		    
		    MajAdherent ( $idAdherent, $nom, $prenom, $email, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible, $stock_alert );
		    echo '<p style="text-align:center">Mise à jour des données de ' . htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom) . ' enregistrée.</p>';
		    }
		    }
		    }
	?>

    </body>
</html>
