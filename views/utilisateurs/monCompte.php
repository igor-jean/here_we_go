
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



<h2>Liste des evenements créé et qui se sont deja passé:</h2>

<ul>
    <?php foreach ($events as $event) { ?>
        <li>Titre: <?php echo $event->getTitre(); ?></li>
        <li>Date: <?php echo $event->getDateEvent(); ?></li>
        <li>Heure: <?php echo $event->getHeureEvent(); ?></li>
        <li>Ville: <?php echo $event->getVille(); ?></li>
        <li>Adresse: <?php echo $event->getAdresse(); ?></li>
        <li>Code Postal: <?php echo $event->getCodePostal(); ?></li>
        <li>Description Courte: <?php echo $event->getDescriptionCourte(); ?></li>
        <li>Description Longue: <?php echo $event->getDescriptionLongue(); ?></li>
        <li>Nombre de Places: <?php echo $event->getNbPlaces(); ?></li>
        <li>Prix: <?php echo $event->getPrix(); ?></li>
        <li>Lien Billeterie: <?php echo $event->getLienBilleterie(); ?></li>
        <li>Lien Event: <?php echo $event->getLienEvent(); ?></li>
        <li>Nom Structure: <?php echo $event->getNomStructure(); ?></li>
        <br>
        <br>
    <?php } ?>
</ul>

<h2>Liste des evenements créé et qui ne sont pas encore passé :</h2>
<ul>
    <?php foreach ($eventsUpcoming as $event) { ?>
        <li>Titre: <?php echo $event->getTitre(); ?></li>
        <li>Date: <?php echo $event->getDateEvent(); ?></li>
        <li>Heure: <?php echo $event->getHeureEvent(); ?></li>
        <li>Ville: <?php echo $event->getVille(); ?></li>
        <li>Adresse: <?php echo $event->getAdresse(); ?></li>
        <li>Code Postal: <?php echo $event->getCodePostal(); ?></li>
        <li>Description Courte: <?php echo $event->getDescriptionCourte(); ?></li>
        <li>Description Longue: <?php echo $event->getDescriptionLongue(); ?></li>
        <li>Nombre de Places: <?php echo $event->getNbPlaces(); ?></li>
        <li>Prix: <?php echo $event->getPrix(); ?></li>
        <li>Lien Billeterie: <?php echo $event->getLienBilleterie(); ?></li>
        <li>Lien Event: <?php echo $event->getLienEvent(); ?></li>
        <li>Nom Structure: <?php echo $event->getNomStructure(); ?></li>
        <br>
        <br>
    <?php } ?>
</ul>


<h2>Liste des Evenements auxquel je suis inscrit </h2>

<ul>
    <?php foreach ($listEventsRegistered as $event) { ?>
        <li>Titre: <?php echo $event->getTitre(); ?></li>
        <li>Date: <?php echo $event->getDateEvent(); ?></li>
        <li>Heure: <?php echo $event->getHeureEvent(); ?></li>
        <li>Ville: <?php echo $event->getVille(); ?></li>
        <li>Adresse: <?php echo $event->getAdresse(); ?></li>
        <li>Code Postal: <?php echo $event->getCodePostal(); ?></li>
        <li>Description Courte: <?php echo $event->getDescriptionCourte(); ?></li>
        <li>Description Longue: <?php echo $event->getDescriptionLongue(); ?></li>
        <li>Nombre de Places: <?php echo $event->getNbPlaces(); ?></li>
        <li>Prix: <?php echo $event->getPrix(); ?></li>
        <li>Lien Billeterie: <?php echo $event->getLienBilleterie(); ?></li>
        <li>Lien Event: <?php echo $event->getLienEvent(); ?></li>
        <li>Nom Structure: <?php echo $event->getNomStructure(); ?></li>
        <br>
        <br>
    <?php } ?>
</ul>