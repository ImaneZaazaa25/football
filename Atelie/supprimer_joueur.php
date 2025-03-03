<?php
require("connexionBDD.php");

// Récupérer le nom de l'équipe et le nom du joueur depuis POST
$equipe = $_POST["id"];  // Nom de l'équipe
$joueur = $_POST["id-joueur"];  // Nom du joueur

try {
    // 1. Récupérer le NumEquipe basé sur le NomEquipe
    /*$req1 = $pdo->prepare("SELECT NumEquipe FROM equipe WHERE NomEquipe = ?");
    $req1->execute([$equipe]);
    $equipeData = $req1->fetch(PDO::FETCH_ASSOC);

    if (!$equipeData) {
        echo "L'équipe $equipe n'a pas été trouvée.";
        exit;
    }

    $numEquipe = $equipeData['NumEquipe'];*/

    // 2. Récupérer l'ID du joueur basé sur le NomJoueur
    /*$req2 = $pdo->prepare("SELECT NumJoueur FROM joueur WHERE NomJoueur = ?");
    $req2->execute([$joueur]);
    $joueurData = $req2->fetch(PDO::FETCH_ASSOC);

    if (!$joueurData) {
        echo "Le joueur n'a pas été trouvé.";
        exit;
    }

    $numJoueur = $joueurData['NumJoueur'];*/

    // 3. Vérifier si le joueur fait bien partie de l'équipe
    $req3 = $pdo->prepare("SELECT * FROM composer WHERE NumJoueur = ? AND NumEquipe = ?");
    $req3->execute([$joueur, $equipe]);
    $composerData = $req3->fetch(PDO::FETCH_ASSOC);

    if (!$composerData) {
        echo "Le joueur ne fait pas partie de l'équipe spécifiée.";
        exit;
    }

    // 4. Supprimer le joueur de la table 'composer' (lien entre joueur et équipe)
    $req4 = $pdo->prepare("DELETE FROM composer WHERE NumJoueur = ? AND NumEquipe = ?");
    $req4->execute([$joueur, $equipe]);

    // 5. Supprimer le joueur de la table 'joueur'
    $req5 = $pdo->prepare("DELETE FROM joueur WHERE NumJoueur = ?");
    $req5->execute([$joueur]);
    header('Location: index.php');
    exit();
} catch (Exception $e) {
    // Gérer les erreurs
    echo "Une erreur est survenue : " . $e->getMessage();
}
?>
