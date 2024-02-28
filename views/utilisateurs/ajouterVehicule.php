<h2>Ajouter un véhicule</h2>
    <form action="?controller=utilisateurs&action=addVehicule" method="post">
        <label for="libelle">Libellé du véhicule:</label><br>
        <input type="text" id="libelle" name="libelle_vehicule"><br>
        <label for="immatriculation">Immatriculation:</label><br>
        <input type="text" id="immatriculation" name="immatriculation"><br>
        <label for="nb_places">Nombre de places:</label><br>
        <input type="number" id="nb_places" name="nb_places"><br>
        <label for="id_vehicule">Type du véhicule:</label><br>
        <select name="id_vehicule" id="id_vehicule">
            <?php foreach ($types as $type) {
                echo "<option value='".$type->getIdVehicule()."'>".$type->getType()."</option>";
            }
            ?>
        </select>
        <input type="submit" value="Ajouter">
    </form>
    <a href="?controller=utilisateurs&action=monCompte">Retour</a>