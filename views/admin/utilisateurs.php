<h2>Gestion des utilisateurs</h2>

<p>Attente de validation :<?php echo $demandes; ?></p>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Valider</th>
            <th>Refuser</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($toValidates as $toValidate) {
            echo "
            <tr>
                <th>".$toValidate->getNom()."</th>
                <th>".$toValidate->getPrenom()."</th>
                <th>".$toValidate->getMail()."</th>
                <th><a href='?controller=admin&action=validateUser&id_utilisateur=".$toValidate->getId_utilisateur()."'>[O]</a></th>
                <th><a href='".$toValidate->getId_utilisateur()."'>[X]</a></th>
            </tr>
            ";
        }
        ?>
        
    </tbody>
</table>

<h2>Liste des utilisateurs</h2>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $utilisateur) {
            echo "
            <tr>
                <th>".$utilisateur->getNom()."</th>
                <th>".$utilisateur->getPrenom()."</th>
                <th>".$utilisateur->getMail()."</th>
                <th><a href='?controller=admin&action=voirUser&id_utilisateur=".$utilisateur->getId_utilisateur()."'>[M]</a></th>
            </tr>
            ";
        }
        ?>
        
    </tbody>
</table>
