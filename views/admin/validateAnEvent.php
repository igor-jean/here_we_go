<h1>VALIDER UN ÉVÉNEMENT</h1>
<div class="container">
    <ul class="list-unstyled">
        <li><strong>Titre :</strong> <?php echo $event->getTitre(); ?></li>
        <li><strong>Date :</strong> <?php echo $event->getDateEvent(); ?></li>
        <li><strong>Heure :</strong> <?php echo $event->getHeureEvent(); ?></li>
        <li><strong>Ville :</strong> <?php echo $event->getVille(); ?></li>
        <li><strong>Adresse :</strong> <?php echo $event->getAdresse(); ?></li>
        <li><strong>Code Postal :</strong> <?php echo $event->getCodePostal(); ?></li>
        <li><strong>Description courte :</strong> <?php echo $event->getDescriptionCourte(); ?></li>
        <li><strong>Description longue :</strong> <?php echo $event->getDescriptionLongue(); ?></li>
        <li><strong>Nombre de places :</strong> <?php echo $event->getNbPlaces(); ?></li>
        <li><strong>Prix :</strong> <?php echo $event->getPrix(); ?></li>
        <li><strong>Lien billetterie :</strong> <?php echo $event->getLienBilleterie(); ?></li>
        <li><strong>Lien événement :</strong> <?php echo $event->getLienEvent(); ?></li>
        <li><strong>Nom de la structure :</strong> <?php echo $event->getNomStructure(); ?></li>
        <li><strong>Nombre de visiteurs :</strong> <?php echo $event->getNbVisiteur(); ?></li>
        <li><strong>Catégorie :</strong> <?php echo $categorie->getLibelleCategorie(); ?></li>
    </ul>
    
    <a href="?controller=admin&action=validate&id_event=<?php echo $event->getIdEvent(); ?>" class="btn btn-success">Valider</a>
    <a href="?controller=admin&action=delete&id_event=<?php echo $id_event; ?>" class="btn btn-danger">Supprimer</a>
    <br>
    <a href="?controller=admin&action=evenementsAdministration" class="btn btn-primary mt-3">Retour</a>
</div>