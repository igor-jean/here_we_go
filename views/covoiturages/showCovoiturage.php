<div class="container">
    <div class="row">
        <h1 class="mt-5">Covoiturage</h1>
        <div class="col-md-8"> <!-- Colonne pour le texte -->
            <p>Trajet proposé par <?php echo $conducteur;?></p>
            <ul>
                <li>Places disponibles :  <?php echo $covoit->getNbPlace();?></li>
                <li>Prix par personne : <?php echo $covoit->getMontantParPers();?></li>
                <li>Adresse de départ : <?php echo $covoit->getLieuDepart();?></li>
                <li>Heure de départ : <?php echo $covoit->getHeureDepart();?></li>
            </ul>
            <p>Information de contact : <?php echo $covoit->getInformationDeContact();?></p>
            <p>Description : <?php echo $covoit->getDescriptif();?></p>
            <p>Véhicule du capitaine : <?php echo $vehicule->getLibelle_vehicule();?></p>

            <a class="btn btn-primary mb-5" href="?controller=evenements&action=showEvent&id_event=<?php echo $covoit->getIdEvent();?>">Retour</a>
            <?php if($inscrit) {
                echo '<a href="?controller=covoiturages&action=desinscriptionCovoiturage&id_covoiturage='.$covoit->getIdCovoiturage().'">Annuler la réservation</a>';
            } elseif(!$verif) {
                echo '<a href="?controller=covoiturages&action=inscriptionCovoiturage&id_covoiturage='.$covoit->getIdCovoiturage().'">Réserver</a>';
            }
            ?>
        </div>
        <div class="col-md-4"> <!-- Colonne pour l'image -->
            <img src="assets\img\carpool-5508006_1280.png">
        </div>
    </div>
</div>
