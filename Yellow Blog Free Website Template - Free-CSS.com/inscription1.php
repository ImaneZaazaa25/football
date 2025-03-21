<?php
// Inclure la connexion à la base de données avec PDO
include('connexionBDD.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations soumises par l'utilisateur
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Sécuriser les entrées avec PDO
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $confirm_password = htmlspecialchars($confirm_password);

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        header("Location: inscription.html?error=Les mots de passe ne correspondent pas.");
        exit();
    }

    // Vérifier si l'email existe déjà
    $query = "SELECT * FROM users WHERE Email_User = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: inscription.html?error=L'email est déjà utilisé.");
        exit();
    }

    // Hacher le mot de passe
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insérer les données dans la base de données
    $query = "INSERT INTO users (Nom_User, Prenom_User, Email_User, Pass_user) VALUES (:nom, :prenom, :email, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Rediriger l'utilisateur vers la page de connexion après une inscription réussie
        header("Location: auth.php?success=Inscription réussie. Vous pouvez maintenant vous connecter.");
        exit();
    } else {
        // Afficher une erreur si l'insertion échoue
        header("Location: inscription.html?error=Erreur lors de l'inscription.");
        exit();
    }
}
?>
