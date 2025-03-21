<?php 
require("connexionBDD.php");

try {
    // Récupérer le dernier match voté avec les résultats
    $query = "
    SELECT e.NomEquipe, v.NombreVotes
    FROM votes v
    JOIN equipe e ON v.NumEquipe = e.NumEquipe
    WHERE v.NumMatch = (SELECT MAX(NumMatch) FROM votes)
    ORDER BY v.NombreVotes DESC
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $votes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des résultats ont été récupérés
    if ($votes) {
        echo json_encode($votes);
    } else {
        echo json_encode(["message" => "Aucun vote trouvé."]);
    }
} catch (PDOException $e) {
    // Si une erreur se produit avec la requête SQL
    echo json_encode(["error" => "Erreur de base de données : " . $e->getMessage()]);
}
?>
