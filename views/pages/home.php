<?php
if(isset($_GET['errorMessage'])) {
    $errorMessage = urldecode($_GET['errorMessage']);
    echo '<div class="error-message">' . $errorMessage . '</div>';
}elseif(isset($_GET['error'])) {
    $error = urldecode($_GET['error']);
    echo '<div class="error-message">' . $error . '</div>';
}
?>
<div class="background-index "></div>
    <div class="bg-color ">
        <div class="container">
            <h1>Liste des événements</h1>
        </div>
    </div>
<div class="container">
    <section class="articles mt-5 mb-5">
        <?php foreach ($events as $event) {?>
        <article style="border: 7px solid <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>">
            <div class="article-wrapper">
                <figure>
                    <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" alt="" />
                </figure>
                <ul>
                    <div class="article-body">
                        <li><h3><?php echo $event->titre; ?></h3></li>
                        <li><?php echo date('d/m/Y', strtotime($event->date_event))." - ".date('H:i', strtotime($event->heure_event)); ?></li>
                        <li><?php echo $event->ville." (".substr($event->code_postal, 0, 2).")"; ?></li>
                        <li>Prix : <?php echo $event->prix; ?> €</li>
                        <li><?php echo $event->description_courte; ?></li>
                        <a href="/here_we_go/fiche_evenement/<?php echo $event->id_event;?>" class="read-more">
                            En savoir + <span class="sr-only">about this is some title</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <p><?php if(Covoiturage::getCovoituragesCountByEventId($event->id_event) > 0) {echo "Il y a ".Covoiturage::getCovoituragesCountByEventId($event->id_event)." covoiturage(s) de disponnible pour cet événement.";}   ?></p>
                    </div>
                </ul>
            </div>
        </article>
        <?php } ?>
    </section>
    <section>
    <iframe width="1000" height="350" src="https://www.openstreetmap.org/export/embed.html?bbox=0.17663955688476565%2C46.534067099437756%2C0.46331405639648443%2C46.6350579278567&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small>
    </section>
</div>