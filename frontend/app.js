const API = "../backend/api.php";
const byId = id => document.getElementById(id);
const form = byId("genreForm");

const createText = (tag, className, text) => {
    const element = document.createElement(tag);
    element.className = className;
    element.textContent = text;
    return element;
};

function afficherGenres(genres) {
    const container = byId("genres");
    container.innerHTML = genres.length ? "" : '<p class="text-slate-500">Aucun genre pour le moment.</p>';
    if (!genres.length) return;

    genres.forEach(({ id, nom }) => {
        const card = document.createElement("article");
        card.className = "rounded-lg border border-slate-200 bg-white p-5 shadow-sm";
        card.append(
            createText("h3", "break-words text-lg font-semibold text-slate-900", nom),
            createText("p", "mt-2 text-sm text-slate-500", `ID : ${id}`)
        );
        container.append(card);
    });
}

function afficherDonnees() {
    fetch(API).then(response => response.json()).then(data => afficherGenres(data.genres));
}

byId("ouvrirForm").addEventListener("click", () => {
    form.classList.remove("hidden");
    byId("nom").focus();
});

byId("annulerForm").addEventListener("click", () => {
    form.reset();
    form.classList.add("hidden");
});

form.addEventListener("submit", async event => {
    event.preventDefault();
    const response = await fetch(API, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ type: "genre", nom: byId("nom").value })
    });
    if (!(await response.json()).success) return;
    form.reset();
    form.classList.add("hidden");
    afficherDonnees();
});

afficherDonnees();