<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="journalDeBord.css" />
<link rel="stylesheet" href="style_default.css" />
<title>JOURNAL DE BORD</title>
</head>

<body>
		<?php include 'menu.php'; ?>

		<?php require 'fonctionsBD.php'; ?>
		<div style="text-align: center">
		<div>
			<form id="formulaire" method="post" action="journalDeBordE.php">
				<div id="table">
					<legend>Éditer l'information :</legend>
					<p class="ligne">
						<textarea name="info" id="info" cols="120" rows="10"><?php echo SelectionMessage($_GET['edit_date']);?></textarea>
					</p>
					<div id="bouton">
						<input type="submit" value="Enregistrer" name="editerJournal">
					</div>
					<div id="bouton">
						<input type="submit" value="Supprimer" name="supprimerJournal" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
					</div>					
				</div>
				<input type="hidden" name="edit_date"
					value="<?php echo $_GET['edit_date'];?>" />
			</form>
		</div>
	</div>
</body>
</html>
