<?php
session_start ();
?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<link rel="stylesheet" href="style_form.css" />
	<title>ACHATS</title>
    </head>

    <?php
    // require("fonctionsCategories.php");
    if (isset ( $_GET ['idCategorie'] )) {
	$idCategorie = $_GET ['idCategorie'];
	$_SESSION ['idCategorie'] = $idCategorie;
    }
    ?>

    <body>
	<?php include 'menuAchats.php'; ?>
	<?php
	require 'fonctionsCompte.php';
	require 'fonctionsAdherents.php';
	require 'fonctionsReferences.php';
	$soldeAdherent = SelectionSoldeAdherentMC ( $_SESSION ['adherent'] );
	$prenom_nom = SelectionPrenomNomAdherent ( $_SESSION ['adherent'] );
	?>
	<div class="name_and_balance">
	    <?php echo $prenom_nom, " - <strong>Solde : ", round($soldeAdherent, 2), " euros</strong>" ?>
	</div>
	<br>
	<div class="references">
	    <?php include 'listeReferences.php';?>
	</div>
	<div class="panier">
        <br> <br>
	    <?php include 'panier.php';?>
	</div>
	<div>
	    <br> <br> <br> <br> Rappel : pour laisser un fond de roulement à la
	    commission commande, merci de toujours laisser au moins 30€ sur votre
	    compte.
	</div>
    </body>
</html>
