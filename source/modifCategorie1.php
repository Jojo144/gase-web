<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
		<title>CATÉGORIES</title>
    </head>
	<?php include 'menu.php'; ?>
	<?php require("fonctionsCategories.php"); ?>
    <body>
		<div style="text-align:center">
			Cliquez sur le nom de la catégorie à modifier.
		<div>
		<br />
		<div class="liste" style="text-align:left">
			<table>
				<tr>
					<td><label class="colonne1"><center><strong>NOM</strong></center></label></td>
					<td><label class="colonne2"><center><strong>VISIBLE</strong></center></label></td>
					<td><label class="colonne3"><center><strong>SOUS-CATÉGORIE</strong></center></label></td>
					<td><label class="colonne4"><center><strong>CATÉGORIE MÈRE</strong></center></label></td>
				</tr>
				<?php	
				$listeCategories = SelectionListeCategories();
				if($listeCategories)
				foreach($listeCategories as $cle => $element)
				{
					$donneesCategorie = SelectionDonneesCategorie($cle);
					?>
					<tr>
						<td><a href="modifCategorie.php?idCategorie=<?php echo  $cle; ?>" title="<?php echo $element; ?>" class="bouton"><?php echo  "&nbsp;".$element."&nbsp;"; ?></a></td>
						<?php
						if($donneesCategorie['VISIBLE'] == 1)
						{
							?>
							<td><label class="colonne2"><center>OUI</center></label></td>
							<?php
						}
						else
						{
							?>
							<td><label class="colonne2"><center>NON</center></label></td>
							<?php
						}
						if($donneesCategorie['ID_CAT_SUP'] != NULL)
						{
							?>
							<td><label class="colonne3"><center>OUI</center></label></td>
							<?php
						}
						else
						{
							?>
							<td><label class="colonne3"><center>NON</center></label></td>
							<?php
						}
						
						$nomCatMere = SelectionNomCategorieMere($cle);
						?>
						<td><label class="colonne3"><center><?php echo $nomCatMere; ?></center></label></td>
					</tr>
					<?php
				}
				?>
			</table>					
		</div>
	</body>
</html>
