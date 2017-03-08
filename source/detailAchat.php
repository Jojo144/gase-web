<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" /> 
        <title>DÉTAIL ACHAT</title>
    </head>
    <body>
	<?php 
	//require("inde_fonctionsACH.php"); 
	require("fonctionsBD.php"); 
	?>
	<?php include 'menu.php'; ?>
	
    
		<div style="text-align:center">
			<?php
			$idAchats = $_GET["idAch"];
			$infosAchats = SelectionInfosAchats($idAchats);
			//this wasn't workin before nayway, should fix it
			echo  $infosAchats;
			?>
			<br />
			<br />
			<div>
				<table style="margin-left:auto; margin-right:auto; max-width:1000px;">
					<tr>
					   <td><label class="colonne1"><strong>DÉSIGNATION</strong></label></td>
					   <td><label class="colonne2"><strong>PRIX UNITAIRE</strong></label></td>
					   <td><label class="colonne3"><strong>QUANTITÉ</strong></label></td>
					   <td><label class="colonne4"><strong>TOTAL</strong></label></td>
					</tr>
				
					<?php
					$detailsAchats = SelectionDetailsAchats($idAchats);
					foreach( $detailsAchats as $tableau ) 
					{
						?>
						<tr>
							<td><?php echo $tableau['DESIGNATION']; ?></td>
							<td><?php echo $tableau['PRIX_TTC']; ?></td>
							<td><?php echo $tableau['QUANTITE']; ?></td>
							<td><?php echo $tableau['TOTAL']; ?></td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
		<br />
		<center>
		<li>Pour retourner à la liste des achats : <a href="achats2.php">cliquez ici</a></li>
		</center>
	</body>
</html>





