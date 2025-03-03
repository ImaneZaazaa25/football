<?php
require("connexionBDD.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID de l'équipe à supprimer
    $id = $_POST["equipe-id-suppr"];

    // Préparer la requête SQL pour supprimer l'équipe
    $req = $pdo->prepare("DELETE FROM equipe WHERE id = ?");

    // Exécuter la requête
    if ($req->execute([$id])) {
        echo "L'équipe avec l'ID $id a été supprimée avec succès.";
    } else {
        echo "Une erreur est survenue lors de la suppression de l'équipe.";
    }
}
?>
