<?php
require("connexionBDD.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs envoyées par le formulaire
    $id=!empty($_POST["id_j"]) ? $_POST["id_j"] : null;
    $nom = !empty($_POST["nom"]) ? $_POST["nom"] : null;
    $prenom = !empty($_POST["prenom"]) ? $_POST["prenom"] : null;
    $date_naissance = !empty($_POST["date_naissance"]) ? $_POST["date_naissance"] : null;
    $dated = !empty($_POST["date_debut_modif"]) ? $_POST["date_debut_modif"] : null;
    $datef = !empty($_POST["date_fin_modif"]) ? $_POST["date_fin_modif"] : null;
    $tenu = !empty($_POST["tenu_modif"]) ? $_POST["tenu_modif"] : null;
    $equipe = !empty($_POST["id-equipe"]) ? $_POST["id-equipe"] : null;
        

        // Préparer la requête SQL pour mettre à jour les informations du joueur
        $req_update = $pdo->prepare("UPDATE joueur SET NomJoueur = ?, PrenomJoueur = ?, DateNaissance = ? WHERE NumJoueur = ?");
        $req_update2 = $pdo->prepare("UPDATE composer SET NumEquipe = ?, DateD = ? ,DateFin = ? , Numdetenu=? WHERE NumJoueur = ?");
        // Exécuter la requête avec les valeurs (mises à jour ou non)
        $req_update->execute([$nom, $prenom, $date_naissance, $id]);
        $req_update2->execute([$equipe, $dated, $datef, $tenu,$id]);
        header('Location:index.php');
    } 

?>
