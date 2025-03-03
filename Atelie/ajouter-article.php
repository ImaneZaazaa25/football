<?php
// Démarre la session pour les messages
session_start();

// Inclusion du fichier de connexion à la base de données
require("connexionBDD.php");

// Vérification si les données sont envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $titre = $_POST["titre"];
    $these = $_POST["these"];
    $contenu = $_POST["contenu"];

    // Gestion de l'image (optionnelle)
    $imagePath = null;
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) 
    {
        $uploadDir = "C:\\Users\\LENOVO\\Desktop\\Atelie_Ikram\\ajouter-image.php\\"; 
        // Dossier où stocker les images
        $imageName = uniqid() . "-" . basename($_FILES["image"]["name"]);
        $imagePath = $uploadDir . $imageName;
        // Déplace le fichier uploadé vers le dossier
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    // Préparation de la requête SQL pour ajouter un article
    $query = "INSERT INTO articles (titre, these, contenu, image) VALUES (?, ?, ?, ?)";
    $req = $pdo->prepare($query);

    // Liaison des paramètres et exécution de la requête
    if ($req->execute([$titre, $these, $contenu, $imagePath])) 
    {
        $_SESSION["message"] = "Succès : L'article a été ajouté avec succès";
        header("Location: index.php");
        exit;
    } 
    else 
    {
        $_SESSION["message"] = "Erreur : Une erreur est survenue lors de l'ajout de l'article";
        header("Location: index.php");
        exit;
    }
}
?>