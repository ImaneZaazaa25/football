<?php require("connexionBDD.php");

$query = "
SELECT e.NomEquipe AS equipe, COUNT(b.NumJoueur) AS buts_marques
FROM equipe e
LEFT JOIN joueur j ON e.NumEquipe = j.NumEquipe
LEFT JOIN but b ON j.NumJoueur = b.NumJoueur
GROUP BY e.NomEquipe
ORDER BY buts_marques DESC;
";

$stmt = $pdo->prepare($query);
$stmt->execute();
$classement = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Affichage du classement dans le HTML -->
<div class="clearfix single_sidebar ranking_items">
    <h2>Classement des Équipes</h2>
    <ul>
        <?php foreach ($classement as $equipe) : ?>
            <li class="cat-item"><a href=""><?php echo htmlspecialchars($equipe['equipe']); ?></a> (<?php echo $equipe['buts_marques']; ?> buts)</li>
        <?php endforeach; ?>
    </ul>
</div>
