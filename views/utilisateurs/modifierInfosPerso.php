<h1>Informations personnelles</h1>
<?php if(isset($_GET['error'])) {
    $errorMessage = urldecode($_GET['error']);
    echo '<div class="error-message">' . $errorMessage . '</div>';
}
?>
<form action="?controller=utilisateurs&action=updateInfosPerso" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="mail" class="form-label">Email :</label>
            <input type="text" class="form-control" name="mail" id="mail" value="<?php echo $user->getMail();?>">
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $user->getNom();?>">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom :</label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $user->getPrenom();?>">
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville :</label>
            <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $user->getVille();?>">
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Telephone :</label>
            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $user->getTelephone();?>">
        </div>
        <div class="mb-3">
            <label for="avatar" class="form-label">Modifier Avatar :</label>
            <input type="file" class="form-control" name="avatar" id="avatar">
        </div>
        <div class="mb-3">
            <img src="imgUploaded/<?php echo $user->getAvatar();?>" alt="Avatar" style="width: 100px;">
        </div>
        <a href="?controller=utilisateurs&action=monCompte" class="btn btn-danger">Retour</a>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="?controller=utilisateurs&action=avatarParDefaut" class="btn btn-danger">Supprimer mon avatar</a>
    </form>