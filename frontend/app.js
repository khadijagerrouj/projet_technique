const API = "../backend/api.php";


/* =========================
   AFFICHER LES DONNÉES
========================= */

function afficherDonnees() {

    fetch(API)
        .then(response => response.json())
        .then(data => {

            afficherLivres(data.livres);

        });
}


/* =========================
   AFFICHER LES LIVRES
========================= */

function afficherLivres(livres) {

    const container = document.getElementById("livres");

    container.innerHTML = "";

    if (livres.length === 0) {
        container.innerHTML = '<p class="text-slate-500">Aucun livre pour le moment.</p>';
        return;
    }

    livres.forEach(livre => {

        const card = document.createElement("article");
        card.className = "rounded-lg border border-slate-200 bg-white p-5 shadow-sm";

        const title = document.createElement("h3");
        title.className = "mb-4 break-words text-lg font-semibold text-slate-900";
        title.textContent = livre.titre;

        const author = document.createElement("p");
        author.className = "mb-2 break-words text-sm text-slate-600";
        author.textContent = `Auteur : ${livre.auteur}`;

        const genre = document.createElement("p");
        genre.className = "break-words text-sm text-slate-600";
        genre.textContent = `Genre : ${livre.genre}`;

        card.append(title, author, genre);
        container.appendChild(card);

    });
}


/* =========================
   AFFICHER / ANNULER LE FORMULAIRE
========================= */

const livreForm = document.getElementById("livreForm");

document.getElementById("ouvrirForm").addEventListener("click", function() {
    livreForm.classList.remove("hidden");
    document.getElementById("titre").focus();
});

document.getElementById("annulerForm").addEventListener("click", function() {
    livreForm.reset();
    livreForm.classList.add("hidden");
});


/* =========================
   AJOUTER UN LIVRE
========================= */

livreForm.addEventListener("submit", function(e) {

    e.preventDefault();

    const livre = {

        type: "livre",

        titre: document.getElementById("titre").value,

        auteur: document.getElementById("auteur").value,

        genre: document.getElementById("genre").value
    };


    fetch(API, {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify(livre)

    })
    .then(response => response.json())
    .then(data => {

        if (data.success) {

            this.reset();
            this.classList.add("hidden");

            afficherDonnees();
        }

    });

});


/* =========================
   CHARGER LES DONNÉES
========================= */

afficherDonnees();