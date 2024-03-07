<div class="container">
    <h1>CREER EVENEMENT</h1>
    
    <?php
    // Vérification de la présence d'une erreur dans l'URL
    if(isset($_GET['error'])) {
        $errorMessage = urldecode($_GET['error']);
        // Affichage de l'erreur dans votre vue
        echo '<div class="error-message">' . $errorMessage . '</div>';
    }
    ?>
    <form action="?controller=evenements&action=add" method="post">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre de l'événement :</label>
                <input type="text" class="form-control" id="titre" name="titre">
            </div>
            <div class="mb-3">
                <label for="date_event" class="form-label">Date de l'événement :</label>
                <input type="date" class="form-control" id="date_event" name="date_event">
            </div>
            <div class="mb-3">
                <label for="heure_event" class="form-label">Heure de l'événement :</label>
                <input type="time" class="form-control" id="heure_event" name="heure_event">
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville :</label>
                <input type="text" class="form-control" id="ville" name="ville">
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse :</label>
                <input type="text" class="form-control" id="adresse" name="adresse">
            </div>
            <div class="mb-3">
                <label for="code_postal" class="form-label">Code Postal :</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal">
            </div>
            <div class="mb-3">
                <label for="description_courte" class="form-label">Description courte :</label>
                <textarea class="form-control" id="description_courte" name="description_courte"></textarea>
            </div>
            <div class="mb-3">
                <label for="description_longue" class="form-label">Description longue :</label>
                <textarea class="form-control" id="description_longue" name="description_longue"></textarea>
            </div>
            <div class="mb-3">
                <label for="nb_places" class="form-label">Nombre de places :</label>
                <input type="number" class="form-control" id="nb_places" name="nb_places">
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix :</label>
                <input type="text" class="form-control" id="prix" name="prix">
            </div>
            <div class="mb-3">
                <label for="lien_billeterie" class="form-label">Lien vers la billetterie :</label>
                <input type="text" class="form-control" id="lien_billeterie" name="lien_billeterie">
            </div>
            <div class="mb-3">
                <label for="lien_event" class="form-label">Lien vers l'événement :</label>
                <input type="text" class="form-control" id="lien_event" name="lien_event">
            </div>
            <div class="mb-3">
                <label for="nom_structure" class="form-label">Nom de la structure :</label>
                <input type="text" class="form-control" id="nom_structure" name="nom_structure">
            </div>
            <div class="mb-3">
                <label for="id_categorie" class="form-label">Choisir une categorie :</label>
                <select name="id_categorie" id="id_categorie" class="form-select mb-3">
                    <?php foreach ($categories as $categorie) {
                        echo "<option value=".$categorie->getIdCategorie().">".$categorie->getLibelleCategorie()."</option>";
                    } ?>
                </select>
            </div>
            <div class="mt-5">
                <a href="?controller=pages&action=home" class="btn btn-danger" tabindex="-1" role="button">Retour</a>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
</div>
