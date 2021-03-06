<?php
require ("fonctionsCategories.php");

include 'menu.php';

// Si le formulaire a été envoyé
if (isset ( $_POST ['modifierCategorie'] )) {
    $idCategorie = $_POST ['idCategorie'];
    
    $nom = $_POST ['nom'];
    // Le nom est obligatoire
    if (empty ( $nom )) {
	print ("<center>Le '<b>NOM</b>' de la catégorie n\'est pas renseigné !</center>") ;
    } else {
	// On ne teste pas si une catégorie sous ce nom n'est pas déjà enregistré
	$visible = $_POST ['visible'];
	$nouvelleCatMere = $_POST ['catMere'];
	
	if ($nouvelleCatMere == 0) {
	    MajCategorie ( $idCategorie, $nom, $visible );
	    echo 'Les données de la catégorie ' . $nom . ' ont été mises à jour dans la base de données.';
	} else {
	    $ancienneCatMere = SelectionIdCategorieMere ( $idCategorie );
	    if ($ancienneCatMere == $nouvelleCatMere) {
		MajCategorie ( $idCategorie, $nom, $visible );
		echo 'Les données de la sous-catégorie ' . $nom . ' ont été mises à jour dans la base de données.';
	    } else {
		MajSousCategorie ( $idCategorie, $nom, $visible, $nouvelleCatMere, $ancienneCatMere );
		echo 'Les données de la sous-catégorie ' . $nom . ' ont été mises à jour dans la base de données.';
	    }
	}
    }
}
?>
