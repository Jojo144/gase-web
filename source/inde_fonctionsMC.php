<?php
	require("fonctions_bd_gase.php");
	
	/*
	 * AC 15-04-2016 nouvelle connexion mysql
	 * AC 02-05-2016 fonction globale requete() + DB_PREFIX
	 */
	
	function SelectionSoldeAdherentMC($idAdherent)
	{
		$result = requete("SELECT SOLDE FROM ".DB_PREFIX."COMPTES WHERE ID_ADHERENT='$idAdherent' AND DATE = (SELECT MAX(DATE) FROM ".DB_PREFIX."COMPTES WHERE ID_ADHERENT= '$idAdherent')");
		$solde = 0;
		while ( $row = $result->fetch())
		{
			$solde = $row["SOLDE"];
		}		
		
		return $solde;
	}
	
	function SelectionVersementsMC($idAdherent)
	{
		$result = requete("SELECT MONTANT,DATE FROM ".DB_PREFIX."COMPTES WHERE ID_ADHERENT='$idAdherent' AND OPERATION = 'APPROVISIONNEMENT' UNION SELECT -MONTANT,DATE FROM ".DB_PREFIX."COMPTES WHERE ID_ADHERENT='$idAdherent' AND OPERATION = 'DEPENSE' ORDER BY 2 DESC ");
		$tabVersements = [];
		while ( $row = $result->fetch())
		{
			$tabVersements[$row["DATE"]] = $row["MONTANT"];
		}
		
		return $tabVersements;
	}
	
	function ApprovisionnementMC($idAdherent, $somme)
	{
		$nouveauSolde = SelectionSoldeAdherentMC($idAdherent) + $somme;
		$nouveauSolde = str_replace(",", ".", $nouveauSolde);
		$somme = str_replace(",", ".", $somme);

		$requete = "INSERT INTO ".DB_PREFIX."COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherent','$nouveauSolde',NOW(),'APPROVISIONNEMENT','$somme')";
		$result = requete($requete);		

		
	}
	
	
	function DepenseMC($idAdherent, $somme)
	{
		$nouveauSolde = SelectionSoldeAdherentMC($idAdherent) - $somme;
		$nouveauSolde = str_replace(",", ".", $nouveauSolde);
		$somme = str_replace(",", ".", $somme);

		$requete = "INSERT INTO ".DB_PREFIX."COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherent','$nouveauSolde',NOW(),'DEPENSE','$somme')";
		$result = requete($requete);	

		
	}
	
?>
