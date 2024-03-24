<div class="container">
    <h1>ÉVÉNEMENTS</h1>
    
    <h2>Gestion des événements</h2>
    
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Ville</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><?php echo $event->getTitre(); ?></td>
                    <td><?php echo $event->getDateEvent(); ?></td>
                    <td><?php echo $event->getVille(); ?></td>
                    <td class="hide-link"><a href='?controller=admin&action=validateAnEvent&id_event=<?php echo $event->getIdEvent(); ?>' class="btn btn-success">Valider</a></td>
                    <td class="show-link"><a href='?controller=admin&action=validateAnEvent&id_event=<?php echo $event->getIdEvent(); ?>'><i style="color: green"class="fa-solid fa-check"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <h2>Liste des événements avec pagination</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventsForPage as $event) { ?>
                    <tr>
                        <td><?php echo $event->getTitre(); ?></td>
                        <td><?php echo $event->getDateEvent(); ?></td>
                        <td><?php echo $event->getVille(); ?></td>
                        <td class="hide-link"><a href='?controller=admin&action=updateAnEvent&id_event=<?php echo $event->getIdEvent(); ?>' class="btn btn-primary">Modifier</a></td>
                        <td class="show-link"><a href='?controller=admin&action=updateAnEvent&id_event=<?php echo $event->getIdEvent(); ?>'><i class="fa-solid fa-pen-to-square"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item"><a class="page-link" href='?controller=admin&action=evenementsAdministration&page=<?php echo $i; ?>&perPage=<?php echo $perPage; ?>'><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    
    <a href="/here_we_go/gestion_du_site" class="btn btn-danger mt-5" tabindex="-1" role="button">RETOUR</a>
</div>