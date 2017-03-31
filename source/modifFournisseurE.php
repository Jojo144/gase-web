<?php
require ("fonctionsFournisseurs.php");

include 'menu.php';

// Si le formulaire a été envoyé
if (isset ( $_POST ['modifierFournisseur'] )) {
    $idFournisseur = $_POST ['idFournisseur'];
    $nom = $_POST ['nom'];

    // Le nom est obligatoire
    if (empty ( $nom )) {
	print ("<center>Le '<b>NOM</b>' du fournisseur n\'est pas renseigné !</center>") ;
    } else {
	$mail = $_POST ['mail'];
	
	$adresse = $_POST ['adresse'];
	
	$contact = $_POST ['contact'];
	
	$telephoneFixe = $_POST ['telephoneFixe'];
	
	$telephonePortable = $_POST ['telephonePortable'];
	
	$fax = $_POST ['fax'];
	
	$commentaire = $_POST ['commentaire'];
	
	$visible = $_POST ['visible'];
	
	MajFournisseur ( $idFournisseur, $nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible );
	echo 'Les données du fournisseur ' . $nom . ' ont été mises à jour dans la base de données.';
    }
}
?>
