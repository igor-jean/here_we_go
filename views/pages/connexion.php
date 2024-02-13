<h2>Connexion</h2>

<form action="?controller=utilisateurs&action=login" method="post">
    <label for="mail">Mail:</label>
    <input type="text" name="mail" id="">
    <label for="pwd">Mot de passe:</label>
    <input type="password" name="pwd" id="">
    <input type="submit" value="Se connecter">
</form>

<h2>Inscription</h2>

<form action="?controller=utilisateurs&action=register" method="post">
    <label for="mail">Adresse Mail:</label>
    <input type="text" name="mail" id="">
    <label for="confirmMail">Confirmez l'adresse Mail:</label>
    <input type="text" name="confirmMail" id="">
    <label for="pwd">Mot de passe:</label>
    <input type="password" name="pwd" id="">
    <label for="confirmPwd">Confirmez le mot de passe:</label>
    <input type="password" name="confirmPwd" id="">
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="">
    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" id="">
    <label for="ville">Ville:</label>
    <input type="text" name="ville" id="">
    <label for="telephone">Téléphone</label>
    <input type="number" name="telephone" id="">
    <input type="submit" value="S'inscrire">
</form>