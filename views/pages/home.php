
<h1>Liste des événements</h1>

<section class="articles mt-5 mb-5">
    <?php foreach ($events as $event) {?>
    <article>
        <div class="article-wrapper">
            <div class="couleur_evenement" style="background-color: <?php echo $eventColor; ?>">
                <figure>
                    <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"];; ?>" alt="" />
                </figure>
                <ul>
                    <div class="article-body">
                        <li><h3><?php echo $event->titre; ?></h3></li>
                        <li><?php echo date('d/m/Y', strtotime($event->date_event))." - ".date('H:i', strtotime($event->heure_event)); ?></li>
                        <li><?php echo $event->ville." (".substr($event->code_postal, 0, 2).")"; ?></li>
                        <li>Prix : <?php echo $event->prix; ?> €</li>
                        <li><?php echo $event->description_courte; ?></li>
                        <a href="?controller=evenements&action=showEvent&id_event=<?php echo $event->id_event;?>" class="read-more">
                            En savoir + <span class="sr-only">about this is some title</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </ul>
            </div>
        </div>
    </article>
    <?php } ?>
</section>
