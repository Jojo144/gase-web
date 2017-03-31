<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>FOURNISSEURS</title>
    </head>
    <body>
        <?php include 'menu.php'; ?>
	<?php require("fonctionsFournisseurs.php"); ?>
	<div style="text-align: center">
	    Cliquez sur le nom du fournisseur à modifier.
	    <div>
		<br />
		<?php
		/*
		 * AC 29-01-2016
		 * Ajout d'un bouton pour afficher/masquer les références visibles
		 */
		$all = isset ( $_GET ['all'] ) ? true : false;
		$link = $_SERVER ["SCRIPT_NAME"];
		if (! $all)
		    $link .= '?all';
		?>
		<div class="center">
		    <a href="<?= $link ?>"><?= $all ? 'Masquer les non visibles' : 'Montrer les non visibles' ?></a>
		</div>
		<div class="liste" style="text-align: left">
		    <table>
			<tr>
			    <td><label class="colonne1"><center>
				<strong>NOM</strong>
			    </center></label></td>
			    <td><label class="colonne2"><center>
				<strong>MAIL</strong>
			    </center></label></td>
			    <td><label class="colonne3"><center>
				<strong>CONTACT</strong>
			    </center></label></td>
			    <td><label class="colonne4"><center>
				<strong>TÉLÉPHONE FIXE</strong>
			    </center></label></td>
			    <td><label class="colonne5"><center>
				<strong>TÉLÉPHONE PORTABLE</strong>
			    </center></label></td>
			    <td><label class="colonne6"><center>
				<strong>FAX</strong>
			    </center></label></td>
			    <td><label class="colonne7"><center>
				<strong>VISIBLE</strong>
			    </center></label></td>
			    <td><label class="colonne8"><center>
				<strong>DATE DE RÉFÉRENCEMENT</strong>
			    </center></label></td>
			</tr>
			<?php
			$listeFournisseurs = SelectionListeFournisseurs ( $all );
			if ($listeFournisseurs)
			    foreach ( $listeFournisseurs as $cle => $element ) {
				$donneesFournisseur = SelectionDonneesFournisseur ( $cle );
			?>
			    <tr
				<?= $donneesFournisseur['VISIBLE'] == 0 ? 'class="inactive"' : '' ?>>
				<td>&nbsp;<a href="modifFournisseur.php?idFournisseur=<?php echo  $cle; ?>"
					     title="<?php echo $element; ?>" class="bouton"><?php echo  htmlspecialchars($element); ?></a>&nbsp;</td>
				<td>&nbsp;<label class="colonne2"></label><?php echo  $donneesFournisseur['MAIL']; ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne3"></label><?php echo  $donneesFournisseur['CONTACT']; ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne4"></label><?php echo  $donneesFournisseur['TELEPHONE_FIXE']; ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne5"></label><?php echo  $donneesFournisseur['TELEPHONE_PORTABLE']; ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne6"></label><?php echo  $donneesFournisseur['FAX']; ?>&nbsp;</td>
				<?php
				if ($donneesFournisseur ['VISIBLE'] == 0) {
				?>
				    <td>&nbsp;<label class="colonne10"></label>NON&nbsp;</td>
				<?php
				} else {
				?>
				    <td>&nbsp;<label class="colonne10"></label>OUI&nbsp;</td>
				<?php
				}
				?>
				<td>&nbsp;<label class="colonne8"></label><?php echo  $donneesFournisseur['DATE_REFERENCEMENT']; ?>&nbsp;</td>
			    </tr>
			<?php
			}
			?>
		    </table>
		</div>

    </body>
</html>
