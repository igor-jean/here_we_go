<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {

      case 'pages':
        require_once('models/Evenement.php');
        $controller = new PagesController();
      break;

      case 'utilisateurs':
        require_once('models/Utilisateur.php');
        $controller = new UsersController();
        break;
        
      case 'evenements':
        require_once('models/Evenement.php');
        require_once('models/Categorie.php');
        $controller = new EventsController();
        break;
          
      case 'admin':
        $controller = new AdminController();
        break;
        
      case 'vehicules':
        $controller = new VehiculesControllers();
        require_once "models/Vehicule.php";
        break;

    }

    $controller->{ $action }();
  }

  $controllers = array('pages' => ['home', 'error', 'connexion'],
                       'evenements' => ['newEvent', 'add'],
                       'utilisateurs' => ['index', 'login', 'userConnexion', "register", "deconnexion", "monCompte"],
                       'vehicules' => ["findVehicule"]);

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