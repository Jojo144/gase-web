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

		<div style="text-align: center">
		<div>
			<form id="formulaire" method="post" action="journalDeBordE.php">
				<div id="table">
					<legend>Nouvelle information :</legend>
					<p class="ligne">
						<textarea name="info" id="info" cols="120" rows="10"></textarea>
					</p>
					<div id="bouton">
						<input type="submit" value="Enregistrer"
							name="enregistrerInfoOutil">
					</div>
				</div>
			</form>
		</div>
		</div>
		
		<?php
		require 'fonctionsBD.php';
		
		// Affiche la liste de tous les messages
		$listeMessages = SelectionListeMessages ();
		if (count ( $listeMessages ) > 0) {
			echo "<table>
				<tr>
					<td><label class='colonne1'><center><strong>DATE</strong></center></label></td>
					<td><label class='colonne2'><center><strong>MESSAGE</strong></center></label></td>
				</tr>";
			foreach ( $listeMessages as $message ) {
				echo "<tr>
					<td><label class='colonne1'><center><strong> {$message['DATE']} </strong></center></label></td>
					<td><label class='colonne2'>" . nl2br(htmlspecialchars($message['MESSAGE'])) . "</label></td>
					<td><label class='colonne3'> <a href='journalDeBordEdit.php?edit_date={$message['DATE']}'><img src='../static/img_edit.png' title='Éditer l entrée' alt='Éditer' /></a></label></td>
					</tr>";
			}
			echo "</table>";
		} ?>
	</body>
</html>
