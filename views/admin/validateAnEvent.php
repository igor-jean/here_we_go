<h1>VALIDER UN EVENEMENT </h1>



    <ul>
        <li><?php echo $event->getTitre(); ?></li>
        <li><?php echo $event->getDateEvent(); ?></li>
        <li><?php echo $event->getHeureEvent(); ?></li>
        <li><?php echo $event->getVille(); ?></li>
        <li><?php echo $event->getAdresse(); ?></li>
        <li><?php echo $event->getCodePostal(); ?></li>
        <li><?php echo $event->getDescriptionCourte(); ?></li>
        <li><?php echo $event->getDescriptionLongue(); ?></li>
        <li><?php echo $event->getNbPlaces(); ?></li>
        <li><?php echo $event->getPrix(); ?></li>
        <li><?php echo $event->getLienBilleterie(); ?></li>
        <li><?php echo $event->getLienEvent(); ?></li>
        <li><?php echo $event->getNomStructure(); ?></li>
        <li><?php echo $event->getNbVisiteur(); ?></li>
        <li><?php echo $categorie->getLibelleCategorie(); ?></li>
    </ul>

    <a href="?controller=admin&action=validate&id_event=<?php echo $event->getIdEvent(); ?>">Valider</a>
    <a href="?controller=admin&action=delete&id_event=<?php echo $id_event; ?>">Supprimer</a>
    <br>
    <a href="?controller=admin&action=evenementsAdministration">Retour</a>