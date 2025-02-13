<?php include 'header.php'; ?>

<div class="content-container">
    <h1>Boutique</h1>
    <div class="produits-grid">
        <div class="produit">
        <img src="images/image.png" alt="T-shirt">
            <h2>T-shirt</h2>
            <p>Prix : 50€</p>
            <select class="couleur-select" data-product-id="1">
                <option value="">Choisir une couleur</option>
                <option value="Blanc">Blanc</option>
                <option value="Noir">Noir</option>
                <option value="Rouge">Rouge</option>
            </select>
            <select class="taille-select" data-product-id="1">
                <option value="">Choisir une taille</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
            <div class="floquage-option">
                <select id="flocage" name="flocage" onchange="toggleInitiales()" required>
                    <option value="">Souhaitez-vous un flocage</option>
                    <option value="non">Non</option>
                    <option value="oui">Oui</option>
                </select>
                
                <div id="initiales-container" style="display: none;">
                    <label for="initiales">Initiales pour le flocage :</label>
                    <input type="text" id="initiales" name="initiales" maxlength="2" placeholder="Ex : AB">
                </div>
            </div>
            <button class="ajouter-panier" data-id="1" data-nom="T-shirt" data-prix="50">Ajouter au panier</button>
        </div>
        <div class="produit">
            <img src="images/image.png" alt="Polo">
            <h2>Polo</h2>
            <p>Prix : 35€</p>
            <select class="couleur-select" data-product-id="2">
                <option value="">Choisir une couleur</option>
                <option value="Blanc">Blanc</option>
                <option value="Bleu">Bleu</option>
                <option value="Gris">Gris</option>
            </select>
            <select class="taille-select" data-product-id="2">
                <option value="">Choisir une taille</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
            <div class="floquage-option">
                <select id="flocage" name="flocage" onchange="toggleInitiales()" required>
                    <option value="">Souhaitez-vous un flocage</option>
                    <option value="non">Non</option>
                    <option value="oui">Oui</option>
                </select>
                
                <div id="initiales-container" style="display: none;">
                    <label for="initiales">Initiales pour le flocage :</label>
                    <input type="text" id="initiales" name="initiales" maxlength="2" placeholder="Ex : AB">
                </div>
            </div>
            <button class="ajouter-panier" data-id="2" data-nom="Polo" data-prix="35">Ajouter au panier</button>
        </div>
    </div>

    <div id="panier">
        <h2>Votre panier</h2>
        <ul id="liste-panier"></ul>
        <p>Total : <span id="total-panier">0</span> €</p>
        <form id="form-commande" action="traitement-commande.php" method="post">
            <input type="hidden" name="total" id="total-commande" value="0">
            <input type="hidden" name="details" id="details-commande" value="">
            <button type="submit" id="payer-commande">Payer la commande</button>
        </form>
    </div>
</div>


<script>
    function toggleInitiales() {
        const flocage = document.getElementById('flocage').value;
        const initialesContainer = document.getElementById('initiales-container');
        initialesContainer.style.display = (flocage === 'oui') ? 'block' : 'none';
    }
</script>
<?php include 'footer.php'; ?>