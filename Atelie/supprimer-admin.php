<?php
// Démarre la session pour les messages
session_start();

// Inclusion du fichier de connexion à la base de données
require("connexionBDD.php");

// Vérification si les données sont envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $id = $_POST["id"];

    // Préparation de la requête SQL pour supprimer un administrateur
    $query = "DELETE FROM administrateurs WHERE id = ?";
    $req = $pdo->prepare($query);

    // Liaison des paramètres et exécution de la requête
    if ($req->execute([$id])) 
    {
        $_SESSION["message"] = "Succès : L'administrateur a été supprimé avec succès";
        header("Location: index.php");
        exit;
    } 
    else 
    {
        $_SESSION["message"] = "Erreur : Une erreur est survenue lors de la suppression de l'administrateur";
        header("Location: index.php");
        exit;
    }
}

?>