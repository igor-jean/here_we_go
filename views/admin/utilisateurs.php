<h2>Gestion des utilisateurs</h2>

<h3>Utilisateurs en attente de validation</h3>
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Valider</th>
            <th>Refuser</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($toValidates as $toValidate) { ?>
            <tr>
                <td><?php echo $toValidate->getNom(); ?></td>
                <td><?php echo $toValidate->getPrenom(); ?></td>
                <td><?php echo $toValidate->getMail(); ?></td>
                <td><a href='?controller=admin&action=validateUser&id_utilisateur=<?php echo $toValidate->getId_utilisateur(); ?>' class="btn btn-success">Valider</a></td>
                <td><a href='?controller=admin&action=deleteUser&id_utilisateur=<?php echo $toValidate->getId_utilisateur(); ?>' class="btn btn-danger">Refuser</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<h3>Liste des utilisateurs</h3>
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $utilisateur) { ?>
            <tr>
                <td><?php echo $utilisateur->getNom(); ?></td>
                <td><?php echo $utilisateur->getPrenom(); ?></td>
                <td><?php echo $utilisateur->getMail(); ?></td>
                <td><a href='?controller=admin&action=voirUser&id_utilisateur=<?php echo $utilisateur->getId_utilisateur(); ?>' class="btn btn-primary">Modifier</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="?controller=admin&action=indexAdministration" class="btn btn-danger mt-5" tabindex="-1" role="button">RETOUR</a>