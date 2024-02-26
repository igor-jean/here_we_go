<h2>Gestion des categorie</h2>

<table>
    <thead>
        <tr>
            <th>Categorie</th>
            <th>Couleur</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $categorie) {
            echo "
               <tr>
                    <td>".$categorie->getLibelleCategorie()."</td>
                    <td><input type='color' value='".$categorie->getCouleur()."'></td>
                    <td><a href='?controller=admin&action=voirCategorie&id_categorie=".$categorie->getIdCategorie()."'>Modifier</a></td>
                </tr> 
            ";
        }
        ?>
        
    </tbody>
    <tfoot>
        <tr>
            <td>
                <a href="?controller=admin&action=ajouterCategorie">Ajouter une categorie</a>
            </td>
        </tr>
    </tfoot>
    
</table>