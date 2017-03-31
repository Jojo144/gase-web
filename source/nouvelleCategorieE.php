<?php
require ("fonctionsCategories.php");

include 'menu.php';

// Si le formulaire a été envoyé
if (isset ( $_POST ['enregistrer'] )) {
    $nom = $_POST ['nom'];
    if (empty ( $nom )) {
	print ("<center>Le '<b>NOM</b>' de la categorie n'est pas renseigné !</center>") ;
    } else {
	$sousCategorie = $_POST ['sousCategorie'];
	if ($sousCategorie == 0) // creation d'une catégorie mère
	{
	    EnregistrerNouvelleCategorie ( $nom );
	    echo 'Nouvelle categorie ' . htmlspecialchars($nom) . ' enregistrée.';
	} else // création d'une sous-catégorie
	{
	    $idCatSup = $_POST ['idCatSup'];
	    if (empty ( $idCatSup )) {
		print ("<center>Le nom de la '<b>catégorie mère</b>' n'est pas renseigné !</center>") ;
	    } else {
		EnregistrerNouvelleSousCategorie ( $nom, $idCatSup );
		echo 'Nouvelle sous-catégorie ' . htmlspecialchars($nom) . ' enregistrée.';
	    }
	}
    }
}
?>
