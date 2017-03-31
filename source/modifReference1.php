<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>RÉFÉRENCES</title>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <?php
	require ("fonctionsReferences.php");
	require ("fonctionsFournisseurs.php");
	require ("fonctionsCategories.php");
	?>
	<div style="text-align: center">
	    Cliquez sur le nom de la référence à modifier.
	    <div>
		<br />
		<div class="liste" style="text-align: left">
		    <table style="margin-left: auto; margin-right: auto;">
			<tr>
			    <td><label class="colonne3"><center>
				<strong>CATÉGORIE</strong>
			    </center></label></td>
			    <td><label class="colonne1"><center>
				<strong>DÉSIGNATION</strong>
			    </center></label></td>
			    <td><label class="colonne2"><center>
				<strong>FOURNISSEUR</strong>
			    </center></label></td>
			    <td><label class="colonne4"><center>
				<strong>PRIX</strong>
			    </center></label></td>
			    <td><label class="colonne5"><center>
				<strong>VRAC</strong>
			    </center></label></td>
			    <td><label class="colonne7"><center>
				<strong>VISIBLE</strong>
			    </center></label></td>
			    <td><label class="colonne8"><center>
				<strong>DATE DE RÉFÉRENCEMENT</strong>
			    </center></label></td>
			</tr>
			<?php
			$listeReferences = SelectionListeReferences ();
			if ($listeReferences)
			    foreach ( $listeReferences as $cle => $element ) {
				$donneesReference = SelectionDonneesReference ( $cle );
				$nomFournisseur = SelectionNomFournisseur ( $donneesReference ['ID_FOURNISSEUR'] );
				$nomCategorie = SelectionNomCategorie ( $donneesReference ['ID_CATEGORIE'] );
			?>
			    <tr>
				<td>&nbsp;<label class="colonne3"></label><?php echo  htmlspecialchars($nomCategorie); ?>&nbsp;</td>
				<td>&nbsp;<a href="modifReference.php?idReference=<?php echo  $cle; ?>"
					     title="<?php echo $element; ?>" class="bouton"><?php echo  htmlspecialchars($element); ?>
				</a>&nbsp;</td>
				<td>&nbsp;<label class="colonne2"></label><?php echo  $nomFournisseur; ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne4"></label><?php echo  $donneesReference['PRIX_TTC']; ?>&nbsp;</td>
				
				<?php
				if ($donneesReference ['VRAC'] == 0) {
				?>
				    <td><label class="colonne5"></label>NON</td>
				<?php
				} else {
				?>
				    <td><label class="colonne5"></label>OUI</td>
				<?php
				}
				if ($donneesReference ['VISIBLE'] == 0) {
				?>
				    <td><label class="colonne10"></label>NON</td>
				<?php
				} else {
				?>
				    <td><label class="colonne10"></label>OUI</td>
				<?php
				}
				?>
				<td><label class="colonne8"></label><?php echo  "&nbsp;".$donneesReference['DATE_REFERENCEMENT']."&nbsp;"; ?></td>
			    </tr>
			<?php
			}
			?>
		    </table>
		</div>

    </body>
</html>
