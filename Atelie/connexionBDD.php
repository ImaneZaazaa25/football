<?php
try
{
    $pdo=new PDO("mysql:host=localhost;dbname=FootballDB","root","");
}
catch(PDOException $e)
{
    echo "Erreur de cnx ".$e->getMessage();
}
?>