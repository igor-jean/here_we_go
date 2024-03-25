<h2>Ajouter un type de véhicule</h2>
<div class="container">
    <form action="?controller=admin&action=addTypeVehicule" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom Type vehicule<span class="red-star"> *</span>:</label>
            <input type="text" class="form-control" name="type" id="nom">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <a href="?controller=admin&action=categorieVehiculeAdministration" class="btn btn-secondary mt-3">Retour</a>
</div>