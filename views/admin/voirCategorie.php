<form action="?controller=admin&action=updateCategorie" method="post">
    <input type="hidden" name="id_categorie" value="<?php echo $categorie->getIdCategorie();?>">
    <label for="nom">Nom Categorie:</label>
    <input type="text" name="libelle_categorie" id="nom" value="<?php echo $categorie->getLibelleCategorie();?>">
    <label for="couleur">Couleur associée</label>
    <input type="color" name="couleur" id="couleur" value="<?php echo $categorie->getCouleur();?>">
    <input type="submit" value="Modifier">
</form>