<?php

session_start();
require 'connexionBDD.php';


$succes = '';
$erreur = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    $staffId = trim($_POST["supp-staff-id"]);

    // Supprimer Les blancs de debut et fin
    
    // if Test Est Opptionnel

    if (!empty($staffId)) 
    {
        try 
        {
            // Supposant que $pdo est déjà défini dans un fichier de connexion inclus
            $stmt = $pdo->prepare("DELETE FROM staff WHERE id = :id");
            $stmt->execute([':id' => $staffId]);
            
            // Redirection optionnelle vers une page de succès
            $_SESSION['message'] = "Supprission Avec Succes !";

            header('Location: index.php');
            exit;
        }
        catch (PDOException $e) 
        {
            
            $_SESSION['message'] = "Erreur lors de la suppression du staff !";
            // Redirection optionnelle vers une page d'erreur
            header('Location: index.php');
            exit;
        }
    }
}
?>