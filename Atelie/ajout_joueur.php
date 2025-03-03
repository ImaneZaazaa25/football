<?php
require('connexionBDD.php');

// Vérifier si toutes les données sont présentes
if (!isset($_POST["nom"], $_POST["prenom"], $_POST["date_naissance"], $_POST["equipe"], $_POST["date_debut"], $_POST["date_fin"], $_POST["tenu"])) {
    die("Erreur : Tous les champs doivent être remplis !");
}

// Récupération et validation des données
$nom = trim($_POST["nom"]);
$prenom = trim($_POST["prenom"]);
$date_naiss = $_POST["date_naissance"];
$equipe = trim($_POST["equipe"]);
$date_deb = $_POST["date_debut"];
$date_fin = $_POST["date_fin"];
$tenu = (int) $_POST["tenu"];

// Vérification des valeurs
if ($nom === '' || $prenom === '' || $date_naiss === '' || $equipe === '' || $date_deb === '' || $date_fin === '' || $tenu === '') {
    die("Erreur : Tous les champs doivent être valides !");
}

// Récupérer l'ID de l'équipe à partir du nom
/*$reqEquipe = $pdo->prepare("SELECT NumEquipe FROM equipe WHERE NomEquipe = ?");
$reqEquipe->execute([$equipe]);
$equipeData = $reqEquipe->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'équipe existe
if (!$equipeData) {
    die("Erreur : L'équipe avec le nom $equipe n'existe pas !");
}

// Récupérer l'ID de l'équipe
$equipeID = $equipeData['NumEquipe'];*/

// Insérer le joueur dans la table `joueur`
$req = $pdo->prepare("INSERT INTO joueur(NomJoueur, PrenomJoueur, DateNaissance) VALUES(?, ?, ?)");
$req->bindValue(1, $nom, PDO::PARAM_STR);
$req->bindValue(2, $prenom, PDO::PARAM_STR);
$req->bindValue(3, $date_naiss, PDO::PARAM_STR);

if ($req->execute()) {
    // Récupérer l'ID du joueur ajouté
    $joueur_id = $pdo->lastInsertId();

    // Insérer dans la table `composer`
    $req_composer = $pdo->prepare("INSERT INTO composer (NumJoueur, NumEquipe, DateD, DateFin, NumdeTenu) VALUES(?, ?, ?, ?, ?)");
    $req_composer->bindValue(1, $joueur_id, PDO::PARAM_INT);
    $req_composer->bindValue(2, $equipe, PDO::PARAM_INT); // Utilisation de l'ID récupéré
    $req_composer->bindValue(3, $date_deb, PDO::PARAM_STR);
    $req_composer->bindValue(4, $date_fin, PDO::PARAM_STR);
    $req_composer->bindValue(5, $tenu, PDO::PARAM_INT);

    if ($req_composer->execute()) {
        // Rediriger vers la page d'accueil après succès
        header("Location: index.php");
        exit();
    } else {
        die("Erreur : Impossible d'ajouter le joueur dans `composer`.");
    }
} else {
    die("Erreur : Impossible d'ajouter le joueur.");
}
?>
