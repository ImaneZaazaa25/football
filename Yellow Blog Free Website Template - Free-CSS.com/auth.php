<?php
// Inclure la connexion à la base de données
include('connexionBDD.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Requête SQL pour récupérer l'utilisateur
    $query = "SELECT * FROM users WHERE Email_User = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $user['Pass_user'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        echo "<\br>";
        echo $hashed_password;
        // Vérification du mot de passe avec password_verify
        if ($password  == $user['Pass_user']) {
            session_start();
            $_SESSION['user_id'] = $user['Num_user'];
            $_SESSION['user_name'] = $user['Nom_User'] . ' ' . $user['Prenom_User'];
            $_SESSION['user_email'] = $user['Email_User'];

            header("Location: index.php");
            exit();
        } else {
            $error_message = "Mot de passe incorrect!";
        }
    } else {
        $error_message = "Aucun utilisateur trouvé avec cet email!";
    }
}
?>



<!-- Ajouter du style CSS pour le formulaire de connexion -->
<head>
    <style>
        /* Style pour le formulaire de connexion */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .form-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #FFEB3B; /* Jaune */
            color: #333; /* Couleur du texte */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #fdd835; /* Jaune un peu plus foncé au survol */
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .links-container {
            text-align: center;
            margin-top: 20px;
        }
        .links-container a {
            color: #FFEB3B;
            text-decoration: none;
            font-size: 14px;
        }
        .links-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<!-- Formulaire de connexion -->
<div class="form-container">
    <h2>Se connecter</h2>
    <form method="POST" action="auth.php">
        <input type="email" name="username" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>

    <?php if (isset($error_message)): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <div class="links-container">
        <p><a href="inscription.php">Pas de compte ? S'inscrire</a></p>
        <p><a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a></p>
    </div>
</div>