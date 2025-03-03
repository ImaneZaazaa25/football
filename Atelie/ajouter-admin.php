<?php
// Démarre la session pour les messages
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    // Nettoyage des entrées utilisateur
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $dateNaissance = trim($_POST["date_naissance"]);
    $tournoiId = trim($_POST["tournoi"]); // Traité comme un ID
    $email = trim($_POST["email"]);

    // Vérification que tous les champs sont remplis
    if (empty($nom) || empty($prenom) || empty($dateNaissance) || empty($tournoiId) || empty($email)) 
    {
        $_SESSION["message"] = "Erreur : Tous les champs sont requis";
        header("Location: index.php");
        exit;
    }

    try 
    {
        // Supposant que $pdo est déjà défini dans un fichier de connexion inclus
        // Vérifie l'existence du tournoi par ID
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM tournoi WHERE id = :tournoiId");
        $checkStmt->execute([':tournoiId' => $tournoiId]);
        $tournoiExists = $checkStmt->fetchColumn();

        if (!$tournoiExists) 
        {
            $_SESSION["message"] = "Erreur : L'ID du tournoi n'existe pas";
            header("Location: index.php");
            exit;
        }

        // Ajoute l'administrateur
        $stmt = $pdo->prepare("INSERT INTO administrateurs (nom, prenom, date_naissance, tournoi_id, email) VALUES (:nom, :prenom, :date_naissance, :tournoi_id, :email)");
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_naissance' => $dateNaissance,
            ':tournoi_id' => $tournoiId,
            ':email' => $email
        ]);

        // Message de succès
        $_SESSION["message"] = "Succès : Administrateur ajouté avec succès";
        header("Location: index.php");
        exit;

    } 
    catch (PDOException $e) 
    {
        // Journalisation de l'erreur
         echo "Erreur lors de l'ajout de l'administrateur : " . $e->getMessage();
        $_SESSION["message"] = "Erreur : Problème lors de l'ajout de l'administrateur";
        header("Location: index.php");
        exit;
    }
}

// Si la méthode n'est pas POST, redirige vers l'index
header("Location: index.php");
exit;
?>