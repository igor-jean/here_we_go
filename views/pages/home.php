<?php
if(isset($_GET['errorMessage'])) {
    $errorMessage = urldecode($_GET['errorMessage']);
    echo '<div class="error-message">' . $errorMessage . '</div>';
}elseif(isset($_GET['error'])) {
    $error = urldecode($_GET['error']);
    echo '<div class="error-message">' . $error . '</div>';
}
?>
<div class="background-index "></div>
    <div class="bg-color ">
        <div class="container">
            <h1>Liste des événements</h1>
        </div>
    </div>


<div class="container">
    <section class="my-5">
        <div class="row g-3">
            <?php foreach ($events as $event) {?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card position-relative h-100" style="width: 20rem;">
                        <a href="/here_we_go/fiche_evenement/<?php echo $event->id_event;?>">
                            <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <p class="mb-0"><?php echo date('d/m/Y', strtotime($event->date_event))." - ".date('H:i', strtotime($event->heure_event)); ?></p>
                            <h5 class="card-title" style="color : <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>;"><?php echo $event->titre; ?></h5>
                            <p class="card-text"><?php echo $event->description_courte; ?></p>
                        </div>
                        <div class="d-flex" style="color : white; background: <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>; width : 100%; height : 70px">
                            <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                                <span><?php echo $event->prix; ?> <i class="fa-solid fa-euro-sign"></i></span>
                            </div>
                            <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                                <span><?php echo $event->ville." (".substr($event->code_postal, 0, 2).")"; ?></span>
                                <span><i class="fa-solid fa-location-dot"></i></span>
                            </div>
                            <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                                <span><?php echo Covoiturage::getCovoituragesCountByEventId($event->id_event);?></span>
                                <span><i class="fa-solid fa-car"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
    </section>
    <section>
    <div id="mapAccueil"></div>
    <!-- JS pour la map -->
    <?php 
$listeVilles = [];
foreach ($events as $event) {
    $listeVilles[] = '{"ville": "'.$event->ville.'"}';
}
// Convertir le tableau en chaîne JSON avec virgules entre chaque élément
$listeVillesJSON = '[' . implode(',', $listeVilles) . ']';
?>


    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
     <script>
        const evenements = <?php echo $listeVillesJSON; ?>;

        const map = L.map('mapAccueil').setView([46.603354, 1.888334], 6);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 13,
            minZoom: 6,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        evenements.forEach(event => {
            const url = `https://api-adresse.data.gouv.fr/search/?q=${event.ville}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.features.length > 0) {
                        let longitude = data.features[0].geometry.coordinates[0];
                        let latitude = data.features[0].geometry.coordinates[1];

                        let marker = L.marker([latitude, longitude]).addTo(map);
                        const nbEvenements = evenements.filter(e => e.ville === event.ville).length;

                        marker.bindPopup(`<b>${event.ville}</b><br>Nombre d'événements : ${nbEvenements}`).openPopup();

                    } else {
                        console.log('Ville introuvable.');
                    }
                })
                .catch(error => console.error('Erreur lors de la récupération des données :', error));
        });
    </script>

    <!-- Fin JS -->
</div>
    </section>
</div>