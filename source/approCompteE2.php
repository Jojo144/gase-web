<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>COMPTE</title>
    </head>

    <body>
	<?php include 'menu.php'; ?>

	<div style="text-align: center">
	    Versement effectué. </br> N'oubliez pas de déposer l'argent en caisse
	    ! </br>
	    <?php
	    $solde = SelectionSoldeAdherentMC ( $idAdherent );
	    echo 'Le solde est maintenant de ' . $solde . ' euros.';
	    ?>
	</div>
    </body>
</html>





