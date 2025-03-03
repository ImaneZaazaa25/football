<?php
require("connexionBDD.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs envoyées par le formulaire
    $id = $_POST["modify-id"];
    $nom = !empty($_POST["modify-name"]) ? $_POST["modify-name"] : null;
    $ville = !empty($_POST["modify-city"]) ? $_POST["modify-city"] : null;

    // Récupérer les informations actuelles de l'équipe à partir de la base de données
    $req = $pdo->prepare("SELECT nom, ville FROM equipe WHERE id = ?");
    $req->execute([$id]);
    $equipe = $req->fetch();

    // Vérifier si l'équipe existe
    if ($equipe) {
        // Si un champ est vide, on laisse la valeur actuelle de la base
        $nom = $nom ? $nom : $equipe['nom'];
        $ville = $ville ? $ville : $equipe['ville'];

        // Préparer la requête SQL pour mettre à jour les informations de l'équipe
        $req_update = $pdo->prepare("UPDATE equipe SET nom = ?, ville = ? WHERE id = ?");

        // Exécuter la requête
        if ($req_update->execute([$nom, $ville, $id])) {
            echo "L'équipe avec l'ID $id a été modifiée avec succès.";
        } else {
            echo "Une erreur est survenue lors de la modification de l'équipe.";
        }
    } else {
        echo "Aucune équipe trouvée avec l'ID $id.";
    }
}
?>
