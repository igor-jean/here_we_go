<h1>Liste des bonnes pratique eco</h1>


<form action="?controller=evenements&action=add" method="post">

    <label for="titre">Titre de l'événement:</label>
    <input type="text" id="titre" name="titre"><br>
    
    <label for="date_event">Date de l'événement:</label>
    <input type="date" id="date_event" name="date_event"><br>
    
    <label for="heure_event">Heure de l'événement:</label>
    <input type="time" id="heure_event" name="heure_event"><br>
    
    <label for="ville">Ville:</label>
    <input type="text" id="ville" name="ville"><br>
    
    <label for="adresse">Adresse:</label>
    <input type="text" id="adresse" name="adresse"><br>
    
    <label for="code_postal">Code Postal:</label>
    <input type="text" id="code_postal" name="code_postal"><br>
    
    <label for="description_courte">Description courte:</label>
    <textarea id="description_courte" name="description_courte"></textarea><br>
    
    <label for="description_longue">Description longue:</label>
    <textarea id="description_longue" name="description_longue"></textarea><br>
    
    <label for="nb_places">Nombre de places:</label>
    <input type="number" id="nb_places" name="nb_places"><br>
    
    <label for="prix">Prix:</label>
    <input type="text" id="prix" name="prix"><br>
    
    <label for="lien_billeterie">Lien vers la billetterie:</label>
    <input type="text" id="lien_billeterie" name="lien_billeterie"><br>
    
    <label for="lien_event">Lien vers l'événement:</label>
    <input type="text" id="lien_event" name="lien_event"><br>
    
    <label for="nom_structure">Nom de la structure:</label>
    <input type="text" id="nom_structure" name="nom_structure"><br>
    
    <label for="nb_visiteur">Nombre de visiteurs:</label>
    <input type="number" id="nb_visiteur" name="nb_visiteur"><br>
    
    <label for="code_unique_label">Code unique:</label>
    <input type="text" id="code_unique_label" name="code_unique_label"><br>

    <select name="id_categorie" id="id_categorie">
        <?php foreach ($categories as $categorie) {
            echo "<option value=".$categorie->getIdCategorie().">".$categorie->getLibelleCategorie()."</option>";
            } 
        ?>
    </select>

    <input type="submit" value="Ajouter">
</form>