document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("matchPollForm");
    const resultDiv = document.getElementById("pollResult");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch("votes.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                loadResults();
            } else {
                alert("Erreur : " + data.message);
            }
        })
        .catch(error => console.error("Erreur :", error));
    });

    function loadResults() {
        fetch("pollResults.php")
        .then(response => response.json())
        .then(data => {
            resultDiv.innerHTML = "<h3>Résultats :</h3><ul>";
            data.forEach(entry => {
                resultDiv.innerHTML += `<li><strong>${entry.NomEquipe} :</strong> ${entry.NombreVotes} votes</li>`;
            });
            resultDiv.innerHTML += "</ul>";
        })
        .catch(error => console.error("Erreur :", error));
    }

    loadResults(); // Charger les résultats au chargement de la page
});
