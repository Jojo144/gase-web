<?php
require ("fonctionsCompte.php");

// Si le formulaire a été envoyé
if (isset ( $_POST ['enregistrerAppro'] )) {
    $idAdherent = $_POST ['idAdherent'];
    
    $versement = $_POST ['versement'];
    $versement = trim ( $versement );
    $versement = str_replace ( ",", ".", $versement );
    
    if (is_numeric ( $versement )) {
	if ($versement <= 0) {
	echo '<script>alert("Vous avez rentré un versement négatif. Cette fonctionnalité est réservée à la com\' treso. Si c\'est une erreur, merci d\'appeler la com info au secours.");</script>';
    }
    ApprovisionnementMC ( $idAdherent, $versement );
    include ('approCompteE2.php');
    } else {
	echo 'La somme indiquee n\'est pas une valeur numérique.';
    }
}

?>
