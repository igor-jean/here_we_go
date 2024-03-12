<div class="container">
    <div class="photo-event-div"><img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" alt="" class="photo-event-fiche"/></div>
    <?php setlocale(LC_TIME, 'fr_FR.utf8', 'fra');?>
    <div class="row">
        <div class="col-8">
            <p class="date-heure-event"><span><?php echo strftime('%A %d %B %Y', strtotime($event->date_event)); ?></span> - <span><?php echo date('H:i', strtotime($event->heure_event)); ?></span> - <span><?php echo ucfirst($event->ville); ?></span></p>
            <h2 class="h2-line-height"><?php echo $event->titre; ?></h2>            
        </div>
        <div class="col-4 position-relative ">
            <?php
            if (isset($_SESSION["login"])) {
                if ($checkIfOnlyOne) {
                    echo '<a href="?controller=covoiturages&action=confirmationSuppression&id_event=' . $event->id_event . '&id_covoiturage=' . $id_covoit . '" class="btn btn-primary position-absolute right-O">Se désinscrire</a>';
                } elseif ($result) {
                    echo '<a href="?controller=evenements&action=desinscriptionEvent&id_event=' . $event->id_event . '" class="btn btn-primary position-absolute right-O">Se désinscrire</a>';
                } else {
                    echo '<a href="?controller=evenements&action=inscriptionEvent&id_event=' . $event->id_event . '" class="btn btn-primar position-absolute right-O">S\'inscrire</a>';
                }
            }
            ?>
        </div>
    </div>
    <h3>Description:</h3>
    <div class="my-3">
        <button id="btn-audio">Ecouté l'Audio de la description</button>
        <div id="text-to-audio"></div>
    </div>

    <p id="texte-long" class="my-5 fs-3 "><?php echo $event->description_longue; ?></p>
    <div>
        <span>Adresse</span>
        <span><?php echo $event->adresse; ?></span>
    </div>
    <div>
        <span>Places</span>
        <span><?php echo $event->nb_places; ?></span>
    </div>
    <div>
        <span>Prix</span>
        <span><?php echo $event->prix; ?></span>
    </div>
    <div>
        <span>Lien de la billetterie</span>
        <span><?php echo $event->lien_billeterie; ?></span>
    </div>
    <div>
        <span>Lien de l'événement</span>
        <span><?php echo $event->lien_event; ?></span>
    </div>
    
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
                <td><a href='?controller=covoiturages&action=showCovoiturage&id_covoiturage=" . $covoit->getIdCovoiturage() . "&id_event=".$event->id_event."' class='btn btn-primary'>Voir plus</a></td>
            </tr>
        ";}?>
        </tbody>
    </table>
    <?php } ?>
    <a href="?controller=pages&action=home" class="btn btn-primary">Retour</a>
</div>