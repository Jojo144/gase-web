<?php
// to remove
// require("fonctionsOutil.php");
require ("fonctionsBD.php");

// Si le formulaire a été envoyé
if (isset ( $_POST ['enregistrerInfoOutil'] )) {
	$info = $_POST ['info'];
	
	EnregistrerInfoOutil ( $info );
	
	header ( 'location:journalDeBord.php' );
}

elseif (isset ( $_POST ['editerJournal'] )) {
	$info = $_POST['info'];
	
	EditerInfoOutil( $info, $_POST['edit_date'] );
	
	header ( 'location:journalDeBord.php' );
}
?>
