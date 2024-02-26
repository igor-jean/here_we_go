<form action="?controller=admin&action=modifierUtilisateur" method="POST">
        <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateur->getId_utilisateur(); ?>">
        <label for="mail">Mail:</label><br>
        <input type="text" id="mail" name="mail" value="<?php echo $utilisateur->getMail(); ?>"><br>
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" value="<?php echo $utilisateur->getNom(); ?>"><br>
        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom" value="<?php echo $utilisateur->getPrenom(); ?>"><br>
        <label for="avatar">Avatar:</label><br>
        <input type="text" id="avatar" name="avatar" value="<?php echo $utilisateur->getAvatar(); ?>"><br>
        <label for="ville">Ville:</label><br>
        <input type="text" id="ville" name="ville" value="<?php echo $utilisateur->getVille(); ?>"><br>
        <label for="telephone">Téléphone:</label><br>
        <input type="tel" id="telephone" name="telephone" value="<?php echo $utilisateur->getTelephone(); ?>"><br>
        <label for="role">Rôle:</label><br>
        <select id="role" name="role">
            <option value="1" <?php if($utilisateur->getRole() == 1) echo "selected"; ?>>Admin</option>
            <option value="2" <?php if($utilisateur->getRole() == 2) echo "selected"; ?>>Utilisateur</option>
        </select><br>
        <input type="submit" value="Modifier">
        <a href="?controller=admin&action=supprimerUtilisateur&id_utilisateur=<?php echo $utilisateur->getId_utilisateur(); ?> ">Supprimer</a>
    </form>