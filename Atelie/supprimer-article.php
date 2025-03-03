<?php
// Start session
session_start();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = $_POST['id']; // Directly get the POST value
    
    if ($articleId) 
    { // Only check if it's not empty
        try 
        {
            // Assuming $pdo is available from your included database file
            // Check if article exists
            $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE id = :id");
            $checkStmt->bindParam(':id', $articleId);
            $checkStmt->execute();
            
            if ($checkStmt->fetchColumn() > 0) 
            {
                // Delete the article
                $deleteStmt = $pdo->prepare("DELETE FROM articles WHERE id = :id");
                $deleteStmt->bindParam(':id', $articleId);
                $deleteStmt->execute();
                
                $_SESSION['success'] = "L'article avec l'ID $articleId a été supprimé avec succès !";
            } 
            else 
            {
                $_SESSION['error'] = "Aucun article trouvé avec l'ID $articleId.";
            }
        } 
        catch (PDOException $e) 
        {
            $_SESSION['error'] = 'Erreur lors de la suppression : ' . $e->getMessage();
        }
    } 
    else 
    {
        $_SESSION['error'] = "Veuillez entrer un ID d'article valide.";
    }
    
    // Redirect back to the form page
    header('Location:index.php');
    exit;
}
?>

