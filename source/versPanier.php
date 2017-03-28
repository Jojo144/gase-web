<?php
session_start ();

// $nbArticles=count($_SESSION['panier']['libelleProduit']);
// $compteur = $nbArticles;

if (isset ( $_POST ['acheterRef'] )) {
    $listeRef = $_SESSION ['listeRef'];
    // Si une des quantités est négative, on affiche un avertissement dans panier.php
    $qteNegative = false;
    foreach ( $listeRef as $idReference ) {
	$qteProduit = $_POST ['qte_' . $idReference];
	$qteProduit = trim ( $qteProduit );
	$qteProduit = str_replace ( ",", ".", $qteProduit );
	$qteNegative = $qteNegative || ($qteProduit < 0);
	if ($qteProduit <> 0) {
	    $prixReference = $_POST ['prix_' . $idReference];
	    // regarde si la référence est déjà dans le panier
	    $pos = array_search ( $idReference, $_SESSION ['panier'] ['idRef'] );
	    if ($pos !== false) {
		$_SESSION ['panier'] ['qteReference'] [$pos] = $_SESSION ['panier'] ['qteReference'] [$pos] + $qteProduit;
		$_SESSION ['panier'] ['prixReference'] [$pos] = $prixReference * $_SESSION ['panier'] ['qteReference'] [$pos];
	    } else {
		$nomReference = $_POST ['nom_' . $idReference];
		// $idFournisseur = $_POST['fournisseur_'.$idReference];
		array_push ( $_SESSION ['panier'] ['idRef'], $idReference );
		array_push ( $_SESSION ['panier'] ['nomReference'], $nomReference );
		array_push ( $_SESSION ['panier'] ['qteReference'], $qteProduit );
		array_push ( $_SESSION ['panier'] ['prixReference'], $prixReference * $qteProduit );
		// array_push( $_SESSION['panier']['idFournisseur'],$idFournisseur);	    
		$_SESSION ['nbRefPanier'] ++;
	    }
	    $_SESSION ['montantPanier'] = $_SESSION ['montantPanier'] + ($prixReference * $qteProduit);
	    $_SESSION['qteNegative'] = $qteNegative;
	}
    }
}

// include 'achats.php';
// rediret to list of reference + panier
header ( 'location:achats.php' );
?>
