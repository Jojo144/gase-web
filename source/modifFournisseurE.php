<?php
require ("fonctionsFournisseurs.php");

include 'menu.php';

// Si le formulaire a été envoyé
if (isset ( $_POST ['modifierFournisseur'] )) {
	$idFournisseur = $_POST ['idFournisseur'];
	
	$nom = $_POST ['nom'];
	$nom = str_replace ( "'", "_", $nom );
	// $nom = mb_strtoupper($nom);
	// Le nom est obligatoire
	if (empty ( $nom )) {
		print ("<center>Le '<b>NOM</b>' du fournisseur n\'est pas renseigné !</center>") ;
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
		
		MajFournisseur ( $idFournisseur, $nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible );
		echo 'Les données du fournisseur ' . $nom . ' ont été mises à jour dans la base de données.';
	}
}
?>
