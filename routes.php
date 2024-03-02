<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {

      case 'pages':
        require_once('models/PhotosEvenement.php');
        require_once('models/Covoiturage.php');
        require_once('models/Evenement.php');
        require_once('models/Categorie.php');
        $controller = new PagesController();
        break;
        
        case 'utilisateurs':
          require_once('models/Covoiturage.php');
          require_once('models/PhotosEvenement.php');
          require_once('models/TypeVehicule.php');
          require_once('models/Vehicule.php');
          require_once('models/Evenement.php');
          require_once('models/Utilisateur.php');
          require_once('models/Categorie.php');
          $controller = new UsersController();
          break;
          
          case 'evenements':
            require_once('models/PhotosEvenement.php');
            require_once('models/Vehicule.php');
            require_once('models/Utilisateur.php');
            require_once('models/Evenement.php');
            require_once('models/Categorie.php');
            require_once('models/Covoiturage.php');
            $controller = new EventsController();
            break;
          
          case 'admin':
            require_once('models/Utilisateur.php');
            require_once('models/Categorie.php');
            require_once('models/TypeVehicule.php');
            require_once('models/Evenement.php');
            require_once('models/Covoiturage.php');
            $controller = new AdminController();
            break;
            
            case 'vehicules':
              $controller = new VehiculesControllers();
              require_once "models/Vehicule.php";
              break;
              
              case 'covoiturages':
                $controller = new CovoituragesControllers();
                // require_once('models/Utilisateur.php');
                require_once "models/Vehicule.php";
                require_once "models/Covoiturage.php";
                break;

    }

    $controller->{ $action }();
  }

  $controllers = [
    'pages' => ['home', 'error', 'connexion', "categorie"],
    
    'evenements' => ['newEvent', 'add', "showEvent", "inscriptionEvent", "desinscriptionEvent", "monCompte", "update", "confirmerSuppression", "delete"],

    'utilisateurs' => ['index', 'login', 'userConnexion', "register", "deconnexion", "monCompte", "modifierInfosPerso", "updateInfosPerso", "avatarParDefaut",        "voirVehicule", "updateVehicule", "ajouterVehicule", "addVehicule", "deleteVehicule", "voirEvent", "ajoutPhoto", "addPhoto", "updatePhoto", "deletePhoto"],
    
    'vehicules' => ["findVehicule"],

    "admin" => ["indexAdministration", "utilisateursAdministration", "evenementsAdministration", "categorieVehiculeAdministration", "validateAnEvent","validate", "updateAnEvent", "update", "delete", "confirmerSuppression", "voirCategorie", "updateCategorie", "ajouterCategorie", "addCategorie", "voirTypeVehicule", "ajouterTypeVehicule", "updateTypeVehicule", "addTypeVehicule", "validateUser", "voirUser", "modifierUtilisateur", "supprimerUtilisateur", "deleteUser", "confirmationSupressionUtilisateur"],

    "covoiturages" => ["showCovoiturage", "inscriptionCovoiturage", "desinscriptionCovoiturage", "addCovoiturage", "createCovoiturage", "confirmationSuppression", "supprimerToutCovoit", "supprimerCovoitPerAdmin"]
  ];

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>