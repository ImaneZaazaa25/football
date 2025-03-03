<?php

// Démarre la session pour les messages
session_start();

// Inclusion du fichier de connexion à la base de données
require("connexionBDD.php");

// Vérification si les données sont envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $dateNaissance = $_POST["date_naissance"];
    $tournoiId = $_POST["tournoi"];

    // Préparation de la requête SQL pour modifier un administrateur
    $query = "UPDATE administrateurs SET nom = ?, prenom = ?, date_naissance = ?, tournoi_id = ? WHERE id = ?";
    $req = $pdo->prepare($query);

    // Liaison des paramètres et exécution de la requête
    if ($req->execute([$nom, $prenom, $dateNaissance, $tournoiId, $id])) 
    {
        $_SESSION["message"] = "Succès : L'administrateur a été modifié avec succès";
        header("Location: index.php");
        exit;
    } 
    else 
    {
        $_SESSION["message"] = "Erreur : Une erreur est survenue lors de la modification de l'administrateur";
        header("Location: index.php");
        exit;
    }
}
?>