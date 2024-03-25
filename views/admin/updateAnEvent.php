<div class="container">
    <h1>MODIFIER EVENEMENT</h1>
    <?php if(isset($_GET['error'])) {
        $errorMessage = urldecode($_GET['error']);
        echo '<div class="error-message">' . $errorMessage . '</div>';
    }
    ?>
    <div class="text-center ">
        <a class="btn btn-secondary" href="evenement/ajout_photo/<?php echo $event->getIdEvent(); ?>" role="button" >Ajouter/Modifier une photo d'Evenement</a>
    </div>
    <form action="/here_we_go/modifier_evenement" method="post">
        <input type="hidden" name="id_event" value="<?php echo $event->getIdEvent() ;?>">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'événement<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getTitre();?>" type="text" id="titre" name="titre" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="date_event" class="form-label">Date de l'événement<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getDateEvent();?>" type="date" id="date_event" name="date_event" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="heure_event" class="form-label">Heure de l'événement<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getHeureEvent();?>" type="time" id="heure_event" name="heure_event" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getVille();?>" type="text" id="ville" name="ville" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getAdresse();?>" type="text" id="adresse" name="adresse" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="code_postal" class="form-label">Code Postal<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getCodePostal();?>" type="text" id="code_postal" name="code_postal" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="description_courte" class="form-label">Description courte:</label>
            <textarea id="description_courte" rows="7" name="description_courte"><?php echo $event->getDescriptionCourte();?></textarea><br>
        </div>
        <div class="mb-3">
            <label for="description_longue" class="form-label">Description longue<span class="red-star"> *</span>:</label>
            <textarea id="description_longue" rows="12" name="description_longue"><?php echo $event->getDescriptionLongue();?></textarea><br>
        </div>
        <div class="mb-3">
            <label for="nb_places" class="form-label">Nombre de places<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getNbPlaces();?>" type="number" id="nb_places" name="nb_places" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getPrix();?>" type="text" id="prix" name="prix" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="lien_billeterie" class="form-label">Lien vers la billetterie:</label>
            <input value="<?php echo $event->getLienBilleterie();?>" type="text" id="lien_billeterie" name="lien_billeterie" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="lien_event" class="form-label">Lien vers l'événement:</label>
            <input value="<?php echo $event->getLienEvent();?>" type="text" id="lien_event" name="lien_event" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="nom_structure" class="form-label">Nom de la structure<span class="red-star"> *</span>:</label>
            <input value="<?php echo $event->getTitre();?>" type="text" id="nom_structure" name="nom_structure" class="form-control"><br>
        </div>
        <div class="mb-3">
            <label for="id_categorie">Catégorie<span class="red-star"> *</span>:</label>
            <select class="form-select" name="id_categorie" id="id_categorie">
            <?php
            foreach ($categories as $categorie) {
            if ($categorie->getIdCategorie() === $categorieFinded->getIdCategorie()) {
                echo "<option value=\"" . $categorie->getIdCategorie() . "\" selected>" . $categorie->getLibelleCategorie() . "</option>";
            } else {
                echo "<option value=\"" . $categorie->getIdCategorie() . "\">" . $categorie->getLibelleCategorie() . "</option>";
            }
        }
        ?>
            </select>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <input type="submit" value="Modifier" class="btn btn-primary me-5">
                <a href="/here_we_go/supprimer_evenement/<?php echo $event->getIdEvent() ;?>" class="btn btn-danger btn-lg">Supprimer</a>
            </div>
            <a href="/here_we_go/gestion_du_site/evenements" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>
