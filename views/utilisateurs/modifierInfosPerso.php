<form action="?controller=utilisateurs&action=updateInfosPerso" method="post" enctype="multipart/form-data">
    <label for="mail">Email :</label>
    <input type="text" name="mail" id="mail" value="<?php echo $user->getMail();?>"><br>

    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" value="<?php echo $user->getNom();?>"><br>

    <label for="prenom">Prenom:</label>
    <input type="text" name="prenom" id="prenom" value="<?php echo $user->getPrenom();?>"><br>

    <label for="ville">Ville:</label>
    <input type="text" name="ville" id="ville" value="<?php echo $user->getVille();?>"><br>

    <label for="telephone">Telephone:</label>
    <input type="text" name="telephone" id="telephone" value="<?php echo $user->getTelephone();?>"><br>

    <label for="avatar">Modifier Avatar:</label>
    <input type="file" name="avatar" id="avatar" value="<?php echo $user->getAvatar();?>"><br>

    <img src="imgUploaded/<?php echo $user->getAvatar();?>" alt="" style="width: 100px;">
    <input type="submit" value="Modifier">
    <a href="?controller=utilisateurs&action=avatarParDefaut">Supprimer mon avatar</a>
</form>