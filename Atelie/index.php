<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <title>Yellow Foot</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Oswald Font -->
  <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
  <!-- Home slider -->
  <link href="css/pgwslider.css" rel="stylesheet" />
  <!-- Font Awesome (using only version 6.4.2) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="style.css" rel="stylesheet" media="screen" />    
  <link href="responsive.css" rel="stylesheet" media="screen" />
  <script type="text/javascript">
    // Function to show specific content
    function showContent(contentId) {
      var contents = document.querySelectorAll('.content-section');
      contents.forEach(function(content) {
        content.style.display = 'none';
      });
      var contentToShow = document.getElementById(contentId);
      if (contentToShow) {
        contentToShow.style.display = 'block';
      }
    }
    // Show default section on load
    window.onload = function() {
      showContent('gestion-joueurs');
    };

    function updateJoueurs() {
    var equipeId = document.getElementById("equipe-id-supp").value; // Récupérer l'ID de l'équipe sélectionnée

    // Vérifier que l'équipe est valide
    if (equipeId === "") {
        document.getElementById("joueur-id-supp").innerHTML = "<option value=''>Veuillez choisir une équipe d'abord</option>";
        return;
    }

    // Charger les données JSON directement via le script PHP
    fetch('generer_json.php') // Utilisez directement le script PHP pour récupérer les données JSON
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur lors du chargement des données JSON");
            }
            return response.json();
        })
        .then(data => {
            var joueurs = data[equipeId] ? data[equipeId].Joueurs : []; // Récupérer les joueurs pour l'équipe sélectionnée
            var joueurSelect = document.getElementById("joueur-id-supp");

            // Vider les options existantes
            joueurSelect.innerHTML = "<option value=''>Sélectionner un joueur</option>";

            // Ajouter les options pour chaque joueur
            joueurs.forEach(function(joueur) {
                var option = document.createElement("option");
                option.value = joueur.NumJoueur; // Utiliser NumJoueur comme valeur
                option.textContent = joueur.NomJoueur + ' ' + joueur.PrenomJoueur; // Afficher Nom et Prénom du joueur
                joueurSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des joueurs : ' + error.message); // Afficher l'erreur spécifique
        });
}

function updateJoueurs2() {
    var equipeId = document.getElementById("equipe-id-modif").value; // Récupérer l'ID de l'équipe sélectionnée

    // Vérifier que l'équipe est valide
    if (equipeId === "") {
        document.getElementById("joueur-id-modif").innerHTML = "<option value=''>Veuillez choisir une équipe d'abord</option>";
        return;
    }

    // Charger les données JSON directement via le script PHP
    fetch('generer_json.php') // Utilisez directement le script PHP pour récupérer les données JSON
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur lors du chargement des données JSON");
            }
            return response.json();
        })
        .then(data => {
            var joueurs = data[equipeId] ? data[equipeId].Joueurs : []; // Récupérer les joueurs pour l'équipe sélectionnée
            var joueurSelect = document.getElementById("joueur-id-modif");

            // Vider les options existantes
            joueurSelect.innerHTML = "<option value=''>Sélectionner un joueur</option>";

            // Ajouter les options pour chaque joueur
            joueurs.forEach(function(joueur) {
                var option = document.createElement("option");
                option.value = joueur.NumJoueur; // Utiliser NumJoueur comme valeur
                option.textContent = joueur.NomJoueur + ' ' + joueur.PrenomJoueur; // Afficher Nom et Prénom du joueur
                joueurSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des joueurs : ' + error.message); // Afficher l'erreur spécifique
        });
}
document.addEventListener("DOMContentLoaded", function() {
    // Afficher automatiquement le formulaire "Ajouter" pour chaque section visible au début
    document.querySelectorAll('.content-section').forEach(section => {
        let firstForm = section.querySelector('.single_content');
        if (firstForm) {
            firstForm.style.display = 'block'; // Afficher le premier formulaire de chaque section
        }
    });
});

function afficherFormulaire(formId) {
    // Trouver la section du formulaire sélectionné
    let form = document.getElementById(formId);
    if (!form) return;

    let section = form.closest('.content-section');
    if (!section) return;

    // Cacher tous les formulaires de cette section uniquement
    section.querySelectorAll('.single_content').forEach(f => {
        f.style.display = 'none';
    });

    // Afficher le formulaire sélectionné
    form.style.display = 'block';
}
function updateJoueurDetails() {
    // Récupérer l'ID du joueur sélectionné
    let joueurId = document.getElementById("joueur-id-modif").value;
    let equipeId = document.getElementById("equipe-id-modif").value; // Récupérer l'ID de l'équipe

    // Vérifier si un joueur est sélectionné
    if (joueurId === "" || equipeId === "") {
        alert("Veuillez sélectionner un joueur.");
        return;
    }

    // Faire une requête AJAX vers PHP pour récupérer les données du joueur
    fetch(`rech.php?id-joueur=${joueurId}&id=${equipeId}`)
        .then(response => response.json()) // Convertir la réponse en JSON
        .then(data => {
            if (data.error) {
                alert("Erreur : " + data.error);
                return;
            }

            // Remplir les champs du formulaire avec les données récupérées
            document.getElementById("modify-joueur-id").value = data.id;
            document.getElementById("modify-joueur-name").value = data.nom;
            document.getElementById("modify-joueur-prenom").value = data.prenom;
            document.getElementById("modify-joueur-age").value = data.date_naissance;
            document.getElementById("joueur-debut-modif").value = data.date_debut;
            document.getElementById("joueur-fin-modif").value = data.date_fin;
            document.getElementById("joueur-tenu-modif").value = data.num_tenu;
            document.getElementById("equipe-id-modi").value = data.num_equipe;

        })
        .catch(error => console.error("Erreur lors de la récupération des données :", error));
}


  </script>
</head>
<body>
  <!-- Header -->
  <section id="header_area">
    <div class="wrapper header">
      <div class="clearfix header_top">
        <div class="clearfix logo floatleft">
          <a href=""><h1><span>Yellow</span> Foot</h1></a>
          <div class="menu floatleft">
            <ul>
              <li><a href="">Coupe du Trône</a></li>
              <li><a href="">Champion</a></li>
            </ul>
          </div>
        </div>
        <div class="connexion">
          <a href="login.html" class="btn-connexion" style="float:right">
            <i class="fa-solid fa-user"></i> Connexion
          </a>
        </div>
        <div class="clearfix search floatright">
          <form>
            <input type="text" placeholder="Search" />
            <input type="submit" />
          </form>
        </div>
      </div>
      <div class="header_bottom">
        <nav>
          <ul id="nav">
            <li><a href="javascript:void(0)" onclick="showContent('gestion-joueurs')">Gestion des joueurs</a></li>
            <li><a href="javascript:void(0)" onclick="showContent('gestion-equipes')">Gestion des équipes</a></li>
            <li><a href="javascript:void(0)" onclick="showContent('gestion-staff')">Gestion des Staff</a></li>
            <li><a href="javascript:void(0)" onclick="showContent('gestion-stades')">Gestion des stades</a></li>
            <li><a href="javascript:void(0)" onclick="showContent('creer-compte')">Gestion des comptes administrateur tournoi</a></li>
            <li><a href="javascript:void(0)" onclick="showContent('creer-article')">Gestion des articles</a></li>
            <li><a href="javascript:void(0)" onclick="showContent('gestion-tournoi')">Gestion des tournoi</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </section>

  <!-- Content -->
  <section id="content_area">
    <div class="clearfix wrapper main_content_area">
      

      <div class="clearfix content-container">
    <!-- Gestion des Joueurs -->
    <div class="content-left">
        <div class="clearfix content content-section" id="gestion-joueurs">
            <div class="content_title">
                <h2>Gestion des Joueurs : <button class="bt" onclick="afficherFormulaire('form-ajouter')">Ajouter</button>
        <button class="bt" onclick="afficherFormulaire('form-modifier')">Modifier</button>
        <button class="bt" onclick="afficherFormulaire('form-supprimer')">Supprimer</button></h2>
                
            </div>

            <!-- Ajouter un Joueur -->
            <div class="clearfix single_content" id="form-ajouter" style="display: none;">
                <div class="clearfix post_date floatleft">
                    <h3>Ajouter un Joueur</h3>
                </div>
                <div class="clearfix post_detail">
                    <form action="ajout_joueur.php" method="POST" class="input-group">
                        <label for="joueur-name">Nom du Joueur :</label>
                        <input type="text" id="joueur-name" name="nom" placeholder="Entrez le nom du joueur" required /><br />
                        <label for="joueur-prenom">Prénom du Joueur :</label>
                        <input type="text" id="joueur-prenom" name="prenom" placeholder="Entrez le prénom du joueur" required /><br />
                        <label for="joueur-age">Date de naissance :</label>
                        <input type="date" id="joueur-age" name="date_naissance" required /><br />
                        <label for="joueur-equipe">Équipe du Joueur :</label>
                        <select name="equipe" id="joueur-equipe">
                            <?php require("selection_equipe.php"); ?>
                        </select><br>
                        <label for="joueur-debut">Date de début :</label>
                        <input type="date" id="joueur-debut" name="date_debut" required /><br>
                        <label for="joueur-fin">Date de fin :</label>
                        <input type="date" id="joueur-fin" name="date_fin" required /><br>
                        <label for="joueur-tenu">Numéro du tenu du Joueur :</label>
                        <input type="number" id="joueur-tenu" name="tenu" placeholder="Entrez le numéro du tenu" required /><br>
                        <button type="submit">Ajouter</button>
                    </form>
                </div>
            </div>

            <!-- Supprimer un Joueur -->
            <div class="clearfix single_content" id="form-supprimer" style="display: none;">
                <div class="clearfix post_date floatleft">
                    <h3>Supprimer un Joueur</h3>
                </div>
                <div class="clearfix post_detail">
                    <form action="supprimer_joueur.php" method="POST" class="input-group">
                        <label for="equipe-id-supp">Équipe du joueur à supprimer :</label>
                        <select name="id" id="equipe-id-supp" onchange="updateJoueurs()">
                            <?php require("selection_equipe.php"); ?>
                        </select><br>
                        <label for="joueur-id-supp">Sélectionner le joueur à supprimer :</label>
                        <select name="id-joueur" id="joueur-id-supp">
                            <option value="">Veuillez choisir une équipe d'abord</option>
                        </select><br>
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            </div>

            <!-- Modifier un Joueur -->
<div class="clearfix single_content" id="form-modifier" style="display: none;">
    <div class="clearfix post_date floatleft">
        <h3>Modifier un Joueur</h3>
    </div>
    <div class="clearfix post_detail">
    <div id="form-container">
            <!-- Formulaire de modification avec les informations du joueur pré-remplies -->
            <form action="modifier_joueur.php" method="POST" class="input-group">
                <label for="modify-joueur-id">Id du joueur :</label>
            <label for="equipe-id-modif">Équipe du joueur à modifier :</label>
            <select name="id" id="equipe-id-modif" onchange="updateJoueurs2()">
                <?php require("selection_equipe.php"); ?>
            </select><br>
            <label for="joueur-id-modif">Sélectionner le joueur à modifier :</label>
            <select name="id-joueur" id="joueur-id-modif" onchange="updateJoueurDetails()">
                <option value="">Veuillez choisir une équipe d'abord</option>
            </select><br>
        
            <label for="modify-joueur-id">Id Joueur:</label>       
                <input type="text" id="modify-joueur-id" name="id_j" readonly /><br>

                <label for="modify-joueur-name">Nouveau Nom :</label>
                <input type="text" id="modify-joueur-name" name="nom" placeholder="Entrez le nouveau nom" required /><br>

                <label for="modify-joueur-prenom">Nouveau Prénom :</label>
                <input type="text" id="modify-joueur-prenom" name="prenom" placeholder="Entrez le nouveau prénom" required /><br>

                <label for="modify-joueur-age">Nouvelle date de naissance :</label>
                <input type="date" id="modify-joueur-age" name="date_naissance" required /><br>

                <label for="joueur-debut-modif">Date de début :</label>
                <input type="date" id="joueur-debut-modif" name="date_debut_modif" required /><br>

                <label for="joueur-fin-modif">Date de fin :</label>
                <input type="date" id="joueur-fin-modif" name="date_fin_modif" required /><br>

                <label for="joueur-tenu-modif">Numéro du tenu du Joueur :</label>
                <input type="number" id="joueur-tenu-modif" name="tenu_modif" placeholder="Entrez le numéro du tenu" required /><br>

                <label for="equipe-id-modi">Modifier l'équipe :</label>
                <select name="id-equipe" id="equipe-id-modi">
                    <?php require("selection_equipe.php"); ?>
                </select><br>

                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

        <!-- Gestion des Équipes -->
        <div class="clearfix content content-section" id="gestion-equipes" style="display:none;">
          <div class="content_title">
            <h2>Gestion des Équipes : <button class="bt" onclick="afficherFormulaire('equipe-ajouter')">Ajouter</button>
        <button class="bt" onclick="afficherFormulaire('equipe-modifier')">Modifier</button>
        <button class="bt" onclick="afficherFormulaire('equipe-supp')">Supprimer</button></h2>
        
          </div>
          <!-- Ajouter une Équipe -->
          <div class="clearfix single_content" id="equipe-ajouter" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Ajouter une Équipe</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="ajouter-equipe.php" method="POST" class="input-group">
                <label for="equipe-name">Nom de l'Équipe :</label>
                <input type="text" name="equipe-name" id="equipe-name" placeholder="Entrez le nom de l'équipe" required /><br />
                <label for="equipe-date-creation">Date de création :</label>
                <input type="date" name="equipe-date-creation" id="equipe-date-creation" required /><br />
                <label for="equipe-city">Ville de l'Équipe :</label>
                <input type="text" name="equipe-city" id="equipe-city" placeholder="Entrez la ville" required /><br />
                <button type="submit">Ajouter</button>
              </form>
            </div>
          </div>
          <!-- Modifier une Équipe -->
          <div class="clearfix single_content" id="equipe-modifier" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Modifier une Équipe</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="modifier-equipe.php" method="POST" class="input-group">
                <label for="modify-id">ID de l'Équipe :</label>
                <input type="text" name="modify-id" id="modify-id" placeholder="Entrez l'ID de l'équipe à modifier" required /><br />
                <label for="modify-name">Nouveau Nom :</label>
                <input type="text" name="modify-name" id="modify-name" placeholder="Entrez le nouveau nom de l'équipe" /><br />
                <label for="modify-city">Nouvelle Ville :</label>
                <input type="text" name="modify-city" id="modify-city" placeholder="Entrez la nouvelle ville" /><br />
                <button type="submit">Modifier</button>
              </form>
            </div>
          </div>
          <!-- Supprimer une Équipe -->
          <div class="clearfix single_content" id="equipe-supp" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Supprimer une Équipe</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="supprimer-equipe.php" method="POST" class="input-group">
                <label for="equipe-id-suppr">ID de l'Équipe :</label>
                <input type="text" name="equipe-id-suppr" id="equipe-id-suppr" placeholder="Entrez l'ID de l'équipe à supprimer" required /><br />
                <button type="submit">Supprimer</button>
              </form>
            </div>
          </div>

        </div><!-- Fin Gestion des Équipes -->

        <!-- Gestion des Stades -->
        <div class="clearfix content content-section" id="gestion-stades" style="display:none;">
          <div class="content_title">
            <h2>Gestion des Stades :<button class="bt" onclick="afficherFormulaire('stade-ajouter')">Ajouter</button>
        <button class="bt" onclick="afficherFormulaire('stade-modifier')">Modifier</button>
        <button class="bt" onclick="afficherFormulaire('stade-supp')">Supprimer</button></h2>
          </div>
          <!-- Ajouter un Stade -->
          <div class="clearfix single_content" id="stade-ajouter" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Ajouter un Stade</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="ajouter-stade.php" method="POST" class="input-group">
                <label for="stade-name">Nom du Stade :</label>
                <input type="text" name="stade-name" id="stade-name" placeholder="Entrez le nom du stade" required /><br />
                <label for="stade-city">Ville du Stade :</label>
                <input type="text" name="stade-city" id="stade-city" placeholder="Entrez la ville" required /><br />
                <label for="stade-capacity">Capacité :</label>
                <input type="number" name="stade-capacity" id="stade-capacity" placeholder="Entrez la capacité" required /><br />
                <button type="submit">Ajouter</button>
              </form>
            </div>
          </div>
          <!-- Modifier un Stade -->
          <div class="clearfix single_content" id="stade-modifier" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Modifier un Stade</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="modifier-stade.php" method="POST" class="input-group">
                <label for="modify-stade-id">ID du Stade :</label>
                <input type="text" name="modify-stade-id" id="modify-stade-id" placeholder="Entrez l'ID du stade à modifier" required /><br />
                <label for="modify-stade-name">Nouveau Nom :</label>
                <input type="text" name="modify-stade-name" id="modify-stade-name" placeholder="Entrez le nouveau nom du stade" /><br />
                <label for="modify-stade-city">Nouvelle Ville :</label>
                <input type="text" name="modify-stade-city" id="modify-stade-city" placeholder="Entrez la nouvelle ville" /><br />
                <button type="submit">Modifier</button>
              </form>
            </div>
          </div>
          <!-- Supprimer un Stade -->
          <div class="clearfix single_content" id="stade-supp" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Supprimer un Stade</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="supprimer-stade.php" method="POST" class="input-group">
                <label for="supp-stade-id">ID du Stade :</label>
                <input type="text" name="supp-stade-id" id="supp-stade-id" placeholder="Entrez l'ID du stade à supprimer" required /><br />
                <button type="submit">Supprimer</button>
              </form>
            </div>
          </div>
          
        </div><!-- Fin Gestion des Stades -->

        <!-- Gestion des Staff -->
        <div class="clearfix content content-section" id="gestion-staff" style="display:none;">
          <div class="content_title">
            <h2>Gestion des Staff: <button class="bt" onclick="afficherFormulaire('staff-ajouter')">Ajouter</button>
        <button class="bt" onclick="afficherFormulaire('staff-modifier')">Modifier</button>
        <button class="bt" onclick="afficherFormulaire('staff-supp')">Supprimer</button></h2>
          </div>
          <!-- Ajouter un Staff -->
          <div class="clearfix single_content" id="staff-ajouter" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Ajouter un Staff</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="ajouter-staff.php" method="POST" class="input-group">
                <label for="staff-name">Nom du Staff :</label>
                <input type="text" name="staff-name" id="staff-name" placeholder="Entrez le nom du staff" required /><br />
                <label for="staff-role">Role :</label>
                <br>
                <select name="staff-role" id="staff-role">
                  <option value="Entraîneur principal">Entraîneur principal</option>
                  <option value="Entraîneurs adjoints">Entraîneurs adjoints</option>
                  <option value="Préparateur physique">Préparateur physique</option>
                  <option value="Entraîneur des gardiens">Entraîneur des gardiens</option>
                  <option value="Médecin de l'équipe">Médecin de l'équipe</option>
                  <option value="Kinésithérapeute ">Kinésithérapeute</option>
                </select>
                <br>
                <label for="staff-date-debut">Date Debut :</label>
                <input type="date" name="staff-date-debut" id="staff-date-debut" placeholder="Entrez La date de debut" required /><br />
                <label for="staff-date-debut">Date Fin :</label>
                <input type="date" name="staff-date-fin" id="staff-date-fin" placeholder="Entrez La date de fin" required /><br />
                <label for="staff-NumEquipe">Numero d'Equipe :</label>
                <input type="text" name="staff-NumEquipe" id="staff-NumEquipe" placeholder="Entrez le nom du staff" required /><br />
                <button type="submit">Ajouter</button>
              </form>
            </div>
          </div>
          <!-- Modifier un Staff -->
          <div class="clearfix single_content" id="staff-modifier" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Modifier un Staff</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="modifier-staff.php" method="POST" class="input-group">
                <label for="modify-staff-id">ID du Staff :</label>
                <input type="text" name="modify-staff-id" id="modify-staff-id" placeholder="Entrez l'ID du staff à modifier" required /><br />
                <label for="modify-staff-name">Nouveau Nom :</label>
                <input type="text" name="modify-staff-name" id="modify-staff-name" placeholder="Entrez le nouveau nom" /><br />
                <label for="modify-staff-city">Nouvelle Role :</label>
                <br>
                <select name="modify-staff-role" id="modify-staff-role">
                  <option value="Entraîneur principal">Entraîneur principal</option>
                  <option value="Entraîneurs adjoints">Entraîneurs adjoints</option>
                  <option value="Préparateur physique">Préparateur physique</option>
                  <option value="Entraîneur des gardiens">Entraîneur des gardiens</option>
                  <option value="Médecin de l'équipe">Médecin de l'équipe</option>
                  <option value="Kinésithérapeute ">Kinésithérapeute</option>
                </select>
                <br>
                <label for="modify-staff-date-debut">Date Debut :</label>
                <input type="date" name="modify-staff-date-debut" id="modify-staff-date-debut" placeholder="Entrez La date de debut" required /><br />
                <label for="modify-staff-date-debut">Date Fin :</label>
                <input type="date" name="modify-staff-date-fin" id="modify-staff-date-fin" placeholder="Entrez La date de fin" required /><br />
                <label for="modify-staff-NumEquipe">Numero d'Equipe :</label>
                <input type="text" name="modify-staff-NumEquipe" id="modify-staff-NumEquipe" placeholder="Entrez le nom du staff" required /><br />
                <button type="submit">Modifier</button>
              </form>
            </div>
          </div>
          <!-- Supprimer un Staff -->
          <div class="clearfix single_content" id="staff-supp" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Supprimer un Staff</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="supprimer-staff.php" method="POST" class="input-group">
                <label for="supp-staff-id">ID du Staff :</label>
                <input type="text" name="supp-staff-id" id="supp-staff-id" placeholder="Entrez l'ID du staff à supprimer" required /><br />
                <button type="submit">Supprimer</button>
              </form>
            </div>
          </div>
          
        </div><!-- Fin Gestion des Staff -->

        <!-- Gestion des comptes administrateur tournoi -->
        <div class="clearfix content content-section" id="creer-compte" style="display:none;">
          <div class="content_title">
            <h2>Gestion des administrateurs tournoi: <button class="bt" onclick="afficherFormulaire('admin-ajouter')">Ajouter</button>
        <button class="bt" onclick="afficherFormulaire('admin-modifier')">Modifier</button>
        <button class="bt" onclick="afficherFormulaire('admin-supp')">Supprimer</button></h2>
          </div>
          <!-- Ajouter un administrateur -->
          <div class="clearfix single_content" id="admin-ajouter" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Ajouter un administrateur</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="ajouter-admin.php" method="POST" class="input-group">
                <label for="admin-name">Nom de l'administrateur :</label>
                <input type="text" id="admin-name" name="nom" placeholder="Entrez le nom de l'administrateur" required /><br />
                <label for="admin-prenom">Prénom de l'administrateur :</label>
                <input type="text" id="admin-prenom" name="prenom" placeholder="Entrez le prénom de l'administrateur" required /><br />
                <label for="admin-date-naiss">Date de naissance :</label>
                <input type="date" id="admin-date-naiss" name="date_naissance" required /><br />
                <label for="admin-tournoi">Tournoi :</label>
                <input type="text" id="admin-tournoi" name="tournoi" placeholder="Entrez le tournoi" required /><br />
                <label for="admin-email">Email :</label>
                <input type="email" id="admin-email" name="email" placeholder="Entrez l'email" required /><br />
                <button type="submit">Ajouter</button>
              </form>
            </div>
          </div>
          <!-- Modifier un administrateur -->
          <div class="clearfix single_content" id="admin-modifier" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Modifier un administrateur</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="modifier-admin.php" method="POST" class="input-group">
                <label for="modify-admin-id">ID de l'administrateur :</label>
                <input type="text" id="modify-admin-id" name="id" placeholder="Entrez l'ID de l'administrateur à modifier" required /><br />
                <label for="modify-name-admin">Nouveau Nom :</label>
                <input type="text" id="modify-name-admin" name="nom" placeholder="Entrez le nouveau nom" /><br />
                <label for="modify-prenom-admin">Nouveau Prénom :</label>
                <input type="text" id="modify-prenom-admin" name="prenom" placeholder="Entrez le nouveau prénom" /><br />
                <label for="modify-admin-naiss">Nouvelle date de naissance :</label>
                <input type="date" id="modify-admin-naiss" name="date_naissance" /><br />
                <label for="modify-tournoi-admin">Nouveau tournoi :</label>
                <input type="text" id="modify-tournoi-admin" name="tournoi" placeholder="Entrez le nouveau tournoi" /><br />
                <button type="submit">Modifier</button>
              </form>
            </div>
          </div>
          <!-- Supprimer un administrateur -->
          <div class="clearfix single_content" id="admin-supp" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Supprimer un administrateur</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="supprimer-admin.php" method="POST" class="input-group">
                <label for="admin-id-suppr">ID de l'administrateur :</label>
                <input type="text" id="admin-id-suppr" name="id" placeholder="Entrez l'ID de l'administrateur à supprimer" required /><br />
                <button type="submit">Supprimer</button>
              </form>
            </div>
          </div>
          
        </div><!-- Fin Gestion des comptes administrateur -->

        <!-- Gestion des articles -->
        <div class="clearfix content content-section" id="creer-article" style="display:none;">
          <div class="content_title">
            <h2>Gestion des articles: <button class="bt" onclick="afficherFormulaire('article-ajouter')">Ajouter</button>
        <button class="bt" onclick="afficherFormulaire('article-modifier')">Modifier</button>
        <button class="bt" onclick="afficherFormulaire('article-supp')">Supprimer</button></h2>
          </div>
          <!-- Ajouter un article -->
          <div class="clearfix single_content" id="article-ajouter" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Ajouter un article</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="ajouter-article.php" method="POST" class="input-group" enctype="multipart/form-data">
                <label for="titre_article">Titre de l'article :</label>
                <input type="text" id="titre_article" name="titre" placeholder="Entrez le titre de l'article" required /><br />
                <label for="these-article">Thèse de l'article :</label>
                <input type="text" id="these-article" name="these" placeholder="Entrez la thèse" required /><br />
                <label for="contenu-article">Contenu de l'article :</label>
                <textarea name="contenu" id="contenu-article" rows="5" cols="80" required></textarea><br />
                <label for="image-article">Image :</label>
                <input type="file" id="image-article" name="image" accept="image/*" /><br />
                <button type="submit">Ajouter</button>
              </form>
            </div>
          </div>
          <!-- Modifier un article -->
          <div class="clearfix single_content" id="article-modifier" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Modifier un article</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="modifier-article.php" method="POST" class="input-group" enctype="multipart/form-data">
                <label for="modify-article-id">ID de l'article :</label>
                <input type="text" id="modify-article-id" name="id" placeholder="Entrez l'ID de l'article à modifier" required /><br />
                <label for="modify-titre-article">Nouveau Titre :</label>
                <input type="text" id="modify-titre-article" name="titre" placeholder="Entrez le nouveau titre de l'article" /><br />
                <label for="modify-these-article">Nouvelle thèse :</label>
                <input type="text" id="modify-these-article" name="these" placeholder="Entrez la nouvelle thèse de l'article" /><br />
                <label for="modify-article-contenu">Nouveau contenu :</label>
                <textarea name="contenu" id="modify-article-contenu" rows="20" cols="80"></textarea><br />
                <label for="modify-article-image">Nouvelle image :</label>
                <input type="file" id="modify-article-image" name="image" accept="image/*" /><br />
                <button type="submit">Modifier</button>
              </form>
            </div>
          </div>
          <!-- Supprimer un article -->
          <div class="clearfix single_content" id="article-supp" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Supprimer un article</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="supprimer-article.php" method="POST" class="input-group">
                <label for="article-id-supp">ID de l'article :</label>
                <input type="text" id="article-id-supp" name="id" placeholder="Entrez l'ID de l'article à supprimer" required /><br />
                <button type="submit">Supprimer</button>
              </form>
            </div>
          </div>
          
        </div><!-- Fin Gestion des articles -->

        <div class="clearfix content content-section" id="gestion-tournoi">
          <div class="content_title">
            <h2>Gestion des Tournois:       <button class="bt" onclick="afficherFormulaire('tournoi-ajouter')">Ajouter</button>
        <button class="bt" onclick="afficherFormulaire('tournoi-modifier')">Modifier</button>
        <button class="bt" onclick="afficherFormulaire('tournoi-supp')">Supprimer</button></h2>
          </div>
          <!-- Ajouter un Tournoi -->
          <div class="clearfix single_content" id="tournoi-ajouter" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Ajouter un Tournoi</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="ajout_tournoi.php" method="POST" class="input-group">
                <label for="tournoi-name">Nom du Tournoi :</label>
                <input type="text" id="tournoi-name" name="nom" placeholder="Entrez le nom du tournoi" required /><br />
                <label for="tournoi-description">Description :</label><br>
                <textarea id="tournoi-description" name="description" placeholder="Entrez la description" required rows="4" cols="50"></textarea><br />
                <label for="tournoi-type">Type :</label>
                <select id="tournoi-type" name="type" required>
                  <option value="international">International</option>
                  <option value="national">National</option>
                </select><br />
                <label for="tournoi-debut">Date de début :</label>
                <input type="date" id="tournoi-debut" name="date_debut" required /><br />
                <label for="tournoi-fin">Date de fin :</label>
                <input type="date" id="tournoi-fin" name="date_fin" required /><br />
                <button type="submit">Ajouter</button>
              </form>
            </div>
          </div>
          <!-- Supprimer un Tournoi -->
          <div class="clearfix single_content" id="tournoi-supp" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Supprimer un Tournoi</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="supprimer_tournoi.php" method="POST" class="input-group">
                <label for="tournoi-id">ID du Tournoi :</label>
                <input type="text" id="tournoi-id" name="id" placeholder="Entrez l'ID du tournoi" required /><br />
                <button type="submit">Supprimer</button>
              </form>
            </div>
          </div>
          <!-- Modifier un Tournoi -->
          <div class="clearfix single_content" id="tournoi-modifier" style="display: none;">
            <div class="clearfix post_date floatleft">
              <h3>Modifier un Tournoi</h3>
            </div>
            <div class="clearfix post_detail">
              <form action="modifier_tournoi.php" method="POST" class="input-group">
                <label for="modify-tournoi-id">ID du Tournoi :</label>
                <input type="text" id="modify-tournoi-id" name="id" placeholder="Entrez l'ID du tournoi" required /><br />
                <label for="modify-tournoi-name">Nouveau Nom :</label>
                <input type="text" id="modify-tournoi-name" name="nom" placeholder="Entrez le nouveau nom" required /><br />
                <label for="modify-tournoi-description">Nouvelle Description :</label><br>
                <textarea id="modify-tournoi-description" name="description" placeholder="Entrez la nouvelle description" required rows="4" cols="50"></textarea><br />
                <label for="modify-tournoi-type">Nouveau Type :</label>
                <select id="modify-tournoi-type" name="type" required>
                  <option value="international">International</option>
                  <option value="national">National</option>
                </select><br />
                <label for="modify-tournoi-debut">Nouvelle date de début :</label>
                <input type="date" id="modify-tournoi-debut" name="date_debut" required /><br />
                <label for="modify-tournoi-fin">Nouvelle date de fin :</label>
                <input type="date" id="modify-tournoi-fin" name="date_fin" required /><br />
                <button type="submit">Modifier</button>
              </form>
            </div>
          </div>
         
        </div><!-- Fin Gestion des Tournois -->


      </div><!-- .main_content -->
    </div><!-- .wrapper -->
  </section><!-- #content_area -->
</body>
</html>