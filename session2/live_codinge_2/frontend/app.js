const API = "../backend/api.php";

let formulaire = document.getElementById("form-categorie");
let tableau = document.getElementById("table-categories-body");

// Afficher les genres
function afficher() {
    fetch(API)
        .then(response => response.json())
        .then(categories => {
            tableau.innerHTML = "";

            categories.forEach(cat => {
                tableau.innerHTML += `
                    <tr>
                        <td class="p-4">${cat.id}</td>
                        <td class="p-4">${cat.genre || cat.nom}</td>
                        <td class="p-4">
                            <button onclick="supprimer(${cat.id})">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                `;
            });
        });
}

// Ouvrir le formulaire
document.getElementById("btn-show-form").onclick = function () {
    document.getElementById("section-form").classList.remove("hidden");
};

// Ajouter un genre
formulaire.onsubmit = function (event) {
    event.preventDefault();

    let genre = {
        genre: document.getElementById("cat-genre").value
    };

    fetch(API, {
        method: "POST",
        body: JSON.stringify(genre)
    }).then(() => {
        formulaire.reset();
        document.getElementById("section-form").classList.add("hidden");
        afficher();
    });
};

// Supprimer une catégorie
function supprimer(id) {
    fetch(API, {
        method: "DELETE",
        body: JSON.stringify({ id: id })
    }).then(() => afficher());
}

// Lancer l'affichage
afficher();
