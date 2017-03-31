<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>INVENTAIRE</title>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <?php
	require ("fonctionsStock.php");
	$listeSTK = SelectionListeSTK ();
	?>

	<form id="formulaire" method="post" action="inventaireE.php">
	    <div>
		<table style="margin-left: auto; margin-right: auto;">
		    <tr>
			<td><label class="colonne1"><strong>EN STOCK</strong></label></td>
			<td><label class="colonne2"><strong>INVENTAIRE</strong></label></td>
			<td><label class="colonne4"><strong>CATÉGORIE</strong></label></td>
			<td><label class="colonne3"><strong>DÉSIGNATION</strong></label></td>
			<td><label class="colonne3"><strong>FOURNISSEUR</strong></label></td>
		    </tr>	
		    <?php
		    if ($listeSTK)
			foreach ( $listeSTK as $element ) {
		    ?>
			<tr>
			    <td><label class="colonne1"><?php echo '[' . $element['STOCK'] . ']'; ?></label></td>
			    <td><input class="colonne2" type="text"
name="<?php echo $element['ID_REFERENCE'];?>"
id="<?php echo $element['ID_REFERENCE'];?>" /></td>
			    <td><label class="colonne4"><?php echo htmlspecialchars($element['CATEGORIE']); ?></label></td>
			    <td><label class="colonne3"><?php echo htmlspecialchars($element['DESIGNATION']); ?></label></td>
			    <td><label class="colonne3"><?php echo htmlspecialchars($element['NOM']); ?></label></td>
			</tr>
		    <?php
		    }
		    ?>
		</table>
	    </div>
	    <br />
	    <div>
		<p>
		    <input type="submit" value="Enregistrer"
name="enregistrerInventaire">
		</p>
	    </div>
	</form>
    </body>
</html>
