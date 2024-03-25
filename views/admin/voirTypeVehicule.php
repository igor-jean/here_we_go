<h2>Modifier le type de véhicule</h2>
<div class="container">
    <form action="?controller=admin&action=updateTypeVehicule" method="post">
        <input type="hidden" name="id_vehicule" value="<?php echo $vehicule->getIdVehicule();?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom Type Vehicule<span class="red-star"> *</span>:</label>
            <input type="text" class="form-control" name="type" id="nom" value="<?php echo $vehicule->getType();?>">
        </div>
    
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <a href="?controller=admin&action=categorieVehiculeAdministration" class="btn btn-secondary mt-3">Retour</a>
</div>