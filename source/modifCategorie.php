<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
        <title>MODIF. CATÉGORIE</title>
    </head>

	<?php 
	require("fonctionsCategories.php"); 
	$idCategorie= $_GET[idCategorie];
	$donneesCategorie = SelectionDonneesCategorie($idCategorie);
	?>
	
	<?php include 'menu.php'; ?>
	
	<body>
		<div style="text-align:center">
			Les champs avec une étoile doivent obligatoirement être renseignés.
			<div>
				<form id="formulaire" method="post" action="modifCategorieE.php">
					<input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>" />
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="nom">Nom* : </label>
							<input type= "text" class= "col2" name="nom" id="nom" value="<?php echo $donneesCategorie['NOM']; ?>" autofocus required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible :</label>
							<select class= "col2" name="visible" id="visible" >
								<?php
								if($donneesCategorie['VISIBLE'] == '0')
								{
									?>
									<option value="0" selected="selected">NON</option>
									<option value="1">OUI</option>
									<?php
								}
								else
								{
									?>
									<option value="0">NON</option>
									<option value="1" selected="selected">OUI</option>
									<?php
								}
								?>
							</select>
						</p>
						<?php
						if($donneesCategorie['ID_CAT_SUP'] != NULL)
						{
							?>
							<p class = "ligne">
								<label class = "col1" for="catMere">Catégorie mère :</label>
								<select class= "col2" name="catMere" id="catMere" >
									<?php
									$listeCatMeres = SelectionListeCategoriesMeres();
									foreach($listeCatMeres as $cle => $element)
									{
										if($cle == $donneesCategorie['ID_CAT_SUP'])
										{
											?>
											<option value="<?php echo $cle; ?>" selected="selected"><?php echo $element; ?></option>
											<?php
										}
										else
										{
											?>
											<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
											<?php
										}
									}
									?>
								</select>
							</p>
							<?php
						}
						else
						{
						?>
							<input type="hidden" name="catMere" value="0" />
						<?php
						}
						?>
					</div>
					<br />
					<div id="bouton">
						<p>
							<input type="submit" value="Modifier" name="modifierCategorie">
						</p>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
