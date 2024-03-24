<div class="container">
    <h2>Gestion des utilisateurs</h2>
    
    <h3>Utilisateurs en attente de validation</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mail</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($toValidates as $toValidate) { ?>
                <tr>
                    <td><?php echo $toValidate->getNom(); ?></td>
                    <td><?php echo $toValidate->getPrenom(); ?></td>
                    <td><?php echo $toValidate->getMail(); ?></td>
                    <td class=" hide-link"><a href='?controller=admin&action=validateUser&id_utilisateur=<?php echo $toValidate->getId_utilisateur(); ?>' class="btn btn-success">Valider</a></td>
                    <td class=" hide-link"><a href='?controller=admin&action=deleteUser&id_utilisateur=<?php echo $toValidate->getId_utilisateur(); ?>' class="btn btn-danger">Refuser</a></td>
                    <td class="show-link"><a href='?controller=admin&action=validateUser&id_utilisateur=<?php echo $toValidate->getId_utilisateur(); ?>'><i style="color: green" class="fa-solid fa-check"></i></a></td>
                    <td class="show-link"><a href='?controller=admin&action=deleteUser&id_utilisateur=<?php echo $toValidate->getId_utilisateur(); ?>'><i style="color: red" class="fa-solid fa-circle-xmark"></i></a></td>
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) { ?>
                <tr>
                    <td><?php echo $utilisateur->getNom(); ?></td>
                    <td><?php echo $utilisateur->getPrenom(); ?></td>
                    <td><?php echo $utilisateur->getMail(); ?></td>
                    <td class="hide-link"><a href='/here_we_go/modifier_utilisateur/<?php echo $utilisateur->getId_utilisateur(); ?>' class="btn btn-primary">Modifier</a></td>
                    <td class="show-link"><a href='/here_we_go/modifier_utilisateur/<?php echo $utilisateur->getId_utilisateur(); ?>'><i class="fa-solid fa-pen-to-square"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <a href="/here_we_go/gestion_du_site" class="btn btn-danger mt-5" tabindex="-1" role="button">RETOUR</a>
</div>