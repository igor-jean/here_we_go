<h1>MODIFIER EVENEMENT</h1>


<form action="?controller=evenements&action=update" method="post">
    <input type="hidden" name="id_event" value="<?php echo $event->getIdEvent() ;?>">
    <label for="titre">Titre de l'événement:</label>
    <input value="<?php echo $event->getTitre();?>" type="text" id="titre" name="titre"><br>
    
    <label for="date_event">Date de l'événement:</label>
    <input value="<?php echo $event->getDateEvent();?>" type="date" id="date_event" name="date_event"><br>
    
    <label for="heure_event">Heure de l'événement:</label>
    <input value="<?php echo $event->getHeureEvent();?>" type="time" id="heure_event" name="heure_event"><br>
    
    <label for="ville">Ville:</label>
    <input value="<?php echo $event->getVille();?>" type="text" id="ville" name="ville"><br>
    
    <label for="adresse">Adresse:</label>
    <input value="<?php echo $event->getAdresse();?>" type="text" id="adresse" name="adresse"><br>
    
    <label for="code_postal">Code Postal:</label>
    <input value="<?php echo $event->getCodePostal();?>" type="text" id="code_postal" name="code_postal"><br>
    
    <label for="description_courte">Description courte:</label>
    <textarea id="description_courte" name="description_courte"><?php echo $event->getDescriptionCourte();?></textarea><br>
    
    <label for="description_longue">Description longue:</label>
    <textarea id="description_longue" name="description_longue"><?php echo $event->getDescriptionLongue();?></textarea><br>
    
    <label for="nb_places">Nombre de places:</label>
    <input value="<?php echo $event->getNbPlaces();?>" type="number" id="nb_places" name="nb_places"><br>
    
    <label for="prix">Prix:</label>
    <input value="<?php echo $event->getPrix();?>" type="text" id="prix" name="prix"><br>
    
    <label for="lien_billeterie">Lien vers la billetterie:</label>
    <input value="<?php echo $event->getLienBilleterie();?>" type="text" id="lien_billeterie" name="lien_billeterie"><br>
    
    <label for="lien_event">Lien vers l'événement:</label>
    <input value="<?php echo $event->getLienEvent();?>" type="text" id="lien_event" name="lien_event"><br>
    
    <label for="nom_structure">Nom de la structure:</label>
    <input value="<?php echo $event->getTitre();?>" type="text" id="nom_structure" name="nom_structure"><br>

    <select name="id_categorie" id="id_categorie">
    <?php
    foreach ($categories as $categorie) {
    if ($categorie->getIdCategorie() === $categorieFinded->getIdCategorie()) {
        echo "<option value=\"" . $categorie->getIdCategorie() . "\" selected>" . $categorie->getLibelleCategorie() . "</option>";
    } else {
        echo "<option value=\"" . $categorie->getIdCategorie() . "\">" . $categorie->getLibelleCategorie() . "</option>";
    }
}
?>
    </select>

    <input type="submit" value="Modifier">
    <button><a href="?controller=evenements&action=confirmerSuppression&id_event=<?php echo $event->getIdEvent() ;?>">Supprimer</a></button>
</form>


<h2>Covoiturage</h2>

<table>
    <thead>
        <tr>
            <th>Montant par personne</th>
            <th>Information de contact</th>
            <th>Lieu de départ</th>
            <th>Nombre de places</th>
            <th>Heure de départ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($covoits as $covoit) { ?>
            <tr>
                <td><?php echo $covoit->getMontantParPers(); ?></td>
                <td><?php echo $covoit->getInformationDeContact(); ?></td>
                <td><?php echo $covoit->getLieuDepart(); ?></td>
                <td><?php echo $covoit->getNbPlace(); ?></td>
                <td><?php echo $covoit->getHeureDepart(); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="?controller=utilisateurs&action=monCompte">Retour</a>
