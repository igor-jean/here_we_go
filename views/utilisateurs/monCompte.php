<div class="container">
    <h1 class="h1-autres mb-5">Mon compte </h1>
    <nav aria-label="breadcrumb mt-5">
    <ol class="breadcrumb mt-3 ">
        <li class="breadcrumb-item fs-6"><a href="monCompte#voiture">Mes véhicules </a></li>
        <li class="breadcrumb-item fs-6"><a href="#">Evenement crée future</a></li>
        <li class="breadcrumb-item fs-6" ><a href="#">Evénements inscrit</a></li>
        <li class="breadcrumb-item fs-6"><a href="#">Covoiturage Proposé</a></li>
        <li class="breadcrumb-item fs-6"><a href="#">Covoiturage inscrit</a></li>
    </ol>
    </nav>
    <h2 class="mb-5 mt-5" >infos persos</h2>
    <div class="row">
        <div class="col-3 mb-5">
            <img src="imgUploaded/<?php echo $user->getAvatar();?>" alt="" style="width: 100%;<?php if($premium) echo "border: 5px solid gold; border-radius : 100%"?>">
        </div>
        <div class="col-2"></div>
        <div class="col-3 mt-4">
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
    
    <h2 id="voiture" class="mt-5" >Mes vehicules :</h2>
    <table>
        <thead>
            <tr>
                <th>Vehicule</th>
                <th>Immatriculation</th>
                <th>places</th>
                <th>Type de vehicule</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicules as $vehicule) {
                echo "
                   <tr>
                        <td>".$vehicule->getLibelle_vehicule()."</td>
                        <td>".$vehicule->getImmatriculation()."</td>
                        <td>".$vehicule->getNb_places()."</td>
                        <td>".Vehicule::findTypeVehicule($vehicule->getId_vehicule())."</td>
                        <td><a href='/here_we_go/monCompte/modifier_mon_vehicule/".$vehicule->getId_vehicule_utilisateur()."'>Modifier</a></td>
                    </tr> 
                ";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <a href="/here_we_go/monCompte/ajout_vehicule">Ajouter un vehicule</a>
                </td>
            </tr>
        </tfoot>
    </table>
    <h2>Liste des evenements créé et qui ne sont pas encore passé :</h2>
    <a href="?controller=utilisateurs&action=telechargerTousCSV" >Telecharger le CSV de tous les Evenements créé</a>
    <section class="my-5">
        <div class="row g-3">
            <?php foreach ($eventsUpcoming as $event) {?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card position-relative h-100" style="width: 20rem;">
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
    
    
    
    
    
    <h2>Liste des evenements créé et qui se sont deja passé:</h2>
    
    
    <section class="my-5">
        <div class="row g-3">
            <?php foreach ($events as $event) {?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card position-relative h-100" style="width: 20rem;">
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
        
        
        
        
        <h2>Liste des Evenements auxquel je suis inscrit </h2>
        
        
        <section class="my-5">
        <div class="row g-3">
            <?php foreach ($listEventsRegistered as $event) {?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card position-relative h-100" style="width: 20rem;">
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
            
            
            <h2>Covoiturage que je propose :</h2>
            <table>
                <tr>
                    <th>Evenenement</th>
                    <th>Date</th>
                    <th>Heure de depart</th>
                    <th>Lieu de depart</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($covoits as $covoit) { ?>
                    <tr>
                        <td><?php echo Evenement::find($covoit->getIdEvent())->getTitre(); ?></td>
                        <td><?php echo Evenement::find($covoit->getIdEvent())->getDateEvent(); ?></td>
                        <td><?php echo $covoit->getHeureDepart(); ?></td>
                        <td><?php echo $covoit->getLieuDepart(); ?></td>
                        <td><a href="/here_we_go/monCompte/modifier_mon_covoiturage/<?php echo $covoit->getIdCovoiturage(); ?>">Voir</a></td>
                    </tr>
                    <?php } ?>
                </table>
                
                <h2>Covoiturage auxquels je suis inscrit :</h2>
                <table>
                    <tr>
                        <th>Evenenement</th>
                        <th>Date</th>
                        <th>Heure de depart</th>
                        <th>Lieu de depart</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($covoitsInscrit as $covoit) { ?>
                        <tr>
                            <td><?php echo Evenement::find($covoit->getIdEvent())->getTitre(); ?></td>
                            <td><?php echo Evenement::find($covoit->getIdEvent())->getDateEvent(); ?></td>
                            <td><?php echo $covoit->getHeureDepart(); ?></td>
                            <td><?php echo $covoit->getLieuDepart(); ?></td>
                            <td><a href="/here_we_go/covoiturage/<?php echo $covoit->getIdCovoiturage(); ?>">Voir</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    
</div>