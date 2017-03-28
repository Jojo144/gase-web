<?php
require ("fonctionsFournisseurs.php");

include 'menu.php';

// Si le formulaire a été envoyé
if (isset ( $_POST ['enregistrer'] )) {
    $nom = $_POST ['nom'];
    $nom = str_replace ( "'", " ", $nom );
    // $nom = mbstrtoupper($nom);
    // Le nom est obligatoire
    if (empty ( $nom )) {
	echo ("<center>Le nom du fournisseur n\'est pas renseigné ! Création à refaire.</center>");
    } else {
	$mail = $_POST ['mail'];
	
	$adresse = $_POST ['adresse'];
	$adresse = str_replace ( "'", "_", $adresse );
	
	$contact = $_POST ['contact'];
	$contact = str_replace ( "'", "_", $contact );
	
	$telephoneFixe = $_POST ['telephoneFixe'];
	$telephoneFixe = str_replace ( "'", "_", $telephoneFixe );
	
	$telephonePortable = $_POST ['telephonePortable'];
	$telephonePortable = str_replace ( "'", "_", $telephonePortable );
	
	$fax = $_POST ['fax'];
	$fax = str_replace ( "'", "_", $fax );
	
	$commentaire = $_POST ['commentaire'];
	$commentaire = str_replace ( "'", "_", $commentaire );
	
	$visible = $_POST ['visible'];
	
	EnregistrerNouveauFournisseur ( $nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible );
	echo 'Nouveau fournisseur ' . $nom . ' enregistré.';
    }
}

?>
