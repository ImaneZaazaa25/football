<?php
require('connexionBDD.php');

// Préparer la requête pour récupérer les équipes et les joueurs
$joueurs_par_equipe = [];

try {
    $req = $pdo->prepare("SELECT e.NumEquipe, e.NomEquipe, j.NumJoueur, j.NomJoueur, j.PrenomJoueur 
                        FROM equipe e, joueur j, composer c
                        WHERE e.NumEquipe = c.NumEquipe 
                        AND j.NumJoueur = c.NumJoueur");
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        die("Aucune donnée trouvée");
    }

    // Organiser les joueurs par équipe
    foreach ($result as $row) {
        $numEquipe = $row['NumEquipe'];
        $nomEquipe = $row['NomEquipe'];

        // Si l'équipe n'existe pas dans le tableau, on l'initialise
        if (!isset($joueurs_par_equipe[$numEquipe])) {
            $joueurs_par_equipe[$numEquipe] = [
                'NomEquipe' => $nomEquipe,
                'Joueurs' => []
            ];
        }

        // Ajouter le joueur à l'équipe
        $joueurs_par_equipe[$numEquipe]['Joueurs'][] = [
            'NumJoueur' => $row['NumJoueur'],
            'NomJoueur' => $row['NomJoueur'],
            'PrenomJoueur' => $row['PrenomJoueur']
        ];
    }

} catch (Exception $e) {
    die("Erreur de base de données : " . $e->getMessage());
}

// Générer et renvoyer le contenu JSON directement
echo json_encode($joueurs_par_equipe);
?>
