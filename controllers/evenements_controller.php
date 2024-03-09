<?php
  class EventsController {
    public function index() {
      try {
        $events = Evenement::all();
        require_once('views/pages/home.php');
      }  catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }


    public function newEvent() {
      try {
        $categories = Categorie::all();
        require_once('views/evenements/newEvent.php');
      }  catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }

    public function showEvent() {
      try {
        $id_utilisateur = isset($_SESSION["id_utilisateur"])?$_SESSION["id_utilisateur"]:"";
        $id_event = $_GET["id_event"];
        if(empty($_GET["id_event"])) {
          throw new Exception("Impossible d'afficher l'événement. Réessayez ultérieurement.");
        }
        $event = Evenement::find($id_event);
        $result = Utilisateur::verifyRegistrationEvent($id_utilisateur, $id_event);
        $covoits = Covoiturage::getCovoituragesByEventId($id_event);
        $checkIfOnlyOne = Covoiturage::checkIfOnlyOne($id_utilisateur, $id_event);
        $id_covoit = Covoiturage::findCovoiturageId($id_utilisateur, $id_event);
        $vehicule = Vehicule::utilisateurPossedeVehicule($id_utilisateur);
        require_once('views/evenements/showEvent.php');
      } catch(Exception $e) {
        $errorMessage = urlencode($e->getMessage());
        header("Location: ?controller=pages&action=home&error=$errorMessage");
    }
    }
    
    public function add() {
      try {
        $requiredFields = ["titre", "date_event", "heure_event", "ville", "adresse", "code_postal", "description_longue", "id_categorie"];
        foreach ($requiredFields as $field) {
          if (empty($_POST[$field])) {
            throw new Exception("Veuillez remplir tous les champs obligatoires.");
          }
        }
    
        $description_courte = $_POST["description_courte"];
        $nb_places = $_POST["nb_places"];
        $prix = $_POST["prix"];
        $lien_billeterie = $_POST["lien_billeterie"];
        $lien_event = $_POST["lien_event"];
        $nom_structure = $_POST["nom_structure"];
        $titre = $_POST["titre"];
        $date_event = $_POST["date_event"];
        $heure_event = $_POST["heure_event"];
        $ville = $_POST["ville"];
        $adresse = $_POST["adresse"];
        $code_postal = $_POST["code_postal"];
        $description_longue = $_POST["description_longue"];
        $id_utilisateur = $_SESSION["id_utilisateur"];
        $id_categorie = $_POST["id_categorie"];
    
        $id_event = Evenement::generateRandomId();
    
        // Ajout de l'événement
        Evenement::addEvents($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $id_utilisateur, $id_categorie);
    
        // Enregistrement de l'utilisateur à l'événement
        Utilisateur::registrationEvent($id_utilisateur, $id_event);
    
        // Ajout d'une photo par défaut pour l'événement
        PhotosEvenement::addPhotoParDefault($id_event);
    
        // Redirection vers la page du compte utilisateur
        header("Location: ?controller=utilisateurs&action=monCompte");
        exit(); // Assure que le script s'arrête ici après la redirection
      } catch(Exception $e) {
          // En cas d'erreur, redirection vers la page d'ajout d'événement avec un message d'erreur
          $errorMessage = urlencode($e->getMessage());
          header("Location: ?controller=evenements&action=newEvent&error=$errorMessage");
          exit();
      }
    }
    
    public function inscriptionEvent() {
      try {
        $id_utilisateur = $_SESSION["id_utilisateur"];
        $id_event = $_GET["id_event"];
        Utilisateur::registrationEvent($id_utilisateur, $id_event);
        $this->showEvent();
      }  catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }

    public function desinscriptionEvent() {
      try {
        $id_utilisateur = $_SESSION["id_utilisateur"];
        $id_event = $_GET["id_event"];
        Utilisateur::unsubscribeEvent($id_utilisateur, $id_event);
        $this->showEvent();
      }  catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }

    public function update() {
      try {
        $id_event = $_POST["id_event"];
        $titre = $_POST["titre"];
        $date_event = $_POST["date_event"];
        $heure_event = $_POST["heure_event"];
        $ville = $_POST["ville"];
        $adresse = $_POST["adresse"];
        $code_postal = $_POST["code_postal"];
        $description_courte = $_POST["description_courte"];
        $description_longue = $_POST["description_longue"];
        $nb_places = $_POST["nb_places"];
        $prix = $_POST["prix"];
        $lien_billeterie = $_POST["lien_billeterie"];
        $lien_event = $_POST["lien_event"];
        $nom_structure = $_POST["nom_structure"];
        $id_categorie = $_POST["id_categorie"];

        $champsRequis = ["id_event", "titre", "date_event", "heure_event", "ville", "adresse", "code_postal", "description_longue", "id_categorie"];
        foreach ($champsRequis as $value) {
          if(empty($_POST[$value])) {
            throw new Exception("Veuillez remplir les champs obligatoires.");
          }
        }
        Evenement::updateEvent($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $id_categorie);
        header("Location: ?controller=utilisateurs&action=monCompte");
      }  catch(Exception $e) {
                $errorMessage = urlencode($e->getMessage());
                header("Location: ?controller=utilisateurs&action=voirEvent&id_event=$id_event&error=$errorMessage");
            }
    }
    public function delete() {
      try {
        $id_event = $_GET["id_event"];
        Evenement::deleteEvent($id_event);
        header("Location: ?controller=utilisateurs&action=monCompte");
      }  catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }
  
    public function confirmerSuppression() {
      try {
        $id_event = $_GET["id_event"];
        require_once('views/evenements/confirmerSuppression.php');
      }  catch(Exception $e) {
        echo "Erreur :".$e->getMessage();
      }
    }
    
    public function resultsSearch() {
      if(isset($_POST["date"])) {
        $keyword = $_POST["date"];
      }elseif(isset($_POST["search"])) {
        $keyword = $_POST['search'];
      }
      $events = Evenement::searchEventKeyword($keyword);
      require_once('views/evenements/resultsSearch.php');
    }
      
   

  }
?>