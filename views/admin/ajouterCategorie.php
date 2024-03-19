<h1>Ajouter une catégorie</h1>
<div class="container">
    <form action="?controller=admin&action=addCategorie" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom Catégorie :</label>
            <input type="text" class="form-control" name="libelle_categorie" id="nom">
        </div>
        <div class="mb-3">
            <label for="couleur" class="form-label">Couleur associée :</label>
            <input type="color" class="form-control" name="couleur" id="couleur">
        </div>
    
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    
    <a href="?controller=admin&action=categorieVehiculeAdministration" class="btn btn-secondary mt-3">Retour</a>
</div>