<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<title>COMPTE</title>
    </head>

    <body>
	<?php include 'menu.php'; ?>

	<?php require("fonctionsAdherents.php"); ?>
	<div style="text-align: center">
	    Choisissez le nom d'un adhérent. </br> </br>
	    <form id="formulaire" method="post" action="soldeCompte.php">
		<select name="adherent" id="adherent" onchange="this.form.submit()">
		    <option value="" selected="selected"></option>
		    <?php
		    $listeAD = SelectionListeActifsAD ();
		    if ($listeAD)
			foreach ( $listeAD as $donnees ) {
		    ?>
			<option value="<?php echo $donnees['ID_ADHERENT']; ?>"><?php echo $donnees['PRENOM'] . ' ' . $donnees['NOM']; ?></option>
		    <?php
		    }
		    ?>
		</select>
	    </form>
	</div>
    </body>
</html>


