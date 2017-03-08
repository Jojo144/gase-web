<?php
require ("fonctionsStock.php");

// Si le formulaire a été envoyé
if (isset ( $_POST ['enregistrerStocks'] )) {
	$idFournisseur = $_POST ['idFournisseur'];
	$listeSTK = SelectionStocks ( $idFournisseur );
	
	$test_numeric = 1;
	$test_presence = 0;
	
	foreach ( $listeSTK as $reference ) {
		$quantite = $_POST [$reference ['ID_REFERENCE']];
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
			foreach ( $listeSTK as $reference ) {
				$quantite = $_POST [$reference ['ID_REFERENCE']];
				$quantite = str_replace ( ",", ".", $quantite );
				$quantite = trim ( $quantite );
				
				if ($quantite != '') {
					ModifierSTK ( $reference ['ID_REFERENCE'], $quantite );
				}
			}
			include ('approStockE2.php');
		} else {
			echo 'La qauntité indiquée pour ' . $testElement . ' n\'est pas une valeur numérique.';
		}
	} else {
		echo 'Aucune quantité n\'est renseignée.';
	}
}

?>
