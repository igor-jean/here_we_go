<div class="container">

    <h1 class="h1-Autres"><?php echo $event->titre; ?></h1>
    <h3 class="heure-date ml-5">
        <span><?php echo date('d/m/Y', strtotime($event->date_event)); ?></span> - <span><?php echo date('H:i', strtotime($event->heure_event)); ?></span> - <span><?php echo $event->ville; ?></span></p>
    </h3>
    <figure>
        <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" alt="" />
    </figure>

    <h3>Description:</h3>
    <div>
        <button class="mb-3" id="btn-audio">Audio</button>
        <div id="text-to-audio">
        </div>
    </div>
    <div class="row">
    <div class="col">
    <p id="texte-long" class="text-description"><?php echo $event->description_longue; ?></p>
    </div>
    <div class="col">
    <div class="description-detail">
    <div>
        <span class="info-evenenment">Adresse</span>
        <span><?php echo $event->adresse; ?></span>
    </div>
    <div>
        <span class="info-evenenment">Places</span>
        <span><?php echo $event->nb_places; ?></span>
    </div>
    <div>
        <span class="info-evenenment">Prix</span>
        <span><?php echo $event->prix; ?>€</span>
    </div>
    <div>
        <span class="info-evenenment">Lien de la billetterie</span>
        <span><?php echo $event->lien_billeterie; ?></span>
    </div>
    <div>
        <span class="info-evenenment">Lien de l'événement</span>
        <span><?php echo $event->lien_event; ?></span>
    </div>
    </div>
    </div>
    </div>
<p class="s-5" >
        <?php
        if (isset($_SESSION["login"])) {
            if ($checkIfOnlyOne) {
                echo '<a href="?controller=covoiturages&action=confirmationSuppression&id_event=' . $event->id_event . '&id_covoiturage=' . $id_covoit . '" class="btn btn-primary">Se désinscrire</a>';
            } elseif ($result) {
                echo '<a href="?controller=evenements&action=desinscriptionEvent&id_event=' . $event->id_event . '" class="btn btn-primary">Se désinscrire</a>';
            } else {
                echo '<a href="?controller=evenements&action=inscriptionEvent&id_event=' . $event->id_event . '" class="btn btn-primary">S\'inscrire</a>';
            }
        }
        ?>
    </p>

    <?php if (isset($_SESSION["login"])) { ?>
        <h3>Covoiturage</h3>

        <table class="table">
            <thead>
            <tr>
                <th>Nombre de places</th>
                <th>Prix (€)</th>
                <th>Ville de départ</th>
                <th>Heure de départ</th>
                <th>Conducteur</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (!$vehicule) {
                echo '<a href="?controller=utilisateurs&action=ajouterVehicule" class="btn btn-primary">Proposer son covoiturage</a>';
            } elseif ($result && !$checkIfOnlyOne) {
                echo '<a href="?controller=covoiturages&action=createCovoiturage&id_event=' . $event->id_event . '" class="btn btn-primary">Proposer son covoiturage</a>';
            }

            foreach ($covoits as $covoit) {
                echo "
                <tr>
                    <td>" . $covoit->getNbPlace() . "</td>
                    <td>" . $covoit->getMontantParPers() . "</td>
                    <td>" . $covoit->getLieuDepart() . "</td>
                    <td>" . $covoit->getHeureDepart() . "</td>
                    <td>" . $covoit->prenom_conducteur . "</td>
                    <td><a href='?controller=covoiturages&action=showCovoiturage&id_covoiturage=" . $covoit->getIdCovoiturage() . "' class='btn btn-primary'>Voir plus</a></td>
                </tr>
            ";
            }

            ?>
            </tbody>
        </table>
    <?php } ?>
    <a href="?controller=pages&action=home" class="btn btn-primary">Retour</a>
        </div>