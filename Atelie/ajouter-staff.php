<?php

session_start();

// Include la page de base de donne connexion
require 'connexionBDD.php';

//  variable de messages ( erreur ou success)
$error = '';
$success = '';

// Si La Form Est Sumbited 

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{ 
    $nom = $_POST['staff-name'];
    $role = $_POST['staff-role'];
    $date_debut = $_POST['staff-date-debut'];
    $date_fin = $_POST['staff-date-fin'];
    $num_equipe = $_POST['staff-NumEquipe'];
    

    if (strtotime($date_debut) > strtotime($date_fin)) 
        // Comparer Les Dates Etrer Par Utilisateur 
        $_SESSION['message'] = 'La date de début doit être antérieure à la date de fin.';
    else 
        try 
        {
            // Check Si Il y a Au Minim Une Staff Pour Le Meme Dans L'Equipe
            // Si Oui --> Erreur  
            $sql_check = "SELECT COUNT(*) FROM staff WHERE role = :role AND NumEquipe = :num_equipe";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':role', $role);
            $stmt_check->bindParam(':num_equipe', $num_equipe);
            $stmt_check->execute();
            $role_count = $stmt_check->fetchColumn();

            if ($role_count != false) 
            {
                $_SESSION['message'] = "Un staff avec le rôle '$role' existe déjà pour l'équipe $num_equipe.";
                // Redriger Au Page Avec Une Message Erruer 
                header('Location: index.php');
                exit;
            }

            // Si Aucun Role Deja Dans L'Equipe
            $sql = "INSERT INTO staff (NomStaff, Role, DateDebutStaff, DateFinStaff, NumEquipe) 
                    VALUES (:nom, :role, :date_debut, :date_fin, :num_equipe)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':date_debut', $date_debut);
            $stmt->bindParam(':date_fin', $date_fin);
            $stmt->bindParam(':num_equipe', $num_equipe);

            $stmt->execute();

            $_SESSION['message'] = 'Staff ajouté avec succès !';
            // Redirection 
            header('Location: index.php');
            exit;
        } 
        catch (PDOException $e) 
        {
            $_SESSION['message'] = 'Erreur lors de l\'ajout du staff : ' . $e->getMessage();
            header('Location: index.php');
            exit;
        }

    header('Location: index.php');
}

?>