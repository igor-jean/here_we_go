<div class="container">
    <div class="row">
        <h1 class="mt-5">Covoiturage</h1>
        <div class="col-md-8">
        <p>Trajet proposé par <span style="color:#69BACE;"><strong><?php echo $conducteur;?></strong></span></p>
            <ul>
                <li class="mb-3">Places disponibles : <span style="color:#69BACE;"><strong><?php echo $covoit->getNbPlace();?></strong></span></li>
                <li class="mb-3">Prix par personne : <span style="color:#69BACE;"><strong><?php echo $covoit->getMontantParPers();?> €</strong></span></li>
                <li class="mb-3">Adresse de départ : <span style="color:#69BACE;"><strong><?php echo $covoit->getLieuDepart();?></strong></span></li>
                <li class="mb-3">Heure de départ : <span style="color:#69BACE;"><strong><?php echo $covoit->getHeureDepart();?></strong></span></li>
            </ul>
            <p>Information de contact : <span style="color:#69BACE;"><strong><?php echo $covoit->getInformationDeContact();?></strong></span></p>
            <p>Description : <span style="color:#69BACE;"><strong><?php echo $covoit->getDescriptif();?></strong></span></p>
            <p class="mb-5">Véhicule du capitaine : <span style="color:#69BACE;"><strong><?php echo $vehicule->getLibelle_vehicule();?></strong></span></p>
            <a class="btn btn-primary mb-5 me-5" href="?controller=evenements&action=showEvent&id_event=<?php echo $covoit->getIdEvent();?>">Retour</a>
            <?php if($inscrit) {
                echo '<a class="ms-5 btn btn-primary mb-5" href="?controller=covoiturages&action=desinscriptionCovoiturage&id_covoiturage='.$covoit->getIdCovoiturage().'">Annuler la réservation</a>';
            } elseif(!$verif) {
                echo '<a class="ms-5 btn btn-primary mb-5" href="?controller=covoiturages&action=inscriptionCovoiturage&id_covoiturage='.$covoit->getIdCovoiturage().'">Réserver</a>';
            }
            ?>
        </div>
        <div class="col-md-4">
            <img src="assets\img\carpool-5508006_1280.png">
        </div>
    </div>
</div>
