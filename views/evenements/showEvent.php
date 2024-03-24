<div class="container">
    <div class="photo-event-div"><img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" alt="" class="photo-event-fiche"/></div>
    <?php setlocale(LC_TIME, 'fr_FR.utf8', 'fra');?>
    <h1 class="h1-Autres "><?php echo $event->titre; ?></h1>
    <div class="row">
        <div class="col-sm-8 col-12">
            <p class="heure-date mt-2 d-flex align-items-center">
                <span><?php echo utf8_encode(strftime('%A %d %B %Y', strtotime($event->date_event))).date(' - H:i', strtotime($event->heure_event))." - ".ucfirst($event->ville); ?></span>
            </p>
        </div>
        <div class="col-sm-4 col-12 text-center">
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
        </div>
    </div>
    <div class="my-3">
        <button id="btn-audio">Ecouté l'Audio de la description</button>
        <div id="text-to-audio"></div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="block" style="border-bottom: 2px solid black;">
                <p id="texte-long" class="my-5 fs-3 event-description">
                    <?php echo $event->description_longue; ?>
                </p>
            </div>
        </div>
    <div class="col-md-12">
    <div class="block my-5 fs-3">
        <h3 class="heure-date">Détails</h3>
        <div class="row">
            <div class="col-md-6 mb-5">
                <div>
                    <span class="text-info mb-2">Adresse : </span>
                    <span><?php echo $event->adresse; ?></span>
                </div>
                <div>
                    <span class="text-info mb-2">Places : </span>
                    <span><?php echo $event->nb_places; ?></span>
                </div>
                <div>
                    <span class="text-info mb-2">Prix : </span>
                    <span><?php echo $event->prix; ?> €</span>
                </div>
            </div>
            <div class="col-md-6">
    <div>
        <a href="<?php echo $event->lien_billeterie; ?>" class="text-info mb-2 mt-3">La billetterie</a>
    </div>
    <div>
        <a href="<?php echo $event->lien_event; ?>" class="text-info mb-2">Le site de l'événement</a>
    </div>
    </div>
<div class="container">
    <div id="map"></div>
<!-- JS pour la map -->
    <script>
        const ville = '<?php echo $event->ville;?>';
        const url = `https://api-adresse.data.gouv.fr/search/?q=${ville}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.features.length > 0) {
                    const longitude = data.features[0].geometry.coordinates[0];
                    const latitude = data.features[0].geometry.coordinates[1];

                    var map = L.map('map').setView([latitude, longitude], 9);

                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 13,
                        minZoom: 6,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    var marker = L.marker([latitude, longitude]).addTo(map);
                } else {
                    console.log('Ville introuvable.');
                }
            })
            .catch(error => console.error('Erreur lors de la récupération des données :', error));
    </script>
</div>
<!-- Fin JS -->
    <?php if (isset($_SESSION["login"])) { ?>
        <h3 class="heure-date">Covoiturage</h3>
    <table class="table mb-5 mt-5">
        <thead>
        <tr class="text-center">
        <th>Nombre places</th>
        <th>Prix (€)</th>
        <th>Ville départ</th>
        <th>Heure départ</th>
        <th class='none-conducteur'>Conducteur</th>
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
            <tr class='text-center'>
                <td>" . $covoit->getNbPlace() . "</td>
                <td>" . $covoit->getMontantParPers() . "</td>
                <td>" . $covoit->getLieuDepart() . "</td>
                <td>" . date("H\hi", strtotime($covoit->getHeureDepart())). "</td>
                <td class='none-conducteur'>" . $covoit->prenom_conducteur . "</td>
                <td><a href='?controller=covoiturages&action=showCovoiturage&id_covoiturage=" . $covoit->getIdCovoiturage() . "&id_event=".$event->id_event."' class='btn btn-primary'>Voir</a></td>
            </tr>
        ";}?>
        </tbody>
    </table>
    <?php } ?>
    <a href="?controller=pages&action=home" class="btn btn-primary">Retour</a>
</div>