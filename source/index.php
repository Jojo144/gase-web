<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>Compteur du Gase</title>
    </head>

    <body>
	<?php include 'menu.php'; ?>
	<?php require 'fonctionsBD.php'; ?>
	<?php require 'fonctionsStock.php'; ?>
	
	<div class="notification_alert_stock">
	    <?php
	    $alert_list = getReferencesWithStockAlert ();
	    if (count ( $alert_list ) > 0) {
		echo "<strong>Alerte Stock ! </strong><a href=\"alertesStock.php\">détail</a>";
	    }
	    ?>
	</div>
	<div style="text-align: center">
	    <h3>BIENVENUE SUR LE COMPTEUR DU GASE</h3>
	    <br />
	    <br />
	    <iframe src="https://gasedechips.girole.fr" height="1600" width="1200"></iframe>
	</div>
    </body>
</html>
