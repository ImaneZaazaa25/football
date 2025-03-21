<?php
require("connexionBDD.php");

// Récupérer le dernier NumMatch
$queryLastMatch = "SELECT NumMatch FROM votes ORDER BY NumMatch DESC LIMIT 1";
$stmtLastMatch = $pdo->prepare($queryLastMatch);
$stmtLastMatch->execute();
$lastMatch = $stmtLastMatch->fetch(PDO::FETCH_ASSOC);

if ($lastMatch) {
    $num_match = $lastMatch['NumMatch'];  // Le dernier NumMatch

    // Récupérer les résultats des deux équipes pour ce dernier match
    $query = "
    SELECT e.NomEquipe, COALESCE(v.NombreVotes, 0) AS NombreVotes
    FROM equipe e
    LEFT JOIN votes v ON v.NumEquipe = e.NumEquipe AND v.NumMatch = ?
    WHERE e.NumEquipe IN (
        SELECT DISTINCT NumEquipe FROM votes WHERE NumMatch = ?
    )
    ORDER BY NombreVotes DESC
    LIMIT 2
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$num_match, $num_match]);
    $votes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($votes);  // Retourner les résultats au format JSON
} else {
    echo json_encode(["success" => false, "message" => "Aucun match trouvé."]);
}
?>
