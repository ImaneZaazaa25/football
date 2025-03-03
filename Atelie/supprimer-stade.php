<?php
require("connexionBDD.php");

// Vérification si les données sont envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["supp-stade-id"];

    // Préparation de la requête SQL pour supprimer un stade
    $req = $pdo->prepare("DELETE FROM stade WHERE StadeID = ?");

    // Exécution de la requête
    if ($req->execute([$id])) {
        echo "Le stade a été supprimé avec succès.";
    } else {
        echo "Une erreur est survenue lors de la suppression du stade.";
    }
}
?>
