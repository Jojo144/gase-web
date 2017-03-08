<?php
//to remove
//require("fonctionsOutil.php");
require("fonctionsBD.php");
 
// Si le formulaire a été envoyé
if (isset ($_POST['enregistrerInfoOutil']))
{
	$info = $_POST['info'];
	$info = str_replace("'", "_", $info);

	EnregistrerInfoOutil($info);

    header('location:journalDeBord.php');
}


?>
