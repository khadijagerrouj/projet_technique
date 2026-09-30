<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion de bibliothèque</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="bg-slate-900 px-6 py-8 text-center text-white">
        <h1 class="text-3xl font-bold">Gestion de bibliothèque</h1>
        <p class="mt-2 text-slate-300">Gérez votre collection de livres</p>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        <section>
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-2xl font-semibold">📚 Mes livres</h2>
                <button
                    type="button"
                    id="ouvrirForm"
                    class="rounded-md bg-emerald-700 px-5 py-3 font-semibold text-white transition hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                >
                    Ajouter un livre
                </button>
            </div>

            <form id="livreForm" class="hidden mb-8 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="mb-4 text-lg font-semibold">Nouveau livre</h3>
                <div class="grid gap-4 sm:grid-cols-3">
                    <input
                        type="text"
                        id="titre"
                        placeholder="Titre du livre"
                        required
                        class="w-full rounded-md border border-slate-300 px-3 py-2.5 focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600"
                    >
                    <input
                        type="text"
                        id="auteur"
                        placeholder="Auteur"
                        required
                        class="w-full rounded-md border border-slate-300 px-3 py-2.5 focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600"
                    >
                    <input
                        type="text"
                        id="genre"
                        placeholder="Genre"
                        required
                        class="w-full rounded-md border border-slate-300 px-3 py-2.5 focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600"
                    >
                </div>
                <div class="mt-5 flex justify-end gap-3">
                    <button
                        type="button"
                        id="annulerForm"
                        class="rounded-md border border-slate-300 px-4 py-2.5 font-medium text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-400"
                    >
                        Annuler
                    </button>
                    <button
                        type="submit"
                        class="rounded-md bg-emerald-700 px-4 py-2.5 font-semibold text-white transition hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                    >
                        Ajouter
                    </button>
                </div>
            </form>

            <div id="livres" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3"></div>
        </section>
    </main>


    <script src="app.js"></script>

</body>

</html>