
    <h1 style="color: green; margin: 50px auto; font-size:2rem; text-align: center;">Liste des événements</h1>
    <?php foreach ($events as $event) { ;?>
        <ul>
            <li>Titre : <?php echo $event->titre;?></li>
            <li>Date : <?php echo date('d/m/Y',strtotime($event->date_event));?></li>
            <li>Heure : <?php echo date('H:i',strtotime($event->heure_event));?></li>
            <li>Ville : <?php echo $event->ville;?></li>
            <li>Code Postal : <?php echo $event->code_postal;?></li>
            <li>Description : <?php echo $event->description_courte;?></li>
            <li>Prix : <?php echo $event->prix;?> €</li>
        </ul>
    <?php } ?>
