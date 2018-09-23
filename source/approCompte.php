<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style_default.css" />
	<title>COMPTE</title>
    </head>

    <body>
	<?php include 'menu.php'; ?>

	<?php
	require ("fonctionsAdherents.php");
	require ("fonctionsCompte.php");
	$idAdherent = $_POST ['adherent'];
	$solde = SelectionSoldeAdherentMC ( $idAdherent );
	$donneesAD = SelectionDonneesAdherent ( $idAdherent );
	?>
	
	<div style="text-align: center">
	    Les champs avec une étoile doivent obligatoirement être renseignés.
	    <div>
		<form id="formulaire" method="post" action="approCompteE.php">
		    <div id="table">
			<input type="hidden" name="idAdherent"
value="<?php echo $idAdherent; ?>" />
			<p class="ligne">
			    <label class="col1">Adherent :</label> <input type="text"
class="col2" name="nom" id="nom"
value="<?php echo $donneesAD['PRENOM']. " " . $donneesAD['NOM']; ?>"
readonly="true" />
			</p>
			<p class="ligne">
			    <label class="col1">Solde actuel :</label> <input type="text"
class="col2" name="solde" id="solde"
value="<?php echo round($solde,2); ?>" readonly="true" />
			</p>
			<p class="ligne">
			    <label class="col1" for="versement">Versement* :</label> <input
type="text" class="col2" name="versement" id="versement"
autofocus required />
			</p>
			<br />
			<div id="bouton">
			    <p>
				<input type="submit" value="Enregistrer" name="enregistrerAppro">
			    </p>
			</div>
		    </div>
		</form>
	    </div>
	</div>
    </body>
</html>
