<?php
require("connexionBDD.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["num_match"], $_POST["team"])) {
    $num_match = $_POST["num_match"];
    $team = $_POST["team"];

    // Trouver le numéro de l'équipe
    $stmt = $pdo->prepare("SELECT NumEquipe FROM equipe WHERE NomEquipe = ?");
    $stmt->execute([$team]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $num_equipe = $row["NumEquipe"];

        // Vérifier si l'équipe a déjà un vote pour ce match
        $stmt = $pdo->prepare("SELECT * FROM votes WHERE NumMatch = ? AND NumEquipe = ?");
        $stmt->execute([$num_match, $num_equipe]);
        $vote = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($vote) {
            // Mettre à jour le nombre de votes
            $stmt = $pdo->prepare("UPDATE votes SET NombreVotes = NombreVotes + 1 WHERE NumMatch = ? AND NumEquipe = ?");
            $stmt->execute([$num_match, $num_equipe]);
        } else {
            // Ajouter un nouveau vote
            $stmt = $pdo->prepare("INSERT INTO votes (NumMatch, NumEquipe, NombreVotes) VALUES (?, ?, 1)");
            $stmt->execute([$num_match, $num_equipe]);
        }

        echo json_encode(["success" => true, "message" => "Vote enregistré avec succès !"]);
    } else {
        echo json_encode(["success" => false, "message" => "Équipe introuvable."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Requête invalide."]);
}
?>
