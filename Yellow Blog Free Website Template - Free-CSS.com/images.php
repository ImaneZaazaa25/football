<?php
// Connexion à la base de données
require('connexionBDD.php'); 

try {
    // Récupérer les 4 dernières images depuis la base de données
    $query = $pdo->query("SELECT Alt, description, Lien FROM images ORDER BY Id_Image DESC LIMIT 4");
    $images = $query->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des images existent
    if (!$images) {
        $images = []; // Si aucune image, on initialise un tableau vide
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base : " . $e->getMessage());
}

// Générer le HTML du slider avec les données récupérées
$output = '<div class="clearfix slider">
    <ul class="pgwSlider">';

if (!empty($images)) {
    foreach ($images as $image) {
        $output .= '<li>
            <img src="' . htmlspecialchars($image['Lien']) . '" 
                 alt="' . htmlspecialchars($image['Alt']) . '" 
                 data-description="' . htmlspecialchars($image['description']) . '">
        </li>';
    }
} else {
    $output .= '<p>Aucune image trouvée.</p>';
}

$output .= '</ul>
</div>';

// Afficher le contenu généré
echo $output;
?>
