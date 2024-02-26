<form action="?controller=admin&action=updateTypeVehicule" method="post">
    <input type="hidden" name="id_vehicule" value="<?php echo $vehicule->getIdVehicule();?>">
    <label for="nom">Nom Categorie:</label>
    <input type="text" name="type" id="nom" value="<?php echo $vehicule->getType();?>">
    <input type="submit" value="Modifier">
</form>