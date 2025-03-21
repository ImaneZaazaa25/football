<?php
require("connexionBDD.php");

// Exemple de code pour récupérer le dernier match avec les noms des équipes
$query = "
SELECT m.NumMatch, e1.NomEquipe AS EquipeDomicile, e2.NomEquipe AS EquipeExterieur, e1.NumEquipe AS NumEquipeDomicile, e2.NumEquipe AS NumEquipeExterieur
FROM matchs m
JOIN equipe e1 ON m.NumEquipeDomicile = e1.NumEquipe
JOIN equipe e2 ON m.NumEquipeExterieur = e2.NumEquipe
ORDER BY m.NumMatch DESC
LIMIT 1
";

$stmt = $pdo->query($query);
$match = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$match) {
    // Si aucun match n'est trouvé
    echo "Aucun match trouvé.";
    exit;
}

// Variable pour afficher le message après le vote
$voteMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numMatch = $_POST['num_match'];
    $teamName = $_POST['team'];

    // Déterminer quel NumEquipe correspond à l'équipe choisie
    if ($teamName === $match['EquipeDomicile']) {
        $numEquipe = $match['NumEquipeDomicile']; // NumEquipe de l'équipe domicile
    } elseif ($teamName === $match['EquipeExterieur']) {
        $numEquipe = $match['NumEquipeExterieur']; // NumEquipe de l'équipe extérieure
    }

    // Mettre à jour le nombre de votes pour l'équipe choisie
    $updateQuery = "
    UPDATE votes
    SET NombreVotes = NombreVotes + 1
    WHERE NumMatch = :numMatch AND NumEquipe = :numEquipe
    ";

    $stmt = $pdo->prepare($updateQuery);
    $stmt->execute([':numMatch' => $numMatch, ':numEquipe' => $numEquipe]);

    // Message de confirmation après avoir voté
    $voteMessage = "Merci pour votre vote!";
}
?>

<!-- Formulaire pour voter -->
<div class="popular_post">
    <div class="sidebar_title"><h2>Sondage du Match</h2></div>
    <ul>
        <li><strong>Match : <?= htmlspecialchars($match['EquipeDomicile']) ?> vs <?= htmlspecialchars($match['EquipeExterieur']) ?></strong></li>
        <li>
            <form method="POST" action="">
                <input type="hidden" name="num_match" value="<?= $match['NumMatch'] ?>">
                <input type="radio" name="team" value="<?= htmlspecialchars($match['EquipeDomicile']) ?>" id="teamA" required>
                <label for="teamA"><?= htmlspecialchars($match['EquipeDomicile']) ?></label>
            </li>
            <li>
                <input type="radio" name="team" value="<?= htmlspecialchars($match['EquipeExterieur']) ?>" id="teamB" required>
                <label for="teamB"><?= htmlspecialchars($match['EquipeExterieur']) ?></label>
            </li>
            <li>
                <button type="submit">Voter</button>
            </li>
        </form>
    </ul>
</div>

<!-- Affichage du message de remerciement après le vote -->
<?php if ($voteMessage): ?>
    <div class="thank-you-message">
        <p><?= htmlspecialchars($voteMessage) ?></p>
    </div>
<?php endif; ?>
