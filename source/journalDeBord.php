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
		require ("fonctionsBD.php");
		if (isset ( $_GET ['remove_date'] )) {
			// delete an entry
			RemoveMessage ( $_GET ['remove_date'] );
		}
		$listeMessages = SelectionListeMessages ();
		if (count ( $listeMessages ) > 0) {
			?>
			<table>
		<tr>
			<td><label class="colonne1"><center>
						<strong>DATE</strong>
					</center></label></td>
			<td><label class="colonne2"><center>
						<strong>MESSAGE</strong>
					</center></label></td>
		</tr>
				<?php
			foreach ( $listeMessages as $message ) {
				?>
					<tr>
			<td><label class="colonne1"><center>
						<strong><?php echo $message['DATE']; ?></strong>
					</center></label></td>
			<td><label class="colonne2"><?php echo nl2br(htmlspecialchars($message['MESSAGE'])); ?></label></td>
			<td><label class="colonne3"> <a
					href="journalDeBord.php?remove_date=<?php echo $message['DATE']; ?>"><img
						src="../static/img_trash.png" title="Suprimer l'entrée" alt="X" /></a>
			</label></td>
			<td><label class="colonne4"> <a
					href="journalDeBordEdit.php?edit_date=<?php echo $message['DATE']; ?>"><img
						src="../static/img_edit.png" title="Éditer l'entrée" alt="Éditer" /></a>
			</label></td>
		</tr>
					<?php
			}
			?>
			</table>
			<?php
		}
		?>	
	</body>
</html>
