<?php
require ("fonctionsStock.php");

// Si le formulaire a été envoyé
if (isset ( $_POST ['enregistrerInventaire'] )) {
    
    $listeSTK = SelectionListeSTK (true);
    
    $test_numeric = 1;
    $test_presence = 0;
    
    foreach ( $listeSTK as $element ) {
	$quantite = securite_bdd ( $_POST [$element ['ID_REFERENCE']] );
	$quantite = str_replace ( ",", ".", $quantite );
	$quantite = trim ( $quantite );
	
	if ($quantite != '') {
	    if (is_numeric ( $quantite ) == FALSE) {
		$test_numeric = 0;
		$testElement = $element;
	    }
	    $test_presence = 1;
	}
    }
    
    if ($test_presence == 1) {
	if ($test_numeric == 1) {
	    foreach ( $listeSTK as $element ) {
		$quantite = securite_bdd ( $_POST [$element ['ID_REFERENCE']] );
		$quantite = str_replace ( ",", ".", $quantite );
		$quantite = trim ( $quantite );
		
		if ($quantite != '') {
		    // $qte = $quantite - $listeSTK[$element['ID_REFERENCE']];
		    $qte = $quantite - $element ['STOCK'];
		    if ($qte != 0) {
			ModifierInventaireSTK ( $element ['ID_REFERENCE'], $qte );
		    }
		}
	    }
	    include ('inventaireE2.php');
	} else {
	    echo 'La quantité indiquée pour ' . $testElement . ' n\'est pas une valeur numérique.';
	}
    } else {
	echo 'Aucune quantité n\'est renseignée.';
    }
}
function securite_bdd($string) {
    // On regarde si le type de string est un nombre entier (int)
    if (ctype_digit ( $string )) {
	$string = intval ( $string );
    } 	// Pour tous les autres types
    else {
	// $string = mysql_real_escape_string($string);
	$string = addcslashes ( $string, '%_' );
    }
    
    return $string;
}
?>
