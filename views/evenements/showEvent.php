<div class="container">
    <h1 class="h1-Autres"><?php echo $event->titre; ?></h1>
    <h3 class="heure-date ml-5">
        <span><?php echo date('d/m/Y', strtotime($event->date_event)); ?></span> - <span><?php echo date('H:i', strtotime($event->heure_event)); ?></span> - <span><?php echo $event->ville; ?></span></p>
    </h3>    
        <p>
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
        <figure>
          <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" alt="" />
        </figure>
        <h3>Description:</h3>
        <div>
            <button id="btn-audio">Audio</button>
            <div id="text-to-audio">
            </div>
        </div>
    
        <p id="texte-long"><?php echo $event->description_longue; ?></p>
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
  <!-- Ajout maps  -->
<!-- Div pour afficher la carte -->
<div id="map"></div>

<?php
$evenement = Evenement::find($id_event);
$ville_event = $evenement->ville; 

if ($result) {
    // Convertir le résultat en format JSON et le stocker dans une variable JavaScript
    echo "<script>var eventAddress = " . json_encode($ville_event) . ";</script>"; // Utilisez 'Ville' au lieu de 'address'
} else {
    // Gérer les erreurs
    echo "<script>console.error('Erreur lors de la récupération des données depuis la base de données.');</script>";
}

?>

<!-- Script JavaScript pour initialiser la carte et récupérer les coordonnées -->
<script type="text/javascript">
    var macarte = null;

    // Fonction d'initialisation de la carte avec des coordonnées dynamiques
    function initMap(latitude, longitude) {
        macarte = L.map('map').setView([latitude, longitude], 11);
        
        // Ajoute une couche de tuiles OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);

        // Ajoute un marqueur à la position des coordonnées récupérées
        var marker = L.marker([latitude, longitude]).addTo(macarte);
    }

    // Appelle la fonction d'initialisation lorsque le DOM est chargé
    window.onload = function(){
        // Utilise l'adresse de l'événement récupérée depuis PHP pour interroger l'API d'ADDOK et récupérer les coordonnées géographiques
        fetch('http://api-adresse.data.gouv.fr/search/', {
            method: 'GET',
            params: {
                q: eventAddress
            }
        })
        .then(response => response.json())
        .then(data => {
            // Récupère les coordonnées géographiques (latitude et longitude) depuis les données de l'API d'ADDOK
            var latitude = data.lat;
            var longitude = data.lon;

            // Initialise la carte avec les nouvelles coordonnées
            initMap(latitude, longitude);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des coordonnées géographiques:', error);
        });
    };
    
    <!-- fin maps -->

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
                ";
                }
    
                ?>
                </tbody>
            </table>
        <?php } ?>
    <a href="?controller=pages&action=home" class="btn btn-primary">Retour</a>
        </div>