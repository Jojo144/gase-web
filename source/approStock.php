<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="approStock.css" />
	<title>APPROVISIONNEMENT</title>
    </head>

    <?php
    // require("fonctionsREF.php");
    require ("fonctionsStock.php");
    $idFournisseur = $_POST ['fournisseur'];
    $listeSTK = SelectionStocks ( $idFournisseur );
    // $listeCodeREF = SelectionListeCodeFournisseurREF($fournisseur);
    ?>
    
    <body>
	<?php include 'menu.php'; ?>

	<b><center>
	    <font color="red">L'approvisionnement des références en vrac doit
		être indiqué en kilogramme ou en litre.</font>
	</center></b>
	<br />
	<form id="formulaire" method="post" action="approStockE.php">
	    <div>
		<label class="colonne1"><strong>CODE FR</strong></label> <label
class="colonne4"><strong>APPRO</strong></label> <label
class="colonne5"><strong>CATÉGORIE</strong></label> <label
class="colonne2"><strong>DÉSIGNATION</strong></label> <label
class="colonne3"><strong>EN STOCK</strong></label> <input
type="hidden" name="idFournisseur"
value="<?php echo $idFournisseur; ?>" />
		<?php
		// $listeDesignREF = SelectionListeDesignFournisseurREF($fournisseur);
		// if(count($listeDesignREF) > 0)
		if (count ( $listeSTK ) > 0) {
		    foreach ( $listeSTK as $reference ) {
		?>
		    <p class="col1"><?php echo $reference['CODE_FOURNISSEUR'] . ':'; ?></p>
		    <input type="text" name="<?php echo $reference['ID_REFERENCE'];?>"
id="<?php echo $reference['ID_REFERENCE'];?>" />
		    <p class="col5"><?php echo $reference['CATEGORIE']; ?></p>
		    <p class="col2"><?php echo $reference['DESIGNATION']; ?></p>
		    <p class="col3"><?php echo '[' . $reference['STOCK'] . ']'; ?></p>
		    <br />
		<?php
		}
		} else {
		    echo 'Pas de reference pour ce fournisseur.';
		}
		?>
	    </div>
	    <div>
		<p>
		    <?php
		    if (count ( $listeSTK ) > 0) {
		    ?>
			<input type="submit" value="Enregistrer" name="enregistrerStocks">
		    <?php
		    }
		    ?>
		</p>
	    </div>
	</form>
    </body>
</html>
