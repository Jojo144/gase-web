<?php
$soldeAdherent = SelectionSoldeAdherentMC ( $_SESSION ['adherent'] );
$nbRefPanier = $_SESSION ['nbRefPanier'];
if ($nbRefPanier == 0) {
    echo "<div>Votre panier est vide.</div>";
} else {
    if ($_SESSION['qteNegative']) {
	echo '<script>alert("Vous avez rentré une quantité négative. Si c\'est une erreur, supprimez la référence de votre panier.");</script>';
	$_SESSION['qteNegative'] = false;
    }
    $prixTotal = $_SESSION ['montantPanier'];
?>
    <form id="formulaire" method="post" action="payer.php">
	<div id="table_reference_list">
	    <table>
		<tr>
		    <td width="80%" align="center"><strong>DÉSIGNATION</strong></td>
		    <td width="10%" align="center"><strong>QUANTITÉ</strong></td>
		    <td width="10%" align="center"><strong>PRIX</strong></td>
		</tr>
		<?php
		for($i = 0; $i < $nbRefPanier; $i ++) {
		?>
		    <tr>
			<td width="78%"><?php echo $_SESSION['panier']['nomReference'][$i];?></td>
			<td width="9%"><?php echo $_SESSION['panier']['qteReference'][$i];?></td>
			<td width="9%"><?php echo round($_SESSION['panier']['prixReference'][$i],2);?></td>
			<td width="4%">
			    <a href="retirer.php?idRef=<?php echo $_SESSION['panier']['idRef'][$i]; ?>">
				<img src="../static/img_trash.png" title="Retirer du panier" alt="X" /></a>
			</td>
		    </tr>
		<?php
		}
		?>			
	    </table>
	</div>
	<br> <br>
	<div <?php if($prixTotal > $soldeAdherent){ ?> style="color: #FF0000">**ATTENTION** Total TTC panier: <?php echo round($prixTotal,2) ?> euros
	<?php }else{ ?>
	    >Total TTC panier: <?php echo round($prixTotal,2) ?> euros
	<?php } ?>
	<input type="submit" value="Payer" name="payer" id="payer">
	</div>

    </form>
<?php
}
?>

