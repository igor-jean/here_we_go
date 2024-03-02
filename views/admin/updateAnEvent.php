<h1>MODIFIER ÉVÉNEMENT</h1>

<form action="?controller=admin&action=update" method="post">
    <input type="hidden" name="id_event" value="<?php echo $event->getIdEvent(); ?>">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre de l'événement:</label>
        <input value="<?php echo $event->getTitre(); ?>" type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="mb-3">
        <label for="date_event" class="form-label">Date de l'événement:</label>
        <input value="<?php echo $event->getDateEvent(); ?>" type="date" class="form-control" id="date_event" name="date_event">
    </div>
    <!-- Ajoutez les autres champs ici avec la même structure -->
    <div class="mb-3">
        <label for="id_categorie">Categorie:</label>
        <select name="id_categorie" id="id_categorie" class="form-select mb-3">
            <?php foreach ($categories as $categorie) { ?>
                <?php if ($categorie->getIdCategorie() === $categorieFinded->getIdCategorie()) { ?>
                    <option value="<?php echo $categorie->getIdCategorie(); ?>" selected><?php echo $categorie->getLibelleCategorie(); ?></option>
                <?php } else { ?>
                    <option value="<?php echo $categorie->getIdCategorie(); ?>"><?php echo $categorie->getLibelleCategorie(); ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
    <button type="button" class="btn btn-danger"><a href="?controller=admin&action=confirmerSuppression&id_event=<?php echo $event->getIdEvent(); ?>" class="text-white">Supprimer</a></button>
</form>

<h2>Covoiturage</h2>
<table class="table">
    <thead>
        <tr>
            <th>Montant par personne</th>
            <th>Information de contact</th>
            <th>Lieu de départ</th>
            <th>Nombre de places</th>
            <th>Heure de départ</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($covoits as $covoit) { ?>
            <tr>
                <td><?php echo $covoit->getMontantParPers(); ?></td>
                <td><?php echo $covoit->getInformationDeContact(); ?></td>
                <td><?php echo $covoit->getLieuDepart(); ?></td>
                <td><?php echo $covoit->getNbPlace(); ?></td>
                <td><?php echo $covoit->getHeureDepart(); ?></td>
                <td><a href="?controller=covoiturages&action=supprimerCovoitPerAdmin&id_event=<?php echo $covoit->getIdEvent(); ?>&id_covoiturage=<?php echo $covoit->getIdCovoiturage(); ?>" class="btn btn-danger">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="?controller=admin&action=evenementsAdministration" class="btn btn-primary">Retour</a>