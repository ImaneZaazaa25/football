<?php

    require("connexionBDD.php");

    // Exécution de la requête pour récupérer les meilleurs buteurs
    $sql = "SELECT 
    j.NomJoueur, 
    j.PrenomJoueur, 
    COUNT(p.NumJoueur) AS total_buts, 
    t.NomTournoi
FROM joueur j
JOIN participation p ON j.NumJoueur = p.NumJoueur
JOIN but b ON p.NumJoueur = b.NumJoueur 
JOIN matchs m ON p.NumMatch = m.NumMatch 
JOIN tournoi t ON m.NumTournoi = t.NumTournoi
GROUP BY j.NumJoueur, t.NomTournoi
ORDER BY total_buts DESC
LIMIT 5;

";
    
    $stmt = $pdo->query($sql);
    $buteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="clearfix single_sidebar">
    <h2>Meilleurs Buteurs</h2>
    <ul>
        <?php foreach ($buteurs as $buteur): ?>
            <li>
                <a href="">
                    <?= htmlspecialchars($buteur['NomJoueur']) . " " . htmlspecialchars($buteur['PrenomJoueur']) . " - " . $buteur['total_buts'] . " buts" ?>
                    <span>(Tournoi : <?= htmlspecialchars($buteur['NomTournoi']) ?>)</span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>