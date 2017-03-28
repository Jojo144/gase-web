<?php
session_start ();

// $nbArticles=count($_SESSION['panier']['libelleProduit']);
// $compteur = $nbArticles;

if (isset ( $_POST ['acheterRef'] )) {
    $listeRef = $_SESSION ['listeRef'];
    
    foreach ( $listeRef as $idReference ) {
	$qteProduit = $_POST ['qte_' . $idReference];
	$qteProduit = trim ( $qteProduit );
	$qteProduitValide = str_replace ( ",", ".", $qteProduit );
	$qteProduit = $qteProduitValide;
	if ($qteProduit > 0) {
	    // if(in_array($idReference, $_SESSION['panier']['idRef'],true))
	    $pos = array_search ( $idReference, $_SESSION ['panier'] ['idRef'] );
	    if ($pos !== false) {
		
		$_SESSION ['panier'] ['qteReference'] [$pos] = $_SESSION ['panier'] ['qteReference'] [$pos] + $qteProduit;
		$prixReference = $_POST ['prix_' . $idReference];
		$_SESSION ['panier'] ['prixReference'] [$pos] = $prixReference * $_SESSION ['panier'] ['qteReference'] [$pos];
		
		$_SESSION ['montantPanier'] = $_SESSION ['montantPanier'] + $prixReference * $qteProduit;
	    } else {
		$nomReference = $_POST ['nom_' . $idReference];
		$prixReference = $_POST ['prix_' . $idReference];
		// $idFournisseur = $_POST['fournisseur_'.$idReference];
		
		array_push ( $_SESSION ['panier'] ['idRef'], $idReference );
		array_push ( $_SESSION ['panier'] ['nomReference'], $nomReference );
		array_push ( $_SESSION ['panier'] ['qteReference'], $qteProduit );
		array_push ( $_SESSION ['panier'] ['prixReference'], $prixReference * $qteProduit );
		// array_push( $_SESSION['panier']['idFournisseur'],$idFournisseur);
		
		$_SESSION ['nbRefPanier'] ++;
		$_SESSION ['montantPanier'] = $_SESSION ['montantPanier'] + ($prixReference * $qteProduit);
	    }
	}
    }
}

// include 'achats.php';
// rediret to list of reference + panier
header ( 'location:achats.php' );
?>
