<div class="container">
    <h1>Créer un événement</h1>
    <?php
    // Vérification de la présence d'une erreur dans l'URL
    if(isset($_GET['error'])) {
        $errorMessage = urldecode($_GET['error']);
        // Affichage de l'erreur dans votre vue
        echo '<div class="error-message">' . $errorMessage . '</div>';
        }
        ?>
    <form action="/here_we_go/submitEvent" method="post">
        <p class="heure-date"> Les Informations</p>
        <div class="row">
            <div class="col-md-7">
                <label for="titre" class="form-label">Nom de l'événement<span class="red-star"> *</span> :</label>
                <input type="text" class="form-control" id="titre" name="titre" maxlength="50" placeholder="Nom de l'événement">
            </div>
            <div class="col-md-6 mt-3">
                <label for="date_event" class="form-label">Date de l'événement<span class="red-star"> *</span> :</label>
                <input type="date" class="form-control" id="date_event" name="date_event">
            </div>
            <div class="col-md-6 mt-3">
                <label for="heure_event" class="form-label">Heure de l'événement<span class="red-star"> *</span> :</label>
                <input type="time" class="form-control" id="heure_event" name="heure_event">
            </div>
        </div>
        <p class="heure-date"> Le lieu</p>
        <div class="row">
            <div class="col-md-6">
                <label for="nom_structure" class="form-label">Nom de la structure<span class="red-star"> *</span> :</label>
                <input type="text" class="form-control" id="nom_structure" name="nom_structure" maxlength="75" placeholder="Nom de la structure qui accueil l'événement">
            </div>
            <div class="col-md-12 mt-3">
                <label for="adresse" class="form-label">Adresse<span class="red-star"> *</span> :</label>
                <input type="text" class="form-control" id="adresse" name="adresse" maxlength="75" placeholder="Entrer l'adresse de l'événement">
            </div>
            <div class="col-md-6 mt-3">
                <label for="ville" class="form-label">Ville<span class="red-star"> *</span> :</label>
                <input type="text" class="form-control" id="ville" name="ville" maxlength="75" placeholder="Entrer la ville de l'événement">
            </div>
            <div class="col-md-6 mt-3">
                <label for="code_postal" class="form-label">Code Postal<span class="red-star"> *</span> :</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder= "Code postal de l'événement">
            </div>
        </div>
        <p class="heure-date"> La description de l'événement</p>
        <div class="row">
            <div class="col-md-12">
                <label for="description_courte" class="form-label mt-3">Description courte<span class="red-star"> *</span> :</label>
                <textarea class="form-control" id="description_courte" name="description_courte" maxlength="100" placeholder="Description courte de votre événement"></textarea>
            </div>
            <div class="mb-12">
                <label for="description_longue" class="form-label mt-3">Description longue <span class="red-star"> *</span>:</label>
                <textarea class="form-control" id="description_longue" name="description_longue" placeholder="Description longue de votre événement"></textarea>
            <div class="col-6">
                <label for="id_categorie" class="form-label mt-3">Choisir une categorie <span class="red-star"> *</span>:</label>
                <select name="id_categorie" id="id_categorie" class="form-select mb-3">
                    <?php foreach ($categories as $categorie) {
                        echo "<option value=".$categorie->getIdCategorie().">".$categorie->getLibelleCategorie()."</option>";
                    } ?>
                </select>
            </div>
        </div>
        <p class="heure-date">Les informations de réservation </p>
        <div class="row">
            <div class="col-md-6">
                <label for="nb_places" class="form-label">Nombre de places<span class="red-star"> *</span> :</label>
                <input type="number" class="form-control" id="nb_places" name="nb_places">
            </div>
            <div class="col-md-6">
                <label for="prix" class="form-label">Prix<span class="red-star"> *</span> :</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="prix" name="prix" placeholder="€">
                    <span class="input-group-text">€</span>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="lien_billeterie" class="form-label">Lien vers la billetterie :</label>
                <input type="text" class="form-control" id="lien_billeterie" name="lien_billeterie" maxlength="75">
            </div>
            <div class="col-md-12">
                <label for="lien_event" class="form-label mt-3">Lien vers l'événement :</label>
                <input type="text" class="form-control" id="lien_event" name="lien_event" maxlength="75">
            </div>
        </div>
        <div class="my-5 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="/here_we_go/accueil" class="btn btn-secondary" tabindex="-1" role="button">Retour</a>
        </div>
    </form>
</div>