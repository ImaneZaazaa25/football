<?php
require("connexionBDD.php");

// Vérification si les données sont envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["stade-name"];
    $ville = $_POST["stade-city"];
    $capacite = $_POST["stade-capacity"];

    // Préparation de la requête SQL pour ajouter un stade
    $req = $pdo->prepare("INSERT INTO stade (NomStade, VilleStade, Capacite) VALUES (?, ?, ?)");

    // Liaison des paramètres et exécution de la requête
    if ($req->execute([$nom, $ville, $capacite])) {
        echo "Le stade a été ajouté avec succès.";
    } else {
        echo "Une erreur est survenue lors de l'ajout du stade.";
    }
}
?>
