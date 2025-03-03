<?php
// Connexion à la base de données
require('connexionBDD.php');

if (isset($_GET['id-joueur']) && !empty($_GET['id-joueur']) && isset($_GET['id']) && !empty($_GET['id'])) {
    $joueurId = $_GET['id-joueur'];
    $equipeId = $_GET['id'];

    try {
        // Requête SQL pour récupérer les informations du joueur
        $req = $pdo->prepare("SELECT * FROM joueur j, composer c, equipe e WHERE j.NumJoueur = c.NumJoueur AND e.NumEquipe = c.NumEquipe AND c.NumJoueur = ? AND c.NumEquipe = ?");
        $req->execute([$joueurId, $equipeId]);
        $joueur = $req->fetch(PDO::FETCH_ASSOC);

        if ($joueur) {
            // Retourner les informations sous format JSON
            echo json_encode([
                'id' => $joueur['NumJoueur'],
                'nom' => $joueur['NomJoueur'],
                'prenom' => $joueur['PrenomJoueur'],
                'date_naissance' => $joueur['DateNaissance'],
                'date_debut' => $joueur['DateD'],
                'date_fin' => $joueur['DateFin'],
                'num_tenu' => $joueur['NumdeTenu'],
                'num_equipe' => $joueur['NumEquipe']
            ]);
        } else {
            echo json_encode(['error' => 'Joueur non trouvé']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Erreur SQL : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Données manquantes']);
}
?>
