<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style_form.css" /> 
        <title>NOUVELLE REFERENCE</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<?php 
		require("fonctions_bd_fournisseurs.php"); 
		require("inde_fonctionsCAT.php");
		?>
		<div style="text-align:center">
			Les champs avec une étoile doivent obligatoirement être renseignés.<br />
			Le prix TTC doit être indiqué à l'unite ou au kilo.<br />
			Le nom du produit est à écrire en minuscule avec une majuscule au debut, en indiquant si possible le poids ou le volume.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerNouvelleReference.php">
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="designation">Désignation* :</label>
							<input type="text" class= "col2" name="designation" id="designation" autofocus required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="fournisseur">Fournisseur* :</label>
							<select class= "col2" name="fournisseur" id="fournisseur" required>
								<option value="" selected="selected"></option>
								<?php	
								$listeFR = SelectionListeVisiblesFR();
								if ($listeFR)
								foreach($listeFR as $cle => $element)
								{
									?>
									<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
									<?php
								}
								?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="categorie">Catégorie* :</label>
							<select class= "col2" name="categorie" id="categorie" required >
								<option value="" selected="selected"></option>
								<?php	
								$listeCategories = SelectionListeCategoriesFilles();
								if($listeCategories)
								foreach($listeCategories as $cle => $element)
								{
									?>
									<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
									<?php
								}
								?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="prix">Prix TTC* :</label>
							<input type="text" class= "col2" name="prix" id="prix" required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="tva">T.V.A. :</label>
							<select class= "col2" name="tva" id="tva">
								<option value="0" selected="selected">0</option>
								<option value="5.5">5.5</option>
								<option value="20">20</option>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="vrac">Vrac :</label>
							<select type="text" class= "col2" name="vrac" id="vrac">
								<option value="0" selected="selected">NON</option>
								<option value="1">OUI</option>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="codeFournisseur">Code fournisseur :</label>
							<input type="text" class= "col2" name="codeFournisseur" id="codeFournisseur" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="commentaire">Commentaire :</label>
							<textarea name="commentaire" id="commentaire" cols="35" rows = "2"></textarea>
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible :</label>
							<select type="text" class= "col2" name="visible" id="visible">
								<option value="1" selected="selected">OUI</option>
								<option value="0">NON</option>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="prix">Alerte stock (quantité, kg, litre) :</label>
							<input type="text" class= "col2" name="alert_stock" id="alert_stock" />
							<label class = "col1" for="alert_stock"><small>laisser vide si pas d'alerte</small></label>
						</p>
					</div>
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





