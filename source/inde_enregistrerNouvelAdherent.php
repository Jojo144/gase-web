<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
    </head>
    <body>
        <title>NOUVEL ADHÉRENT</title>
	    <?php require("inde_fonctionsAD.php"); ?>
		<?php include 'inde_menu.php'; ?>


        <?php
	    // Si le formulaire a été envoyé
	    if (isset ($_POST['enregistrer']))
	    {
		    $nom = $_POST['nom'];
		    $nom = trim($nom);
		    $nom = str_replace("'", " ", $nom);
		    $nom = strtoupper($nom);
		
		    if(empty($nom)){
			    print("<center>Le '<b>NOM</b>' de l'adhérent n'est pas renseigné ! Création à refaire.</center>");
		    }else{
			    $ticket = $_POST['ticket'];
			    $email = $_POST['email'];
			    if(($ticket == 1) && (empty($email))){
				    print("<center>Pour envoyer un ticket de caisse, il faut renseigner l'email ! Création à refaire.</center>");
			    }else{
				    $prenom = $_POST['prenom'];
				    $prenom = trim($prenom);
				    $prenom = str_replace("'", "_", $prenom);

				    $telephone_fixe = $_POST['telephone_fixe'];
				    $telephone_portable = $_POST['telephone_portable'];

				    $adresse = $_POST['adresse'];
				    $adresse = trim($adresse);
				    $adresse = str_replace("'", "_", $adresse);

				    $commentaire = $_POST['commentaire'];
				    $commentaire = trim($commentaire);
				    $commentaire = str_replace("'", "_", $commentaire);

				    $visible = $_POST['visible'];

				    EnregistrerNouvelAdherent($nom, $prenom, $email, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible);
				    echo 'Nouvel adhérent ' . $prenom . ' ' . $nom . ' enregistré.';
			    }
		    }
	    }
        ?>
	</body>
</html>
