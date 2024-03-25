<div class="container">
    <h1>Ajouter un véhicule</h1>
    <?php if(isset($_GET['error'])) {
        $errorMessage = urldecode($_GET['error']);
        echo '<div class="error-message">' . $errorMessage . '</div>';
    }
    ?>
    <form action="?controller=utilisateurs&action=addVehicule" method="post">
        <div class="mb-3">
            <label for="libelle" class="form-label">Libellé du véhicule :</label>
            <input type="text" class="form-control" id="libelle" name="libelle_vehicule">
        </div>
        <div class="mb-3">
            <label for="immatriculation" class="form-label">Immatriculation :</label>
            <input type="text" class="form-control" id="immatriculation" name="immatriculation">
        </div>
        <div class="mb-3">
            <label for="nb_places" class="form-label">Nombre de places :</label>
            <input type="number" class="form-control" id="nb_places" name="nb_places">
        </div>
        <div class="mb-3">
            <label for="id_vehicule" class="form-label">Type du véhicule :</label>
            <select class="form-select" id="id_vehicule" name="id_vehicule">
                <?php foreach ($types as $type) {
                    echo "<option value='".$type->getIdVehicule()."'>".$type->getType()."</option>";
                } ?>
            </select>
        </div>
        <div class="mt-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="?controller=utilisateurs&action=monCompte" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>
