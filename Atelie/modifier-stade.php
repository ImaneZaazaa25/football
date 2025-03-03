<?php
require("connexionBDD.php");

// Vérification si les données sont envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["modify-stade-id"];
    $nouveau_nom = $_POST["modify-stade-name"];
    $nouvelle_ville = $_POST["modify-stade-city"];

    // Préparation de la requête SQL pour modifier un stade
    $query = "UPDATE stade SET NomStade = ?, VilleStade = ? WHERE StadeID = ?";
    $req = $pdo->prepare($query);

    // Liaison des paramètres et exécution de la requête
    if ($req->execute([$nouveau_nom, $nouvelle_ville, $id])) {
        echo "Le stade a été modifié avec succès.";
    } else {
        echo "Une erreur est survenue lors de la modification du stade.";
    }
}
?>
