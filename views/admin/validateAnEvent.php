<h1>VALIDER UN EVENEMENT </h1>


<form action="?controller=admin&action=validate" method="post">
    <input type="hidden" name="id_event" value="<?php echo $event->getIdEvent(); ?>">
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

    <input type="submit" value="VALIDER">
</form>