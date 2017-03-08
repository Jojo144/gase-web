<!DOCTYPE html>
<html>
<head>
<!-- En-tête de la page -->
<meta charset="utf-8" />
<link rel="stylesheet" href="style_default.css" />
<title>NOUVELLE CATÉGORIE</title>
</head>

	<?php
	require ("fonctionsCategories.php");
	?>
	
	<?php include 'menu.php'; ?>
	
	<?php
	$sousCat = $_POST ['sousCategorie'];
	?>
	
    <body>
	<div style="text-align: center">
		Les champs avec une étoile doivent obligatoirement être renseignés.
		<div>
			<form id="formulaire" method="post" action="nouvelleCategorieE.php">
				<div id="table">
						<?php
						if ($sousCat == 0) {
							?>
							<p class="ligne">
						<label class="col1" for="sousCategorie">C'est une sous-catégorie :
						</label> <input type="text" value="NON" disabled="disabled" /> <input
							type="hidden" name="sousCategorie"
							value="<?php echo $sousCat; ?>" />
					</p>
					<p class="ligne">
						<label class="col1" for="nom">Nom* : </label> <input type="text"
							class="col2" name="nom" id="nom" autofocus required />
					</p>
							<?php
						} else {
							?>
							<p class="ligne">
						<label class="col1" for="sousCategorie">C'est une sous-catégorie :
						</label> <input type="text" value="OUI" disabled="disabled" /> <input
							type="hidden" name="sousCategorie"
							value="<?php echo $sousCat; ?>" />
					</p>
					<p class="ligne">
						<label class="col1" for="nom">Nom* : </label> <input type="text"
							class="col2" name="nom" id="nom" autofocus required />
					</p>
					<p class="ligne">
						<label class="col1" for="catMere">Catégorie mère* : </label> <select
							name="idCatSup" id="idCatSup">
							<option value="" selected="selected"></option>
									<?php
							$listeCategoriesMeres = SelectionListeCategoriesMeres ();
							if ($listeCategoriesMeres)
								foreach ( $listeCategoriesMeres as $cle => $element ) {
									?>
										<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
										<?php
								}
							?>
								</select>
					</p>
							<?php
						}
						?>
					</div>
				<br />
				<div id="bouton">
					<p>
						<input type="submit" value="Enregistrer" name="enregistrer">
					</p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>





