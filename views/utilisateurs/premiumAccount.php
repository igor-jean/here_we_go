<div class="bg-color ">
    <div class="container">
        <h1>Liste des événements dans un rayon de 200km autour de <?php echo $villeUtilisateur["ville"];?></h1>
    </div>
</div>
<div class="container">
        <h2 class=text-center>Les événements  autour de <?php echo $villeUtilisateur["ville"];?></h2>
    </div>

    <p class="text-center mt-5 mb-5">Pour vous remercier d'avoir créé plusieurs événements,<br> vous pouvez voir les événements qui se situent à 50 km autour de vous.</p>
<div class="container">
   
    <div id="mapAccueil"></div>
    <?php 

    $listeVilles = [];
    foreach ($events as $event) {
        $titre = htmlspecialchars($event->titre, ENT_QUOTES, 'UTF-8');
        $villes = htmlspecialchars($event->ville, ENT_QUOTES, 'UTF-8');
        $listeVilles[] = '{"ville": "'.$villes.'", "id_event": "'.$event->id_event.'", "titre": "'.$titre.'"}';
    }
    $listeVillesJSON = '[' . implode(',', $listeVilles) . ']';
    ?>


    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script>
    let longitudeUser;
    let latitudeUser;

    const userVille = "<?php echo $villeUtilisateur['ville']; ?>";
    const urlApiUser = `https://api-adresse.data.gouv.fr/search/?q=${userVille}`;

    async function fetchUserCoords() {
        try {
            const response = await fetch(urlApiUser);
            const data = await response.json();
            if (data.features.length > 0) {
                longitudeUser = data.features[0].geometry.coordinates[0];
                latitudeUser = data.features[0].geometry.coordinates[1];
            } else {
                console.log('Ville introuvable.');
            }
        } catch (error) {
            console.error('Erreur lors de la récupération des données :', error);
        }
    }

    async function initMap() {
        await fetchUserCoords();

        console.log(`Ville: ${userVille}, Longitude: ${longitudeUser}, Latitude: ${latitudeUser}`);

        const map = L.map('mapAccueil').setView([latitudeUser, longitudeUser], 9);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 13,
            minZoom: 6,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const evenements = <?php echo $listeVillesJSON; ?>;

        evenements.forEach(async event => {
            const urlApiEvent = `https://api-adresse.data.gouv.fr/search/?q=${event.ville}`;
            try {
                const response = await fetch(urlApiEvent);
                const data = await response.json();
                if (data.features.length > 0) {
                    const longitudeEvent = data.features[0].geometry.coordinates[0];
                    const latitudeEvent = data.features[0].geometry.coordinates[1];

                    const distance = calculateDistance(latitudeUser, longitudeUser, latitudeEvent, longitudeEvent);
                    if (distance <= 200000) { 
                        let marker = L.marker([latitudeEvent, longitudeEvent]).addTo(map);

                        let popupContent = `<a href="fiche_evenement/${event.id_event}">${event.titre}</a>`;

                        marker.bindPopup(popupContent);
                        marker.on('click', function() {
                            marker.openPopup();
                        });
                    }
                } else {
                    console.log('Coordonnées introuvables pour', event.ville);
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des données :', error);
            }
        });
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3; // Rayon de la Terre en mètres
        const φ1 = lat1 * Math.PI / 180;
        const φ2 = lat2 * Math.PI / 180;
        const Δφ = (lat2 - lat1) * Math.PI / 180;
        const Δλ = (lon2 - lon1) * Math.PI / 180;

        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                  Math.cos(φ1) * Math.cos(φ2) *
                  Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const distance = R * c; // Distance en mètres

        return distance;
    }

    initMap();
</script>




    <!-- Fin JS -->
</div>
    </section>
</div>