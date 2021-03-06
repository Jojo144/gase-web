<?php
require ("fonctionsBD.php");

/*
 * AC 15-04-2016 nouvelle connexion mysql
 * AC 02-05-2016 fonction globale requete() + DB_PREFIX
 */

/*
 * AC 29-01-2016
 * - ajout d'un paramètre $all pour filtrer les non-visibles
 * - retourne également la colonne VISIBLE
 */
function SelectionListeFournisseurs($all = false) {
    if ($all)
	$sql = "SELECT ID_FOURNISSEUR, NOM FROM " . DB_PREFIX . "FOURNISSEURS ORDER BY NOM";
    else
	$sql = "SELECT ID_FOURNISSEUR, NOM FROM " . DB_PREFIX . "FOURNISSEURS WHERE VISIBLE=1 ORDER BY NOM";
    $result = requete ( $sql );
    $listeAdherents = NULL;
    while ( $row = $result->fetch () ) {
	$listeAdherents [$row ["ID_FOURNISSEUR"]] = $row ["NOM"];
    }
    return $listeAdherents;
}
function EnregistrerNouveauFournisseur($nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible) {
    global $mysql;
    $nom = $mysql->quote($nom);
    $mail = $mysql->quote($mail);
    $adresse = $mysql->quote($adresse);
    $contact = $mysql->quote($contact);
    $telephoneFixe = $mysql->quote($telephoneFixe);
    $telephonePortable = $mysql->quote($telephonePortable);
    $fax = $mysql->quote($fax);
    $commentaire = $mysql->quote($commentaire);
    $requete = "INSERT INTO " . DB_PREFIX . "FOURNISSEURS (NOM, MAIL, ADRESSE, CONTACT, TELEPHONE_FIXE, TELEPHONE_PORTABLE, FAX, COMMENTAIRE, DATE_REFERENCEMENT, VISIBLE) values($nom,$mail,$adresse,$contact,$telephoneFixe,$telephonePortable, $fax, $commentaire, NOW(),'$visible')";
    requete ( $requete );
}
function SelectionDonneesFournisseur($idFournisseur) {
    $result = requete ( "SELECT NOM, MAIL, CONTACT, ADRESSE, TELEPHONE_FIXE, TELEPHONE_PORTABLE, FAX, COMMENTAIRE, VISIBLE, DATE_REFERENCEMENT FROM " . DB_PREFIX . "FOURNISSEURS WHERE ID_FOURNISSEUR= '$idFournisseur'" );
    $donnees = NULL;
    while ( $row = $result->fetch () ) {
	$donnees ['NOM'] = $row [0];
	$donnees ['MAIL'] = $row [1];
	$donnees ['CONTACT'] = $row [2];
	$donnees ['ADRESSE'] = $row [3];
	$donnees ['TELEPHONE_FIXE'] = $row [4];
	$donnees ['TELEPHONE_PORTABLE'] = $row [5];
	$donnees ['FAX'] = $row [6];
	$donnees ['COMMENTAIRE'] = $row [7];
	$donnees ['VISIBLE'] = $row [8];
	$donnees ['DATE_REFERENCEMENT'] = $row [9];
    }
    return $donnees;
}
function MajFournisseur($idFournisseur, $nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible) {
    global $mysql;
    $nom = $mysql->quote($nom);
    $mail = $mysql->quote($mail);
    $adresse = $mysql->quote($adresse);
    $contact = $mysql->quote($contact);
    $telephoneFixe = $mysql->quote($telephoneFixe);
    $telephonePortable = $mysql->quote($telephonePortable);
    $fax = $mysql->quote($fax);
    $commentaire = $mysql->quote($commentaire);
    $requete = "UPDATE " . DB_PREFIX . "FOURNISSEURS SET NOM = $nom, MAIL=$mail, CONTACT=$contact, ADRESSE = $adresse, TELEPHONE_FIXE = $telephoneFixe, TELEPHONE_PORTABLE = $telephonePortable, FAX = $fax, COMMENTAIRE = $commentaire, VISIBLE = '$visible' WHERE ID_FOURNISSEUR = '$idFournisseur'";
    requete ( $requete );
}
function SelectionListeVisiblesFR() {
    $result = requete ( "SELECT ID_FOURNISSEUR, NOM FROM " . DB_PREFIX . "FOURNISSEURS WHERE VISIBLE = 1 ORDER BY NOM" );
    $listeAdherents = NULL;
    while ( $row = $result->fetch () ) {
	$listeAdherents [$row ["ID_FOURNISSEUR"]] = $row ["NOM"];
    }
    return $listeAdherents;
}
function SelectionNomFournisseur($idFournisseur) {
    $result = requete ( "SELECT NOM FROM " . DB_PREFIX . "FOURNISSEURS WHERE ID_FOURNISSEUR = '$idFournisseur'" );
    $nom = NULL;
    while ( $row = $result->fetch () ) {
	$nom = $row ["NOM"];
    }
    return $nom;
}

?>

