<div class="container">
    <div class="mon-compte">
        <h1 class="h1-autres mb-5">Mon compte </h1>
        <div class="ancre-monCompte d-grid gap-3">
            <button>
                <a href="monCompte#voiture" class="button_top">Mes véhicules</a>
            </button>
            <button>
                <a href="monCompte#futur" class="button_top">Événements créés à venir</a>
            </button>
            <button>
                <a href="monCompte#passe" class="button_top">Événements créés passés</a>
            </button>
            <button>
                <a href="monCompte#inscrit" class="button_top">Événements inscrit</a>
            </button>
            <button>
                <a href="monCompte#covoiturage" class="button_top">Covoiturage</a>
            </button>
        </div>
        <h2 class="mb-5 mt-5" >information personelle</h2>
        <div class="row">
            <div class="col-3 mb-5">
                <img src="imgUploaded/<?php echo $user->getAvatar();?>" alt="" style="width: 100%;<?php if($premium) echo "border: 5px solid gold; border-radius : 100%"?>">
            </div>
            <div class="col-9 mt-4 mb-5 infosPerso">
                <ul>
                    <li>Mail : <?php echo $user->getMail();?></li>
                    <li>Ville : <?php echo $user->getVille();?></li>
                    <li>Nom : <?php echo $user->getNom();?></li>
                    <li>Prenom : <?php echo $user->getPrenom();?></li>
                    <li class="mb-5">Téléphone : <?php echo $user->getTelephone();?></li>
                    <li><a class="btn btn-primary" href="monCompte/informations_personnelles">Modifier infos perso</a></li>
                </ul>
            </div>
        </div>
        <h2 id="voiture" class="mt-5 mb-5" >Mes vehicules</h2>
        <table>
            <thead>
                <tr>
                    <th>Vehicule</th>
                    <th>Immatriculation</th>
                    <th class="none-vehicule">Nombre de places</th>
                    <th class="none-vehicule">Type de vehicule</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicules as $vehicule) {
                    echo "
                    <tr>
                            <td>".$vehicule->getLibelle_vehicule()."</td>
                            <td>".$vehicule->getImmatriculation()."</td>
                            <td class='none-vehicule'>".$vehicule->getNb_places()."</td>
                            <td class='none-vehicule'>".Vehicule::findTypeVehicule($vehicule->getId_vehicule())."</td>
                            <td><a href='/here_we_go/monCompte/modifier_mon_vehicule/".$vehicule->getId_vehicule_utilisateur()."'>Modifier</a></td>
                        </tr> 
                    ";
                }
                ?>
            </tbody>
            </table>
        <a class="btn btn-primary mt-3" href="/here_we_go/monCompte/ajout_vehicule">Ajouter un vehicule</a> 
        <div class="border border-dark p-3 mt-5">
            <h3 class="text-dark ">Téléchargement des événements créés</h3>
            <div class="d-inline-block">
                <p class="d-inline-block me-3">Vous pouvez télécharger au format CSV en cliquant sur le bouton ci-dessous pour retrouver toutes les informations de vos événements créés.</p>
                <a href="?controller=utilisateurs&action=telechargerTousCSV" id="futur" class="btn btn-primary d-inline-block">Telecharger</a>
            </div>
        </div>
        <div class="accordion mt-5">
            <div class="accordion-item">
                <h2 id="passe">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                        <span>Vos évenements crée a venir</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <section class="my-5">
                            <div class="row g-3">
                                <?php foreach ($eventsUpcoming as $event) {?>
                                    <div class="col-xl-4 col-lg-6 col-12">
                                        <div class="card position-relative h-100 mx-auto " style="width: 20rem;">
                                            <a href="monCompte/modifier_mon_evenement/<?php echo $event->id_event;?>">
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
                </div>
            </div>
            <div class="accordion-item">
                <h2 id="inscrit">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        <span >Vos événements créés passés</span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <section class="my-5">
                            <div class="row g-3">
                                <?php foreach ($events as $event) {?>
                                    <div class="col-xl-4 col-lg-6 col-12">
                                        <div class="card position-relative h-100 mx-auto" style="width: 20rem;">
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
                </div>
            </div>
            <div class="accordion-item">
                <h2>
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        <span >Liste des évenements inscrit </span>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <section class="my-5">
                            <div class="row g-3">
                                <?php foreach ($listEventsRegistered as $event) {?>
                                    <div class="col-xl-4 col-lg-6 col-12">
                                        <div class="card position-relative h-100 mx-auto" style="width: 20rem;">
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
                </div>
            </div>
        </div>
        <h1 class="mt-5 mb-5" id="covoiturage">Covoiturage</h1>
            <h2>Covoiturage que je propose</h2>
            <table class="table-covoit">
                <tr>
                    <th>Evenenement</th>
                    <th>Date</th>
                    <th>Heure de depart</th>
                    <th class="none-vehicule">Lieu de depart</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($covoits as $covoit) { ?>
                <tr>
                    <td><?php echo Evenement::find($covoit->getIdEvent())->getTitre(); ?></td>
                    <td><?php echo date("m/d/y", strtotime(Evenement::find($covoit->getIdEvent())->getDateEvent())); ?></td>
                    <td><?php echo date("H\hi", strtotime($covoit->getHeureDepart())); ?></td>
                    <td class="none-vehicule"><?php echo $covoit->getLieuDepart(); ?></td>
                    <td><a href="/here_we_go/monCompte/modifier_mon_covoiturage/<?php echo $covoit->getIdCovoiturage(); ?>">Voir</a></td>
                </tr>
                <?php } ?>
            </table>
                
                <h2 class="mt-5">Covoiturage auxquels je suis inscrit</h2>
                <table class="mb-5 table-covoit">
                    <tr>
                        <th>Evenenement</th>
                        <th>Date</th>
                        <th>Heure de depart</th>
                        <th class="none-vehicule">Lieu de depart</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($covoitsInscrit as $covoit) { ?>
                    <tr>
                        <td><?php echo Evenement::find($covoit->getIdEvent())->getTitre(); ?></td>
                        <td><?php echo date("m/d/y", strtotime(Evenement::find($covoit->getIdEvent())->getDateEvent())); ?></td>
                        <td><?php echo date("H\hi", strtotime($covoit->getHeureDepart())); ?></td>
                        <td class="none-vehicule"><?php echo $covoit->getLieuDepart(); ?></td>
                        <td><a href="/here_we_go/covoiturage/<?php echo $covoit->getIdCovoiturage(); ?>">Voir</a></td>
                    </tr>
                    <?php } ?>
                </table>
    </div>
</div>