
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
    </head>
    <body>
        <title>MODIF. ADHERENT</title>
	    <?php require("fonctionsAdherents.php"); ?>
		<?php include 'menu.php'; ?>

        <?php
        // Si le formulaire a été envoyé
        if (isset ($_POST['modifierAdherent']))
        {
	        $idAdherent= $_POST['idAdherent'];
	
	        $nom = $_POST['nom'];
	        $nom = trim($nom);
	        $nom = str_replace("'", "_", $nom);
	        //$nom = mb_strtoupper($nom);
	
	        if(empty($nom)){
		        print("<center>Le '<b>NOM</b>' de l\'adherent n\'est pas renseigné ! Création à refaire.</center>");
	        }else{
	                //$ticket = $_POST['ticket'];
                	$ticket = 0;
		        $email = $_POST['email'];
		        if(empty($email) && $ticket == 1){
				    print("<center>Pour envoyer un ticket de caisse, il faut renseigner l '<b>EMAIL</b>' ! Modifications non effectuée</center>");
		        }else{
			        $prenom = $_POST['prenom'];
			        $prenom = trim($prenom);
			        $prenom = str_replace("'", "_", $prenom);
			
			        $email = $_POST['email'];
			        $telephone_fixe = $_POST['telephoneFixe'];
			        $telephone_portable = $_POST['telephonePortable'];
			
			        $adresse = $_POST['adresse'];
			        $adresse = trim($adresse);
			        $adresse = str_replace("'", "_", $adresse);
			
			        $commentaire = $_POST['commentaire'];
			        $commentaire = trim($commentaire);
			        $commentaire = str_replace("'", "_", $commentaire);
			
			        $visible = $_POST['visible'];
			        //$receive_alert_stock = $_POST['receive_alert_stock'];
			        $receive_alert_stock = 0;
			
			        MajAdherent($idAdherent, $nom, $prenom, $email, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible, $receive_alert_stock);
			        echo '<p style="text-align:center">Mise a jour des donnees de ' . $prenom . ' ' . $nom . ' enregistrée.</p>';
		        }
	        }
        }
        ?>

	</body>
</html>
