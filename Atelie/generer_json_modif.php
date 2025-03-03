<?php
require("connexionBDD.php");

header('Content-Type: application/json'); // Indique que la réponse est du JSON

if (isset($_GET['joueur-id'])) {
    $joueurId = $_GET['joueur-id'];

    try {
        $req = $pdo->prepare("SELECT NomJoueur, PrenomJoueur, DateNaissance, DateD, DateFin, NumdeTenu FROM joueur WHERE idJoueur = ?");
        $req->execute([$joueurId]);

        // Vérifie si des données ont été trouvées
        $joueurData = $req->fetch(PDO::FETCH_ASSOC);

        if ($joueurData) {
            echo json_encode($joueurData); // Retourne les données sous forme JSON
        } else {
            echo json_encode(['error' => 'Aucun joueur trouvé']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Erreur serveur : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID joueur manquant']);
}
?>
