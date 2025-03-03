<?php
session_start();

// Include the database connection file
require_once 'connexionBDD.php';


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Retrieve form data directly
    $id = $_POST['modify-staff-id'];
    $nom = $_POST['modify-staff-name'];
    $role = $_POST['modify-staff-role'];
    $date_debut = $_POST['modify-staff-date-debut'];
    $date_fin = $_POST['modify-staff-date-fin'];
    $num_equipe = $_POST['modify-staff-NumEquipe'];

    // Basic validation
    if (!$id || !$role || !$date_debut || !$date_fin || !$num_equipe) 
        $_SESSION['message'] = 'Les champs ID, rôle, dates et numéro d\'équipe sont obligatoires.';
    elseif (strtotime($date_debut) > strtotime($date_fin)) 
        $_SESSION['message'] = 'La date de début doit être antérieure à la date de fin.';
    else 
    {
        try 
        {

            // Check if the staff ID exists

            $sql_verify = "SELECT COUNT(*) FROM staff WHERE id = :id";
            $stmt_verify = $pdo->prepare($sql_verify);
            $stmt_verify->bindParam(':id', $id);
            $stmt_verify->execute();
            $staff_exists = $stmt_verify->fetchColumn();

            if ($staff_exists == false) 
            {
                $_SESSION['message'] = "Aucun staff avec l'ID $id n'existe.";
                header('Location: index.php');
                exit;
            }

            // Prepare the update query
            $sql = "UPDATE staff SET 
                    nom = :nom, 
                    role = :role, 
                    date_debut = :date_debut, 
                    date_fin = :date_fin, 
                    NumEquipe = :num_equipe 
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            // Bind parameters (nom is optional, so it can be an empty string)
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':date_debut', $date_debut);
            $stmt->bindParam(':date_fin', $date_fin);
            $stmt->bindParam(':num_equipe', $num_equipe);
            $stmt->bindParam(':id', $id);

            // Execute the query
            $stmt->execute();

            $_SESSION['message'] = 'Staff modifié avec succès !';
            header('Location: index.php');
            exit;
        } 
        catch (PDOException $e) 
        {
            $_SESSION['message'] = 'Erreur lors de la modification du staff : ' . $e->getMessage();
            header('Location: index.php');
            exit;
        }
    }
    header('Location: index.php');
}
?>