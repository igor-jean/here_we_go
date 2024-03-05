
<h2>infos persos</h2>

<ul>
    <li><img src="imgUploaded/<?php echo $user->getAvatar();?>" alt="" style="width: 100px;"></li>
    <li>Mail : <?php echo $user->getMail();?></li>
    <li>Ville : <?php echo $user->getVille();?></li>
    <li>Nom : <?php echo $user->getNom();?></li>
    <li>Prenom : <?php echo $user->getPrenom();?></li>
    <li><a href="?controller=utilisateurs&action=modifierInfosPerso">Modifier mes infos perso</a></li>
</ul>



<h2>Mes vehicules :</h2>

<table>
    <thead>
        <tr>
            <th>Vehicule</th>
            <th>Immatriculation</th>
            <th>places</th>
            <th>Type de vehicule</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vehicules as $vehicule) {
            echo "
               <tr>
                    <td>".$vehicule->getLibelle_vehicule()."</td>
                    <td>".$vehicule->getImmatriculation()."</td>
                    <td>".$vehicule->getNb_places()."</td>
                    <td>".Vehicule::findTypeVehicule($vehicule->getId_vehicule())."</td>
                    <td><a href='?controller=utilisateurs&action=voirVehicule&id_vehicule_utilisateur=".$vehicule->getId_vehicule_utilisateur()."'>Modifier</a></td>
                </tr> 
            ";
        }
        ?>
        
    </tbody>
    <tfoot>
        <tr>
            <td>
                <a href="?controller=utilisateurs&action=ajouterVehicule">Ajouter un vehicule</a>
            </td>
        </tr>
    </tfoot>
</table>


<h2>Liste des evenements créé et qui ne sont pas encore passé :</h2>
<a href="?controller=utilisateurs&action=telechargerTousCSV" >Telecharger le CSV de tous les Evenements créé</a>
<section class="articles mt-5 mb-5">
    <?php foreach ($eventsUpcoming as $event) { ?>
    <article style="border: 7px solid <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>">
        <div class="article-wrapper">
            <figure>
                <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" alt="" />
            </figure>
            <ul>
                <div class="article-body">
                    <li><h3><?php echo $event->getTitre(); ?></h3></li>
                    <li><?php echo date('d/m/Y', strtotime($event->getDateEvent()))." - ".date('H:i', strtotime($event->getHeureEvent())); ?></li>
                    <li><?php echo $event->getVille()." (".substr($event->getCodePostal(), 0, 2).")"; ?></li>
                    <li>Prix : <?php echo $event->getPrix(); ?> €</li>
                    <li><?php echo $event->getDescriptionCourte(); ?></li>
                    <a href="?controller=utilisateurs&action=voirEvent&id_event=<?php echo $event->getIdEvent();?>" class="read-more">
                        Modifier <span class="sr-only">about this is some title</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </ul>
        </div>
    </article>
    <?php } ?>
</section>





<h2>Liste des evenements créé et qui se sont deja passé:</h2>


<section class="articles mt-5 mb-5">
    <?php foreach ($events as $event) { ?>
    <article style="border: 7px solid <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>">
        <div class="article-wrapper">
            <figure>
                <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"];; ?>" alt="" />
            </figure>
            <ul>
                <div class="article-body">
                    <li><h3><?php echo $event->getTitre(); ?></h3></li>
                    <li><?php echo date('d/m/Y', strtotime($event->getDateEvent()))." - ".date('H:i', strtotime($event->getHeureEvent())); ?></li>
                    <li><?php echo $event->getVille()." (".substr($event->getCodePostal(), 0, 2).")"; ?></li>
                    <li>Prix : <?php echo $event->getPrix(); ?> €</li>
                    <li><?php echo $event->getDescriptionCourte(); ?></li>
                </div>
            </ul>
        </div>
    </article>
    <?php } ?>
</section>




<h2>Liste des Evenements auxquel je suis inscrit </h2>


<section class="articles mt-5 mb-5">
    <?php foreach ($listEventsRegistered as $event) { ?>
    <article style="border: 7px solid <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>">
        <div class="article-wrapper">
            <figure>
                <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"];; ?>" alt="" />
            </figure>
            <ul>
                <div class="article-body">
                    <li><h3><?php echo $event->getTitre(); ?></h3></li>
                    <li><?php echo date('d/m/Y', strtotime($event->getDateEvent()))." - ".date('H:i', strtotime($event->getHeureEvent())); ?></li>
                    <li><?php echo $event->getVille()." (".substr($event->getCodePostal(), 0, 2).")"; ?></li>
                    <li>Prix : <?php echo $event->getPrix(); ?> €</li>
                    <li><?php echo $event->getDescriptionCourte(); ?></li>
                    <a href="?controller=evenements&action=showEvent&id_event=<?php echo $event->getIdEvent();?>" class="read-more">
                        Voir <span class="sr-only">about this is some title</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </ul>
        </div>
    </article>
    <?php } ?>
</section>


<h2>Covoiturage que je propose :</h2>
<table>
    <tr>
        <th>Evenenement</th>
        <th>Date</th>
        <th>Heure de depart</th>
        <th>Lieu de depart</th>
        <th>Action</th>
    </tr>
    <?php foreach ($covoits as $covoit) { ?>
    <tr>
        <td><?php echo Evenement::find($covoit->getIdEvent())->getTitre(); ?></td>
        <td><?php echo Evenement::find($covoit->getIdEvent())->getDateEvent(); ?></td>
        <td><?php echo $covoit->getHeureDepart(); ?></td>
        <td><?php echo $covoit->getLieuDepart(); ?></td>
        <td><a href="?controller=covoiturages&action=modifCovoiturage&id_covoiturage=<?php echo $covoit->getIdCovoiturage(); ?>">Voir</a></td>
    </tr>
    <?php } ?>
</table>

<h2>Covoiturage auxquels je suis inscrit :</h2>
<table>
    <tr>
        <th>Evenenement</th>
        <th>Date</th>
        <th>Heure de depart</th>
        <th>Lieu de depart</th>
        <th>Action</th>
    </tr>
    <?php foreach ($covoitsInscrit as $covoit) { ?>
    <tr>
        <td><?php echo Evenement::find($covoit->getIdEvent())->getTitre(); ?></td>
        <td><?php echo Evenement::find($covoit->getIdEvent())->getDateEvent(); ?></td>
        <td><?php echo $covoit->getHeureDepart(); ?></td>
        <td><?php echo $covoit->getLieuDepart(); ?></td>
        <td><a href="?controller=covoiturages&action=showCovoiturage&id_covoiturage=<?php echo $covoit->getIdCovoiturage(); ?>">Voir</a></td>
    </tr>
    <?php } ?>
</table>
