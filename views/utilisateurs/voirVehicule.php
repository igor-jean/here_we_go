<h2>Modifier mon vehicule</h2>

<form action="?controller=utilisateurs&action=updateVehicule" method="post">
        <input type="hidden" name="id_vehicule_utilisateur" value="<?php echo $vehicule->getId_vehicule_utilisateur(); ?>">
        <label for="libelle_vehicule">Libellé du véhicule :</label><br>
        <input type="text" id="libelle_vehicule" name="libelle_vehicule" value="<?php echo $vehicule->getLibelle_vehicule(); ?>"><br>
        <label for="imatriculation">Immatriculation :</label><br>
        <input type="text" id="imatriculation" name="imatriculation" value="<?php echo $vehicule->getImmatriculation(); ?>"><br>
        <label for="nb_places">Nombre de places :</label><br>
        <input type="number" id="nb_places" name="nb_places" value="<?php echo $vehicule->getNb_places(); ?>"><br>
        <label for="type_vehicule">Type de vehicule :</label><br>
        <select name="id_vehicule" id="type_vehicule">
            <?php foreach ($types as $type) {
                if($type->getIdVehicule() === $vehicule->getId_vehicule()) {
                    echo "<option value='".$type->getIdVehicule()."' selected >".$type->getType()."</option>";
                }else {
                    echo "<option value='".$type->getIdVehicule()."'>".$type->getType()."</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Modifier">
    </form>