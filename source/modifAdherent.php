<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>MODIF. ADHÉRENT</title>
    </head>

    <?php
    require ("fonctionsAdherents.php");
    
    $idAdherent = $_GET ["idAdherent"];
    $donnees = SelectionDonneesAdherent ( $idAdherent );
    ?>
    
    <?php include 'menu.php'; ?>
    
    <body>
	<div style="text-align: center">
	    Les champs avec une étoile doivent obligatoirement être renseignés.
	    <div>
		<form id="formulaire" method="post" action="modifAdherentE.php">
		    <input type="hidden" name="idAdherent" value="<?php echo $idAdherent; ?>" />
		    <div id="table">
			<p class="ligne">
			    <label class="col1" for="nom">Nom* : </label>
			    <input type="text" class="col2" name="nom" id="nom"
				   value="<?php echo htmlspecialchars($donnees['NOM']); ?>" autofocus required />
			</p>
			<p class="ligne">
			    <label class="col1" for="prenom">Prénom : </label>
			    <input type="text" class="col2" name="prenom" id="prenom"
				   value="<?php echo htmlspecialchars($donnees['PRENOM']); ?>" />
			</p>
			<p class="ligne">
			    <label class="col1" for="email">Email : </label>
			    <input type="text" class="col2" name="email" id="email"
				   value="<?php echo htmlspecialchars($donnees['MAIL']); ?>" />
			</p>
			<p class="ligne">
			    <label class="col1" for="telephoneFixe">Téléphone fixe : </label>
			    <input type="text" class="col2" name="telephoneFixe" id="telephoneFixe"
				   value="<?php echo htmlspecialchars($donnees['TELEPHONE_FIXE']); ?>" />
			</p>
			<p class="ligne">
			    <label class="col1" for="telephonePortable">Téléphone portable : </label>
			    <input type="text" class="col2" name="telephonePortable" id="telephonePortable"
				   value="<?php echo htmlspecialchars($donnees['TELEPHONE_PORTABLE']); ?>" />
			</p>
			<p class="ligne">
			    <label class="col1" for="adresse">Adresse : </label>
			    <input type="text" class="col2" name="adresse" id="adresse"
				   value="<?php echo htmlspecialchars($donnees['ADRESSE']); ?>" />
			</p>
			<?php
			$ticket = 0;
			if (USE_MAIL) {
			    $ticket = $donnees['TICKET_CAISSE'];
			    echo '<p class = "ligne">
				  <label class = "col1" for="ticket">Envoi ticket de caisse : </label>
				  <select class= "col2" name="ticket" id="ticket" >
					<option value="1"' . (($ticket) ? 'selected' : '') .'>OUI</option>
				       	<option value="0"' . (($ticket) ? '' : 'selected') . '>NON</option>
				  </select></p>';
			    
			}
			?>
			<p class="ligne">
			    <label class="col1" for="commentaire">Commentaire :</label>
			    <textarea name="commentaire" id="commentaire" cols="35" rows="2">
				<?php echo htmlspecialchars($donnees['COMMENTAIRE']); ?></textarea>
			</p>
			<p>
			    <small>Utilisez le mot "cotisation" dans le commentaire, pour que
				celui-ci affiche un rappel à l'adhérent. <br>Par exemple :
				Cotisation non à jour.
			    </small>
			</p>
			<p class="ligne">
			    <label class="col1" for="visible">Inscrit.e : </label>
			    <select class="col2" name="visible" id="visible">
				<?php
				if ($donnees ['VISIBLE'] == '0') {
				?>
				    <option value="1">OUI</option>
				    <option value="0" selected="selected">NON</option>
				<?php
				} else {
				?>
				    <option value="1" selected="selected">OUI</option>
				    <option value="0">NON</option>
				<?php
				}
				?>
			    </select>
			</p>
			<?php
			$stock_alert = $donnees['RECEIVE_ALERT_STOCK'];
			//if null, should be considered like a false
			if ($stock_alert === null) {
			    $stock_alert = 0;
			}
			if (USE_MAIL) {
			    echo '<p class = "ligne">
				  <label class = "col1" for="receive_alert_stock">Recevoir les alertes stock : </label>
				  <select class= "col2" name="receive_alert_stock" id="receive_alert_stock" >
					<option value="1"' . (($stock_alert) ? 'selected' : '') .'>OUI</option>
				       	<option value="0"' . (($stock_alert) ? '' : 'selected') . '>NON</option>
				  </select></p>';
			    
			}
			?>
		    </div>
		    <br />
		    <div id="bouton">
			<p>
			    <input type="submit" value="Modifier" name="modifierAdherent">
			</p>
		    </div>
		</form>
	    </div>
	</div>
    </body>
</html>
