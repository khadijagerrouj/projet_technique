const API = "../backend/api.php";
const byId = id => document.getElementById(id);
const form = byId("livreForm");

const createText = (tag, className, text) => {
    const element = document.createElement(tag);
    element.className = className;
    element.textContent = text;
    return element;
};

function afficherLivres(livres) {
    const container = byId("livres");
    container.innerHTML = livres.length ? "" : '<p class="text-slate-500">Aucun livre pour le moment.</p>';
    if (!livres.length) return;

    livres.forEach(({ titre, auteur, genre }) => {
        const card = document.createElement("article");
        card.className = "rounded-lg border border-slate-200 bg-white p-5 shadow-sm";
        [
            ["h3", "mb-4 break-words text-lg font-semibold text-slate-900", titre],
            ["p", "mb-2 break-words text-sm text-slate-600", `Auteur : ${auteur}`],
            ["p", "break-words text-sm text-slate-600", `Genre : ${genre}`]
        ].forEach(args => card.append(createText(...args)));
        container.append(card);
    });
}

function afficherDonnees() {
    fetch(API).then(response => response.json()).then(data => afficherLivres(data.livres));
}

byId("ouvrirForm").addEventListener("click", () => {
    form.classList.remove("hidden");
    byId("titre").focus();
});

byId("annulerForm").addEventListener("click", () => {
    form.reset();
    form.classList.add("hidden");
});

form.addEventListener("submit", async event => {
    event.preventDefault();
    const livre = { type: "livre" };
    ["titre", "auteur", "genre"].forEach(id => livre[id] = byId(id).value);

    const response = await fetch(API, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(livre)
    });
    if (!(await response.json()).success) return;
    form.reset();
    form.classList.add("hidden");
    afficherDonnees();
});

afficherDonnees();