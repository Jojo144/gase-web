<?php
require("inde_fonctionsCAT.php");

include 'inde_menu.php';
 
	// Si le formulaire a �t� envoy�
	if (isset ($_POST['enregistrer']))
	{
		$nom = $_POST['nom'];
		$nom = stripslashes(str_replace("'", "_", $nom));
		$nom = strtoupper($nom);
		if(empty($nom))
		{
			print("<center>Le '<b>NOM</b>' de la categorie n est pas renseigne !</center>");
		}
		else
		{
			$sousCategorie = $_POST['sousCategorie'];
			if($sousCategorie == 0) // creation d'une cat�gorie m�re
			{
				EnregistrerNouvelleCategorie($nom);
				echo 'Nouvelle categorie ' . $nom . ' enregistree.';
			}
			else // cr�ation d'une sous-cat�gorie
			{
				$idCatSup = $_POST['idCatSup'];
				if(empty($idCatSup))
				{
					print("<center>Le nom de la '<b>CATEGORIE MERE</b>' n est pas renseigne !</center>");
				}
				else
				{
					EnregistrerNouvelleSousCategorie($nom, $idCatSup);
					echo 'Nouvelle sous-categorie ' . $nom . ' enregistree.';
				}
			}
		}
	}
?>