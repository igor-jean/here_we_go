<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {

      case 'pages':
        require_once('models/Covoiturage.php');
        require_once('models/Evenement.php');
        $controller = new PagesController();
      break;

      case 'utilisateurs':
        require_once('models/Utilisateur.php');
        $controller = new UsersController();
        break;
        
        case 'evenements':
          require_once('models/Utilisateur.php');
          require_once('models/Evenement.php');
          require_once('models/Categorie.php');
          require_once('models/Covoiturage.php');
          $controller = new EventsController();
          break;
          
          case 'admin':
            require_once('models/Categorie.php');
            require_once('models/Evenement.php');
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

  $controllers = array('pages' => ['home', 'error', 'connexion'],
                       'evenements' => ['newEvent', 'add', "showEvent", "inscriptionEvent", "desinscriptionEvent"],
                       'utilisateurs' => ['index', 'login', 'userConnexion', "register", "deconnexion", "monCompte"],
                       'vehicules' => ["findVehicule"],
                      "admin" => ["indexAdministration", "utilisateursAdministration", "evenementsAdministration", "categorieVehiculeAdministration", "validateAnEvent","validate", "updateAnEvent", "update", "delete", "confirmerSuppression", "voirCategorie", "updateCategorie", "ajouterCategorie", "addCategorie"],
                    "covoiturages" => ["showCovoiturage", "inscriptionCovoiturage", "desinscriptionCovoiturage", "addCovoiturage", "createCovoiturage"]);

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