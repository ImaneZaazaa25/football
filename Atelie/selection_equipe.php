<?php
require("connexionBDD.php");

// Préparation de la requête
$req = $pdo->prepare("SELECT NumEquipe,NomEquipe FROM equipe");

// Exécution de la requête
$req->execute();

// Vérification et affichage des options
if ($req->rowCount() > 0) {
    // Parcourir les résultats et générer les options
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row['NumEquipe'] . "'>" . $row['NomEquipe'] . "</option>";
    }
} else {
    echo "<p>Aucune équipe trouvée</p>";
}

// Fermeture de la requête
$req->closeCursor();
?>
