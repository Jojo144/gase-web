<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<link rel="stylesheet" href="style_form.css" />
	<title>ACHATS</title>
    </head>

    <?php
    require ("fonctionsAdherents.php");
    
    if (isset ( $_POST ['adherent'] )) {
	$_SESSION ['adherent'] = $_POST ['adherent'];
    }
    
    $identiteAdherent = SelectionPrenomNomAdherent ( $_SESSION ['adherent'] );
    $data = SelectionDonneesAdherent ( $_SESSION ['adherent'] );
    
    $_SESSION ['montantPanier'] = 0;
    $_SESSION ['nbRefPanier'] = 0;
    $_SESSION ['panier'] ['idRef'] = array ();
    $_SESSION ['panier'] ['nomReference'] = array ();
    $_SESSION ['panier'] ['qteReference'] = array ();
    $_SESSION ['panier'] ['prixReference'] = array ();
    
    ?>
    
    <body>
        <?php include 'menuAchats.php'; ?>
	Bonjour <strong><?php echo $identiteAdherent; ?></strong>
	<br> Choisissez une catégorie de produits pour commencer vos achats.
	<br>
	<?php
	// si retard ou cotisation détecté, écrire en rouge !!
	if (stripos ( $data ["COMMENTAIRE"], "retard" ) !== false || stripos ( $data ["COMMENTAIRE"], "cotisation" ) !== false) {
	    echo "<div style=\"color:red;font-weight:bold;text-align:center;\">" . $data ["COMMENTAIRE"] . "</div>";
	} else {
	    echo "<div>" . $data ["COMMENTAIRE"] . "</div>";
	}
	?>
	<br>
	<br> Historique de vos achats :
	<br>
	<br>
	
	<?php
	$listeAchats = SelectionListeAchatsAdherent ( $_SESSION ['adherent'] );
	if (count ( $listeAchats ) != 0) {
	?>
	    
	    <div id="table_achats_list">
		<table>
		    <tr>
			<td><label><strong>ID</strong></label></td>
			<td><label><strong>Montant TTC</strong></label></td>
			<td><label><strong>Nb references</strong></label></td>
			<td><label><strong>Date achats</strong></label></td>
		    </tr>
		    
		    <?php
		    foreach ( $listeAchats as $tableau ) {
		    ?>
			<tr>
			    <td><?php echo "&nbsp;".$tableau['ID_ACHATS']."&nbsp;"; ?></td>
			    <td><?php echo "&nbsp;".$tableau['MONTANT']."&nbsp;"; ?></td>
			    <td><?php echo "&nbsp;".$tableau['NB_ARTICLES']."&nbsp;"; ?></td>
			    <td><?php echo "&nbsp;".$tableau['DATE_ACHATS']."&nbsp;"; ?></td>
			    <td><a
href="detailAchat.php?idAch=<?php echo $tableau['ID_ACHATS']; ?>"
class="bouton">Voir le detail</a></td>
			</tr>
		    <?php
		    }
		    ?>
		</table>
	    </div>
	<?php
	} else {
	    echo 'Aucun achat pour le moment.';
	}
	?>
    </body>
</html>
