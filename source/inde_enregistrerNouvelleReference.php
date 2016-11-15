<?php
require("inde_fonctionsREF.php");

include 'inde_menu.php';
 
	// Si le formulaire a été envoyé
	if (isset ($_POST['enregistrer'])){
		$designation = $_POST['designation'];
		$designation = trim($designation);		
		$designation = str_replace("'", " ", $designation);
		$designation = strtoupper($designation);
		//La designation est obligatoire
		if(empty($designation)){
			print("<center>La '<b>DESIGNATION/b>' de la référence n\'est pas renseigné ! Création à refaire.</center>");
		}else{
			$fournisseur = $_POST['fournisseur'];	
			if(empty($fournisseur)){
				print("<center>Le '<b>FOURNISSEUR/b>' de la référence n\'est pas renseigné ! Création à refaire.</center>");
			}else{
				$categorie = $_POST['categorie'];
				if(empty($categorie)){
					print("<center>La '<b>CATEGORIE/b>' de la référence n\'est pas renseignée ! Création à refaire.</center>");
				}else{
					$prix = $_POST['prix'];
					$prix = str_replace(",", ".", $prix);
					if(empty($prix)){
						print("<center>Le '<b>PRIX/b>' de la référence n\'est pas renseigné ! Création à refaire.</center>");
					}else{
					    
					    
					    if(! is_numeric($prix)){
				            echo 'ATTENTION la référence n\'est PAS enregistrée car le prix n\'est pas une valeur numerique ! Refaire la creation.';
				        }else{
				            $alert_stock = $_POST['alert_stock'];
				            $alert_stock = str_replace(",", ".", $alert_stock);
				            if($alert_stock != "" && ! is_numeric($alert_stock)){
				                echo 'ATTENTION la référence n\'est PAS enregistrée car le niveau d\'alerte stock n est pas une valeur numerique ! Refaire la creation.';
				            }else{
						        $tva = $_POST['tva'];
						        $vrac = $_POST['vrac'];
						        $codeFournisseur = $_POST['codeFournisseur'];
						        $codeFournisseur = str_replace("'", "_", $codeFournisseur);
						
						        $commentaire = $_POST['commentaire'];
						        $commentaire = trim($commentaire);
						        $commentaire = str_replace("'", "_", $commentaire);
						
						        $visible = $_POST['visible'];
						        
						        EnregistrerNouvelleReference($designation, $fournisseur, $categorie, $prix, $tva, $vrac, $codeFournisseur, $commentaire, $visible, $alert_stock);
							    echo 'Nouvelle référence ' . $designation . ' enregistrée.';
						    }
					    }
					}
				}
			}
		}
	}

?>
