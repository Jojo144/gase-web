
<link rel="stylesheet" type="text/css" href="menuAchats.css" />

<?php
require ("fonctionsCategories.php");
$listeCategories = SelectionListeCategoriesMenu ();
?>
<div id="menu_achats">
    <ul>
	<li><a href="index.php">Accueil</a></li>
	<?php
	foreach ( $listeCategories as $tableau ) {
	    if (($tableau ['SOUS_CATEGORIES'] == '0') && (empty ( $tableau ['ID_CAT_SUP'] ))) {
	?>
	    <li><a href="achats.php?idCategorie=<?php echo $tableau['ID_CATEGORIE']; ?>"><?php echo htmlspecialchars($tableau['NOM']);?></a></li>
	<?php
	} else if ($tableau ['SOUS_CATEGORIES'] != '0') {
	?>
	    <li><a href="#"><?php echo htmlspecialchars($tableau['NOM']); ?></a>
		<ul>
		    <?php
		    $listeSousCategories = SelectionListeSousCategories ( $tableau ['ID_CATEGORIE'] );
		    foreach ( $listeSousCategories as $tableauSous ) {
		    ?>
			<li>
			    <a href="achats.php?idCategorie=<?php echo $tableauSous['ID_CATEGORIE']; ?>"><?php echo htmlspecialchars($tableauSous['NOM']);?></a>
			</li>
		    <?php
		    }
		    ?>
		</ul></li>
	<?php
	}
	}
	?>				
    </ul>
</div>
