function updateJoueurs() {
    var equipeId = document.getElementById("equipe-id-supp").value; // Récupérer l'ID de l'équipe sélectionnée

    // Vérifier que l'équipe est valide
    if (equipeId === "") {
        document.getElementById("joueur-id-supp").innerHTML = "<option value=''>Veuillez choisir une équipe d'abord</option>";
        return;
    }

    // Charger les données JSON dynamiques générées par le PHP (sans fichier intermédiaire)
    fetch('joueur_par_equipe.json')  // Remplacez par le chemin correct de votre script PHP
        .then(response => response.json())
        .then(data => {
            // Vérifier si l'équipe existe dans les données
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

            // Si aucun joueur trouvé, ajouter une option par défaut
            if (joueurs.length === 0) {
                var option = document.createElement("option");
                option.value = '';
                option.textContent = 'Aucun joueur trouvé';
                joueurSelect.appendChild(option);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            // Optionnellement, afficher un message d'erreur dans l'interface utilisateur
            document.getElementById("joueur-id-supp").innerHTML = "<option value=''>Erreur de chargement des joueurs</option>";
        });
}
