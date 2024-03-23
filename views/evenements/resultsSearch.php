<h1>Resultats pour <?php echo $keyword ?></h1>
<div class="container">
    <section class="my-5">
        <div class="row g-3">
            <?php foreach ($events as $event) {?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card position-relative h-100" style="width: 22rem;">
                        <a href="/here_we_go/fiche_evenement/<?php echo $event->id_event;?>">
                            <img src="photo_evenement/<?php echo PhotosEvenement::findByIdEvent($event->id_event)["chemin"]; ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <p class="mb-0"><?php echo date('d/m/Y', strtotime($event->date_event))." - ".date('H:i', strtotime($event->heure_event)); ?></p>
                            <h5 class="card-title" style="color : <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>;"><?php echo $event->titre; ?></h5>
                            <p class="card-text"><?php echo $event->description_courte; ?></p>
                        </div>
                        <div class="d-flex" style="color : white; background: <?php echo Categorie::findByEventId($event->id_event)->getCouleur(); ?>; width : 100%; height : 70px">
                            <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                                <span><?php echo $event->prix; ?> <i class="fa-solid fa-euro-sign"></i></span>
                            </div>
                            <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                                <span><?php echo $event->ville." (".substr($event->code_postal, 0, 2).")"; ?></span>
                                <span><i class="fa-solid fa-location-dot"></i></span>
                            </div>
                            <div class="col-3 d-flex flex-column align-items-center justify-content-center">
                                <span><?php echo Covoiturage::getCovoituragesCountByEventId($event->id_event);?></span>
                                <span><i class="fa-solid fa-car"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

