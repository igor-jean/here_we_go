<div class="container">
<h1 class=mt-5>Covoiturage</h1>

<p>Trajet proposé par <?php echo $conducteur;?></p>
<ul>
    <li>Places disponnibles :<?php echo $covoit->getNbPlace();?></li>
    <li>Prix par personnes: <?php echo $covoit->getMontantParPers();?></li>
    <li>Adresse de depart : <?php echo $covoit->getLieuDepart();?></li>
    <li>Heure de depart :<?php echo $covoit->getHeureDepart();?></li>
</ul>
<p>information de contact :<?php echo $covoit->getInformationDeContact();?></p>
<p>description :<?php echo $covoit->getDescriptif();?></p>
<p>Vehicule du capitaine : <?php echo $vehicule->getLibelle_vehicule();?></p>


<a class= "btn btn-primary mb-5" href="?controller=evenements&action=showEvent&id_event=<?php echo $covoit->getIdEvent();?>">Retour</a>
<?php if($inscrit) {
    echo '<a href="?controller=covoiturages&action=desinscriptionCovoiturage&id_covoiturage='.$covoit->getIdCovoiturage().'">Annuler la reservation</a>';
}elseif(!$verif) {
    echo '<a href="?controller=covoiturages&action=inscriptionCovoiturage&id_covoiturage='.$covoit->getIdCovoiturage().'">Reserver</a>';
}
?>
<img src="assets\img\carpool-5508006_1280.png"></a>
</div>
