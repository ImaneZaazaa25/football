<?php
// Connexion à la base de données
require('connexionBDD.php');

// Récupérer les articles avec leurs images associées
$query = $pdo->query("SELECT Id_Article, Titre, Categorie, Contenu, DatePublication, a.Id_Image FROM article a, images i WHERE a.Id_Image=i.Id_Image ORDER BY DatePublication DESC LIMIT 5");

$articles = $query->fetchAll(PDO::FETCH_ASSOC);

// Générer dynamiquement le HTML pour les articles
$html_output = ' ';

foreach ($articles as $article) {
    // Récupérer l'URL de l'image depuis la table images
    $image_query = $pdo->prepare("SELECT Lien FROM images WHERE Id_Image = :id_image");
    $image_query->execute([':id_image' => $article['Id_Image']]);
    $image = $image_query->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'image existe
    $image_url = $image ? $image['Lien'] : 'default_image.jpg';  // image par défaut si aucune URL n'est trouvée

    // Générer dynamiquement le HTML pour l'article
    $html_output .= '
    <div class="clearfix single_content">
        <div class="clearfix post_date floatleft">
            <div class="date">
                <h3>' . date('d', strtotime($article['DatePublication'])) . '</h3>
                <p>' . date('F', strtotime($article['DatePublication'])) . '</p>
            </div>
        </div>
        <div class="clearfix post_detail">
            <h2><a href="article.php?id=' . $article['Id_Article'] . '">' . htmlspecialchars($article['Titre']) . '</a></h2>
            <div class="clearfix post-meta">
                <p><span><i class="fa fa-user"></i> Admin</span> <span><i class="fa fa-clock-o"></i> ' . date('d M Y', strtotime($article['DatePublication'])) . '</span></p>
            </div>
            <div class="clearfix post_excerpt">
                <img src="' . htmlspecialchars($image_url) . '" alt="' . htmlspecialchars($article['Titre']) . '"/>
                <p>' . substr(htmlspecialchars($article['Contenu']), 0, 150) . '...</p>
            </div>
            <a href="article.php?id=' . $article['Id_Article'] . '">Continue Reading</a>
        </div>
    </div>';
}

// Afficher le HTML généré
echo $html_output;

?>
