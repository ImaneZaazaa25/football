<?php
require("connexionBDD.php");
$sql = "SELECT 
    m.NumMatch,
    m.DateMatch,
    m.NombreSpectateur,
    e1.NomEquipe AS EquipeDomicile,  
    e2.NomEquipe AS EquipeExterieur,  
    t.NomTournoi,  
    e1.NomImage AS ImageDomicile,  
    e2.NomImage AS ImageExterieur,  
    m.NumTournoi,
    m.Num_Stade,
    m.Num_Arbitre,
    COALESCE(SUM(CASE WHEN e1.NumEquipe = j.NumEquipe THEN 1 ELSE 0 END), 0) AS ScoreEquipeDomicile,
    COALESCE(SUM(CASE WHEN e2.NumEquipe = j.NumEquipe THEN 1 ELSE 0 END), 0) AS ScoreEquipeExterieur
FROM matchs m
JOIN equipe e1 ON m.NumEquipeDomicile = e1.NumEquipe
JOIN equipe e2 ON m.NumEquipeExterieur = e2.NumEquipe
JOIN tournoi t ON m.NumTournoi = t.NumTournoi  
JOIN stade s ON m.Num_Stade = s.Num_Stade
JOIN arbitre a ON m.Num_Arbitre = a.Num_Arbitre
LEFT JOIN but b ON m.NumMatch = b.NumMatch
LEFT JOIN joueur j ON b.NumJoueur = j.NumJoueur
GROUP BY m.NumMatch
ORDER BY m.DateMatch DESC
LIMIT 5;";




$stmt = $pdo->prepare($sql);
$stmt->execute();
$matchs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="match-container">
    <?php foreach ($matchs as $match): ?>
        <div class="match-card">
            <div class="league"><?= htmlspecialchars($match['NomTournoi']) ?></div> <!-- Nom du tournoi -->
            <div class="match-time"><?= htmlspecialchars($match['DateMatch']) ?></div>
            <div class="teams">
                <div class="team">
                    <img src="images/<?= htmlspecialchars($match['ImageDomicile']) ?>" alt="<?= htmlspecialchars($match['EquipeDomicile']) ?>">
                    <span><?= htmlspecialchars($match['EquipeDomicile']) ?></span> <!-- Nom de l'équipe domicile -->
                </div>
                <span class="score">
                    <?= isset($match['ScoreEquipeDomicile']) ? htmlspecialchars($match['ScoreEquipeDomicile']) : '-' ?> 
                    - 
                    <?= isset($match['ScoreEquipeExterieur']) ? htmlspecialchars($match['ScoreEquipeExterieur']) : '-' ?>
                </span> <!-- Affichage du score ou '-' si non disponible -->
                <div class="team">
                    <span><?= htmlspecialchars($match['EquipeExterieur']) ?></span> <!-- Nom de l'équipe extérieure -->
                    <img src="images/<?= htmlspecialchars($match['ImageExterieur']) ?>" alt="<?= htmlspecialchars($match['EquipeExterieur']) ?>">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
