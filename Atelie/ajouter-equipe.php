<?php
require("connexionBDD.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs envoyées par le formulaire
    $nom = $_POST["equipe-name"];
    $date_creation = $_POST["equipe-date-creation"];
    $ville = $_POST["equipe-city"];

    // Préparer la requête SQL pour insérer une nouvelle équipe
    $req = $pdo->prepare("INSERT INTO equipe (NomEquipe, DateCreation, Ville) VALUES (?, ?, ?)");

    // Exécuter la requête
    if ($req->execute([$nom, $date_creation, $ville])) {
        echo "L'équipe a été ajoutée avec succès.";
    } else {
        echo "Une erreur est survenue lors de l'ajout de l'équipe.";
    }
}
?>
