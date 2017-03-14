<?php
require ("fonctionsBD.php");

// Enregistrer une nouvelle info
if (isset ( $_POST['enregistrerInfoOutil'] )) {
	$info = $_POST['info'];
	EnregistrerInfoOutil( $info );
}

// Editer une info
elseif (isset ( $_POST['editerJournal'] )) {
	$info = $_POST['info'];
	EditerInfoOutil( $info, $_POST['edit_date'] );	
}

// Supprimer une info
elseif (isset ( $_POST['supprimerJournal'] )) {
	RemoveMessage ( $_POST['edit_date'] );
}

// Redirection
header( 'Location:journalDeBord.php' );
?>
