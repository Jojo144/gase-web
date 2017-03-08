<?php
//to remove
//require("fonctionsOutil.php");
require("fonctionsBD.php");
 
// Si le formulaire a été envoyé
if (isset ($_POST['enregistrerInfoOutil']))
{
	$info = $_POST['info'];
	$info = htmlspecialchars($info);
	$info = nl2br($info);
	
	EnregistrerInfoOutil($info);

    header('location:journalDeBord.php');
}


?>
