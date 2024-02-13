
<h2>infos persos</h2>

<ul>
    <li>Mail : <?php echo $user->getMail();?></li>
    <li>Ville : <?php echo $user->getVille();?></li>
    <li>Nom : <?php echo $user->getNom();?></li>
    <li>Prenom : <?php echo $user->getPrenom();?></li>
</ul>



<h2>Mes vehicules :</h2>

<ul>
    <?php foreach ($vehicules as $vehicule) {
         echo "
         <li>".$vehicule->getLibelle_vehicule()."</li>
         <li>".$vehicule->getImmatriculation()."</li>
         <li>".$vehicule->getNb_places()."</li>
         ";
        
    }    ?>
</ul>



<h2>Evenements créé</h2>

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



<h2>Evenements auxquel je suis inscrit </h2>

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