<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
$is_logged_in = isset($_SESSION['user_id']); // Si un user_id existe dans la session, l'utilisateur est connecté
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<!--
---- Clean html template by http://WpFreeware.com
---- This is the main file (index.html).
---- You are allowed to change anything you like. Find out more Awesome Templates @ wpfreeware.com
---- Read License-readme.txt file to learn more.
-->	

	<head>
		<title>Welcome to my site</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Oswald Font -->
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

		
		<!-- Font Awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="style.css" rel="stylesheet" media="screen">	
		<link href="responsive.css" rel="stylesheet" media="screen">
        <!-- home slider-->
		<link href="css/pgwslider.css" rel="stylesheet">
		
        <style>
			.progress-bar-container {
    width: 100%;
    background: #ddd;
    height: 20px;
    border-radius: 5px;
    margin: 5px 0;
}
.progress-bar {
    height: 100%;
    background: #4caf50;
    border-radius: 5px;
    transition: width 0.5s;
}
            .menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.menu ul li {
    margin-left: 20px;
}

.menu ul li a {
    text-decoration: none;
    font-weight: bold;
	color: aliceblue;
}
.connexion {
    margin-left: 450px; 
}
.btn-connexion {
    background-color: black;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

.btn-connexion i {
    margin-right: 5px;
}

.btn-connexion:hover {
    background-color: #0c0c0c;
}
.match-container {
    display: flex;
    gap: 15px;
    overflow-x: auto; /* Active le défilement horizontal si besoin */
    padding: 10px;
    background-color: #f5f5f5;
    scrollbar-width: thin; /* Pour Firefox */
    white-space: nowrap; /* Empêche les cartes de passer à la ligne */
}

.match-card {
    background-color: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    width: 220px; /* Taille fixe */
    flex: 0 0 220px; /* Empêche les cartes de se redimensionner */
    text-align: center;
}

.league {
    font-size: 14px;
    font-weight: bold;
    color: #555;
    margin-bottom: 8px;
}

.match-time {
    background-color: #ddd;
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 14px;
    margin-bottom: 10px;
}

.teams {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.team {
    display: flex;
    align-items: center;
    gap: 5px;
}

.team img {
    width: 20px;
    height: 20px;
}

.score {
    font-size: 18px;
    font-weight: bold;
    color: #222;
}
</style>
				
	</head>

	<body>
	
		<section id="header_area">
			<div class="wrapper header">
				<div class="clearfix header_top">
					<div class="clearfix logo_menu floatleft">
						<div class="logo floatleft">
							<a href=""><h1><span>Daily</span> foot</h1></a>
						</div>
						<div class="menu floatleft ">
							<ul>
								
								<li><a href="">Actulaites</a></li>
                                <li><a href="index.php">Home</a></li>
							<li><a href="matchs.php">Matchs</a></li>
							
							<li><a href="result.php">Resultats</a></li>
							<li><a href="profEquipe.php">Equipes</a></li>
							</ul>
						
						
						

<div class="connexion">
    <?php if ($is_logged_in): ?>
        <!-- Si l'utilisateur est connecté, afficher un bouton Déconnexion -->
         
        <a href="logout.php" class="btn-deconnexion">
            <i class="fa-solid fa-sign-out-alt"></i> Déconnexion
        </a>
    <?php else: ?>
        <!-- Sinon, afficher un bouton Connexion -->
        <a href="auth.php" class="btn-connexion">
            <i class="fa-solid fa-user"></i> Connexion
        </a>
    <?php endif; ?>
</div>

					
					
				</div>
				<div class="header_bottom">
					
						
							
							<div class="clearfix search floatright">
								<form>
									<input type="text" placeholder="Search"/>
									<input type="submit" />
								</form>
							</div>
						
					
				</div>
			</div>
		</section>
</body>
</html>