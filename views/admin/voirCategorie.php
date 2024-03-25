<h2>Modifier une catégorie</h2>
<div class="container">
    <form action="?controller=admin&action=updateCategorie" method="post">
        <input type="hidden" name="id_categorie" value="<?php echo $categorie->getIdCategorie();?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom Catégorie<span class="red-star"> *</span>:</label>
            <input type="text" class="form-control" name="libelle_categorie" id="nom" value="<?php echo $categorie->getLibelleCategorie();?>">
        </div>
        <div class="mb-3">
            <label for="couleur" class="form-label">Couleur associée<span class="red-star"> *</span>:</label>
            <input type="color" class="form-control" name="couleur" id="couleur" value="<?php echo $categorie->getCouleur();?>">
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <a href="?controller=admin&action=categorieVehiculeAdministration" class="btn btn-secondary mt-3">Retour</a>
</div>