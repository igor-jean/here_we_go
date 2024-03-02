<h1>Modifier utilisateur</h1>

<form action="?controller=admin&action=modifierUtilisateur" method="POST">
    <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateur->getId_utilisateur(); ?>">
    <div class="mb-3">
        <label for="mail" class="form-label">Mail :</label><br>
        <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $utilisateur->getMail(); ?>"><br>
    </div>
    <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label><br>
        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $utilisateur->getNom(); ?>"><br>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label><br>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $utilisateur->getPrenom(); ?>"><br>
    </div>
    <div class="mb-3">
        <label for="avatar" class="form-label">Avatar :</label><br>
        <input type="text" class="form-control" id="avatar" name="avatar" value="<?php echo $utilisateur->getAvatar(); ?>"><br>
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Ville :</label><br>
        <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $utilisateur->getVille(); ?>"><br>
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone :</label><br>
        <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo $utilisateur->getTelephone(); ?>"><br>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Rôle :</label><br>
        <select class="form-select" id="role" name="role">
            <option value="1" <?php if($utilisateur->getRole() == 1) echo "selected"; ?>>Admin</option>
            <option value="2" <?php if($utilisateur->getRole() == 2) echo "selected"; ?>>Utilisateur</option>
        </select><br>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
    <a href="?controller=admin&action=supprimerUtilisateur&id_utilisateur=<?php echo $utilisateur->getId_utilisateur(); ?>" class="btn btn-danger">Supprimer</a>
</form>

<a href="?controller=admin&action=utilisateursAdministration" class="btn btn-secondary mt-3">Retour</a>