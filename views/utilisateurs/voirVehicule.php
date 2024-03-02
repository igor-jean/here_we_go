<h1>Modifier mon vehicule</h1>

<form action="?controller=utilisateurs&action=updateVehicule" method="post">
        <input type="hidden" name="id_vehicule_utilisateur" value="<?php echo $vehicule->getId_vehicule_utilisateur(); ?>">
        <div class="mb-3">
            <label for="libelle_vehicule" class="form-label">Libellé du véhicule :</label><br>
            <input type="text" class="form-control" id="libelle_vehicule" name="libelle_vehicule" value="<?php echo $vehicule->getLibelle_vehicule(); ?>"><br>
        </div>
        <div class="mb-3">
            <label for="imatriculation" class="form-label">Immatriculation :</label><br>
            <input type="text" class="form-control" id="imatriculation" name="imatriculation" value="<?php echo $vehicule->getImmatriculation(); ?>"><br>
        </div>
        <div class="mb-3">
            <label for="nb_places" class="form-label">Nombre de places :</label><br>
            <input type="number" class="form-control" id="nb_places" name="nb_places" value="<?php echo $vehicule->getNb_places(); ?>"><br>
        </div>
        <div class="mb-3">
            <label for="type_vehicule" class="form-label">Type de véhicule :</label><br>
            <select class="form-select" id="type_vehicule" name="id_vehicule">
                <?php foreach ($types as $type) {
                    if($type->getIdVehicule() === $vehicule->getId_vehicule()) {
                        echo "<option value='".$type->getIdVehicule()."' selected >".$type->getType()."</option>";
                    } else {
                        echo "<option value='".$type->getIdVehicule()."'>".$type->getType()."</option>";
                    }
                } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="?controller=utilisateurs&action=deleteVehicule&id_vehicule_utilisateur=<?php echo $vehicule->getId_vehicule_utilisateur(); ?>" class="btn btn-danger">Supprimer</a>
    </form>

    <a href="?controller=utilisateurs&action=monCompte" class="btn btn-secondary mt-3">Retour</a>