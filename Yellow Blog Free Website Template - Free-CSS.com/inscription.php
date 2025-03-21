<?php
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <title>Inscription - Bienvenue sur mon site</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Oswald', sans-serif;
            background-color: #f2f2f2;
            padding-top: 50px;
        }
        .register-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .input-field {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .input-field:focus {
            border-color: #FFD700;
            outline: none;
        }
        .register-btn {
            width: 100%;
            padding: 12px;
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .register-btn:hover {
            background-color: #FFCC00;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="register-container">
        <h2>Inscription</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>

        <form action="inscription1.php" method="post">
            <input type="text" name="nom" class="input-field" placeholder="Nom" value="<?= $nom ?>" required>
            <input type="text" name="prenom" class="input-field" placeholder="Prénom" required>
            <input type="email" name="email" class="input-field" placeholder="Email" value="<?= $email ?>" required>
            <input type="password" name="password" class="input-field" placeholder="Mot de passe" required>
            <input type="password" name="confirm_password" class="input-field" placeholder="Confirmer le mot de passe" required>
            <button type="submit" class="register-btn">S'inscrire</button>
        </form>
    </div>

</body>
</html>
