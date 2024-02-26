<h1><?php echo $event->titre ;?></h1>
<p><span><?php echo date('d/m/Y',strtotime($event->date_event));?></span> - <span><?php echo date('H:i',strtotime($event->heure_event));?></span> - <span><?php echo $event->ville;?></span></p>
<p>
    <?php
        if ($result) {
            echo '<a href="?controller=evenements&action=desinscriptionEvent&id_event='.$event->id_event.'">Se desinscrire</a>';
        } else {
            echo '<a href="?controller=evenements&action=inscriptionEvent&id_event='.$event->id_event.'">S\'inscrire</a>';
        }
    ?>
</p>
<h3>Description:</h3>
<p><?php echo $event->description_longue;?></p>
<div>
    <span>Adresse</span>
    <span><?php echo $event->adresse;?></span>
</div>
<div>
    <span>Places</span>
    <span><?php echo $event->nb_places;?></span>
</div>
<div>
    <span>Prix</span>
    <span><?php echo $event->prix;?></span>
</div>
<div>
    <span>lien de la billeterie</span>
    <span><?php echo $event->lien_billeterie;?></span>
</div>
<div>
    <span>lien de l'événement</span>
    <span><?php echo $event->lien_event;?></span>
</div>

<h3>Covoiturage</h3>

<table>
    <thead>
        <tr>
            <th>Nombre de place</th>
            <th>Prix (€)</th>
            <th>Ville de depart</th>
            <th>Heure de depart</th>
            <th>Conducteur</th>
            <th>Actions</th>
        </tr>
  </thead>
  <tbody>
    <a href="?controller=covoiturages&action=createCovoiturage&id_event=<?php echo $event->id_event;?>">Proposer son covoiturage</a>
    <?php
        foreach ($covoits as $covoit) {
            echo "
                <tr>
                    <td>".$covoit->getNbPlace()."</td>
                    <td>".$covoit->getMontantParPers()."</td>
                    <td>".$covoit->getLieuDepart()."</td>
                    <td>".$covoit->getHeureDepart()."</td>
                    <td>".$covoit->prenom_conducteur."</td>
                    <td><a href='?controller=covoiturages&action=showCovoiturage&id_covoiturage=".$covoit->getIdCovoiturage()."'>Voir plus</a></td>
                </tr>
            ";
        }
        
        ?>
  </tbody>
</table>

<a href="?controller=pages&action=home">Retour</a>
