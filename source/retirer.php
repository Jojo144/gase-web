
<?php
session_start ();

$idRef = $_GET ['idRef'];

$compteur = 0;
$trouve = 0;
while ( $trouve == 0 ) {
	
	if ($_SESSION ['panier'] ['idRef'] [$compteur] == $idRef) {
		$trouve = 1;
		$_SESSION ['montantPanier'] = $_SESSION ['montantPanier'] - $_SESSION ['panier'] ['prixReference'] [$compteur];
		$_SESSION ['nbRefPanier'] --;
		unset ( $_SESSION ['panier'] ['idRef'] [$compteur] );
		$_SESSION ['panier'] ['idRef'] = array_values ( $_SESSION ['panier'] ['idRef'] );
		unset ( $_SESSION ['panier'] ['nomReference'] [$compteur] );
		$_SESSION ['panier'] ['nomReference'] = array_values ( $_SESSION ['panier'] ['nomReference'] );
		unset ( $_SESSION ['panier'] ['qteReference'] [$compteur] );
		$_SESSION ['panier'] ['qteReference'] = array_values ( $_SESSION ['panier'] ['qteReference'] );
		unset ( $_SESSION ['panier'] ['prixReference'] [$compteur] );
		$_SESSION ['panier'] ['prixReference'] = array_values ( $_SESSION ['panier'] ['prixReference'] );
	}
	$compteur ++;
}

// include 'achats.php';
// rediret to list of reference + panier
header ( 'location:achats.php' );
?>

