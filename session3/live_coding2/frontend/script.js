const API = '../backend/api/api.php';

document.addEventListener('DOMContentLoaded', ()=>{
    let Showform = document.getElementById('showForm');
    let form = document.getElementById('form');
    let nom = document.getElementById('nom');
    let auteur = document.getElementById('auteur');
    let ajouter = document.getElementById('ajouter')
    let annuler = document.getElementById('annuler');
    let table = document.getElementById('table_body');

    function setLoading(isLoading){
        ajouter.disabled = isLoading;
        if(isLoading){
            ajouter.textContent = 'Enregistrement...';
        }else{
            ajouter.textContent = 'Enregistrer';
        }
    }

    function showToast(message, type = 'success'){
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');

        toast.className = "text-white p-4 mb-2 rounded-lg shadow-lg";
        if (type === 'success') {
            toast.classList.add('bg-green-600');
        } else {
            toast.classList.add('bg-red-600');
        }
        toast.textContent = message;

        container.appendChild(toast);

        setTimeout(()=>{
            toast.remove();
        }, 5000);
    }

    function affichergenre(){
        fetch(API)
        .then(response=>{
            if (!response.ok) throw new Error('Impossible de charger les genres.');
            return response.json();
        })
        .then(genre =>{
            table.innerHTML = '';
            genre.forEach(item => {
                const row = document.createElement('tr');
                const nameCell = document.createElement('td');
                const authorCell = document.createElement('td');
                nameCell.className = 'border border-gray-500 px-4 py-2 md:px-3';
                authorCell.className = 'border border-gray-500 px-4 py-2 md:px-3';
                nameCell.textContent = item.nom;
                authorCell.textContent = item.auteur;
                row.append(nameCell, authorCell);
                table.appendChild(row);
            });
        })
        .catch(error => {
            showToast(error.message, 'error');
            console.error(error);
        });
    }

    Showform.addEventListener('click', ()=>{
        Showform.hidden = true;
        form.hidden = false;
    });

    annuler.addEventListener('click', ()=>{
        Showform.hidden = false;
        form.hidden = true;
    });

    form.addEventListener('submit', (event)=>{
        event.preventDefault();
        setLoading(true);
        let newgenre = {nom: nom.value, auteur: auteur.value,};
        fetch(API,{
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify(newgenre)
        })
        .then(async response=>{
            const result = await response.json();
            if (!response.ok) throw new Error(result.message || 'Erreur pendant l’enregistrement.');
            return result;
        })
        .then(genre=>{
            showToast("genre enregistrée avec succès !", "success");
            form.reset();
            Showform.hidden = false;
            form.hidden = true;
            affichergenre()
        })
        .catch(error => {
            showToast("Erreur réseau : Impossible de contacter le serveur.", "error");
            console.error(error);
        })
        .finally(() => {
            setLoading(false);
        });
    });

    affichergenre();
})