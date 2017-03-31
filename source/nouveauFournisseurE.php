<?php
require ("fonctionsFournisseurs.php");

include 'menu.php';

// Si le formulaire a été envoyé
if (isset ( $_POST ['enregistrer'] )) {
    $nom = $_POST ['nom'];
    // Le nom est obligatoire
    if (empty ( $nom )) {
	echo ("<center>Le nom du fournisseur n\'est pas renseigné ! Création à refaire.</center>");
    } else {
	$mail = $_POST ['mail'];
	
	$adresse = $_POST ['adresse'];
	
	$contact = $_POST ['contact'];
	
	$telephoneFixe = $_POST ['telephoneFixe'];
	
	$telephonePortable = $_POST ['telephonePortable'];
	
	$fax = $_POST ['fax'];
	
	$commentaire = $_POST ['commentaire'];
	
	$visible = $_POST ['visible'];
	
	EnregistrerNouveauFournisseur ( $nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible );
	echo 'Nouveau fournisseur ' . htmlspecialchars($nom) . ' enregistré.';
    }
}

?>
