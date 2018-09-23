<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>ADHERENTS</title>
    </head>
    <body>
	<?php include 'menu.php'; ?>
	<?php require("fonctionsAdherents.php");
	$all = isset ( $_GET ['all'] ) ? true : false;
	$link = $_SERVER ["SCRIPT_NAME"];
	if (! $all)
	    $link .= '?all';
    ?>
	
	<div style="text-align: center">
	    Cliquez sur le nom d'un adhérent pour modifier ses données. <br> <br>
	    <a href="<?= $link ?>"><?= $all ? 'Masquer les non inscrits' : 'Montrer les non inscrits' ?></a>
	    <div>
		<br />
		<div class="liste" style="text-align: left">
		    <table>
			<tr>
			    <td><label class="colonne1"><center>
				<strong>NOM</strong>
			    </center></label></td>
			    <td><label class="colonne2"><center>
				<strong>PRÉNOM</strong>
			    </center></label></td>
			    <td><label class="colonne3"><center>
				<strong>EMAIL</strong>
			    </center></label></td>
			    <td><label class="colonne4"><center>
				<strong>TÉLÉPHONE PORTABLE</strong>
			    </center></label></td>
			    <td><label class="colonne5"><center>
				<strong>TÉLÉPHONE FIXE</strong>
			    </center></label></td>
			    <td><label class="colonne6"><center>
				<strong>DATE INSCRIPTION</strong>
			    </center></label></td>
			</tr>
			<?php
			$listeADherents = SelectionListeAdherents ($all);
			if ($listeADherents)
			    foreach ( $listeADherents as $cle => $element ) {
				$donneesAd = SelectionDonneesAdherent ( $cle );
			?>
			    <tr <?= $donneesAd['VISIBLE'] == 0 ? 'class="inactive"' : '' ?>>
				<td>&nbsp;<a href="modifAdherent.php?idAdherent=<?php echo  $cle; ?>"
					     title="<?php echo $element; ?>" class="bouton"><?php echo  htmlspecialchars($element); ?></a>&nbsp;</td>
				<td>&nbsp;<label class="colonne2"></label><?php echo  htmlspecialchars($donneesAd['PRENOM']); ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne3"></label><?php echo  htmlspecialchars($donneesAd['MAIL']); ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne4"></label><?php echo  htmlspecialchars($donneesAd['TELEPHONE_PORTABLE']); ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne5"></label><?php echo  htmlspecialchars($donneesAd['TELEPHONE_FIXE']); ?>&nbsp;</td>
				<td>&nbsp;<label class="colonne5"></label><?php echo  $donneesAd['DATE_INSCRIPTION']; ?>&nbsp;</td>
			    </tr>
			<?php
			}
			?>
		    </table>
		</div>
    </body>
</html>
