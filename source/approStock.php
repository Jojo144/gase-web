<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
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

	<br />
	<b><center>
	    <font color="red">L'approvisionnement des références en vrac doit
		être indiqué en kilogramme ou en litre.</font>
	</center></b>
	<br />
	<form id="formulaire" method="post" action="approStockE.php">
	    <div>
		<center>
		    <?php
		    if (count ( $listeSTK ) > 0) {
		    ?>
			<input type="submit" value="Enregistrer" name="enregistrerStocks">
		    <?php
		    }
		    ?>
		</center>
	    </div>
	    <br>
	    <div>
		<table style="margin-left: auto; margin-right: auto;">
		    <tr>
			<td>&nbsp;<label class="colonne1"><strong>CODE FOURN.</strong>&nbsp;</label></td>
			<td>&nbsp;<label class="colonne4"><strong>APPRO</strong>&nbsp;</label></td>
			<td>&nbsp;<label class="colonne5"><strong>CATÉGORIE</strong>&nbsp;</label></td>
			<td>&nbsp;<label class="colonne2"><strong>DÉSIGNATION</strong>&nbsp;</label></td>
			<td>&nbsp;<label class="colonne3"><strong>EN STOCK</strong>&nbsp;</label></td>
			<input type="hidden" name="idFournisseur"
			       value="<?php echo $idFournisseur; ?>" />
		    </tr>
		    <?php
		    // $listeDesignREF = SelectionListeDesignFournisseurREF($fournisseur);
		    // if(count($listeDesignREF) > 0)
		    if (count ( $listeSTK ) > 0) {
			foreach ( $listeSTK as $reference ) {
		    ?>
			<tr>
			    <td>&nbsp;<label class="colonne1"><?php echo $reference['CODE_FOURNISSEUR']; ?></label>&nbsp;</td>
			    <td>&nbsp;<label class="colonne4"><input type="text" name="<?php echo $reference['ID_REFERENCE'];?>"
								     id="<?php echo $reference['ID_REFERENCE'];?>" /></label>&nbsp;</td>
			    <td>&nbsp;<label class="colonne5"><?php echo htmlspecialchars($reference['CATEGORIE']); ?></label>&nbsp;</td>
			    <td>&nbsp;<label class="colonne2"><?php echo htmlspecialchars($reference['DESIGNATION']); ?></label>&nbsp;</td>
			    <td>&nbsp;<label class="colonne3"><?php echo '[' . $reference['STOCK'] . ']'; ?></label>&nbsp;</td>
			</tr>
		    <?php
		    }
		    } else {
			echo 'Pas de référence pour ce fournisseur.';
		    }
		    ?>
	    </div>
	</form>
    </body>
</html>
