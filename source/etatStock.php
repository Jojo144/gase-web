<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>STOCKS</title>
    </head>

    <body>
	<?php include 'menu.php'; ?>

	<?php
	require ("fonctionsStock.php");
	/*
	 * AC 29-01-2016
	 * Ajout d'un bouton pour afficher/masquer les références visibles
	 */
	$all = isset ( $_GET ['all'] ) ? true : false;
	$link = $_SERVER ["SCRIPT_NAME"];
	if (! $all)
	    $link .= '?all';
	
	$listeSTK = SelectionListeSTK ( $all );
    $sommesoldes = round(SommeComptes(),2);
    $valeurstock = round(ValeurTotaleStock(),2);
	?>
	<div class="center">
        Somme des soldes des comptes (adhérents visibles seulement) : <?php echo $sommesoldes;?> € <br>
        Valeur du stock (références invisibles inclues) : <?php echo $valeurstock;?> €
        <br> <br>
	    <a href="<?= $link ?>"><?= $all ? 'Masquer les non visibles' : 'Montrer les non visibles' ?></a>
	</div>
	<table style="margin-left: auto; margin-right: auto; max-width: 1000px;">
	    <tr>
		<td width="5%" align="center"><strong>QUANTITÉ</strong></td>
		<td width="10%" align="center"><strong>CATÉGORIE</strong></td>
		<td width="30%" align="center"><strong>DÉSIGNATION</strong></td>
		<td width="20%" align="center"><strong>FOURNISSEUR</strong></td>
		<td width="5%" align="center"><strong>VISIBLE</strong></td>
		<td width="5%" align="center"><strong>STATS</strong></td>
	    </tr>
	    <?php
	    if ($listeSTK)
		foreach ( $listeSTK as $ref ) {
	    ?>
		<tr <?= $ref['VISIBLE'] == 'NON' ? 'class="inactive"' : '' ?>>
		    <td><?php echo $ref['STOCK'];?></td>
		    <td><?php echo htmlspecialchars($ref['CATEGORIE']);?></td>
		    <td><?php echo htmlspecialchars($ref['DESIGNATION']);?></td>
		    <td align="center"><?php echo htmlspecialchars($ref['NOM']);?></td>
		    <td align="center"><?php echo $ref['VISIBLE'];?></td>
		    <td align="center"><a href="stock_stat.php?id=<?php echo $ref['ID_REFERENCE'];?>">stats</a></td>
		</tr>
	    <?php
	    }
	    ?>			
	</table>
    </body>
</html>
