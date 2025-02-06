document.addEventListener('DOMContentLoaded', function() {
    const boutonsPanier = document.querySelectorAll('.ajouter-panier');
    const listePanier = document.getElementById('liste-panier');
    const totalPanier = document.getElementById('total-panier');
    const formCommande = document.getElementById('form-commande');
    const totalCommande = document.getElementById('total-commande');
    const detailsCommande = document.getElementById('details-commande');
    let panier = [];

    boutonsPanier.forEach(bouton => {
        bouton.addEventListener('click', function() {
            const productId = this.dataset.id;
            const couleurSelect = document.querySelector(`.couleur-select[data-product-id="${productId}"]`);
            const tailleSelect = document.querySelector(`.taille-select[data-product-id="${productId}"]`);
            const couleur = couleurSelect.value;
            const taille = tailleSelect.value;

            if (!couleur || !taille) {
                alert('Veuillez sélectionner une couleur et une taille avant d\'ajouter au panier.');
                return;
            }

            const produit = {
                id: productId,
                nom: this.dataset.nom,
                prix: parseFloat(this.dataset.prix),
                couleur: couleur,
                taille: taille
            };
            ajouterAuPanier(produit);
            mettreAJourAffichagePanier();
        });
    });

    function ajouterAuPanier(produit) {
        const item = panier.find(i => i.id === produit.id && i.taille === produit.taille && i.couleur === produit.couleur);
        if (item) {
            item.quantite++;
        } else {
            panier.push({...produit, quantite: 1});
        }
    }

    function retirerDuPanier(id, taille, couleur) {
        const index = panier.findIndex(item => item.id === id && item.taille === taille && item.couleur === couleur);
        if (index !== -1) {
            if (panier[index].quantite > 1) {
                panier[index].quantite--;
            } else {
                panier.splice(index, 1);
            }
        }
        mettreAJourAffichagePanier();
    }

    function mettreAJourAffichagePanier() {
        listePanier.innerHTML = '';
        let total = 0;
        panier.forEach(item => {
            const li = document.createElement('li');
            li.innerHTML = `
                ${item.nom} (${item.couleur}, ${item.taille}) x ${item.quantite} - ${(item.prix * item.quantite).toFixed(2)}€
                <button class="retirer-du-panier" data-id="${item.id}" data-taille="${item.taille}" data-couleur="${item.couleur}">Retirer</button>
            `;
            listePanier.appendChild(li);
            total += item.prix * item.quantite;
        });
        totalPanier.textContent = total.toFixed(2);
        totalCommande.value = total.toFixed(2);
        detailsCommande.value = panier.map(item => `${item.nom} (${item.couleur}, ${item.taille}) x ${item.quantite}`).join(', ');

        // Ajouter des écouteurs d'événements pour les boutons de suppression
        const boutonsRetirer = document.querySelectorAll('.retirer-du-panier');
        boutonsRetirer.forEach(bouton => {
            bouton.addEventListener('click', function() {
                retirerDuPanier(this.dataset.id, this.dataset.taille, this.dataset.couleur);
            });
        });
    }

    formCommande.addEventListener('submit', function(e) {
        if (panier.length === 0) {
            e.preventDefault();
            alert('Votre panier est vide !');
        }
    });
});