<?php
  class EventsController {
    public function index() {
      $events = Evenement::all();
      require_once('views/pages/home.php');
    }


    public function newEvent() {
      $categories = Categorie::all();
      require_once('views/evenements/newEvent.php');
    }

    public function showEvent() {
      $id_utilisateur = isset($_SESSION["id_utilisateur"])?$_SESSION["id_utilisateur"]:"";;
      $id_event = $_GET["id_event"];
      $event = Evenement::find($id_event);
      $result = Utilisateur::verifyRegistrationEvent($id_utilisateur, $id_event);
      $covoits = Covoiturage::getCovoituragesByEventId($id_event);
      $checkIfOnlyOne = Covoiturage::checkIfOnlyOne($id_utilisateur, $id_event);
      $id_covoit = Covoiturage::findCovoiturageId($id_utilisateur, $id_event);
      $vehicule = Vehicule::utilisateurPossedeVehicule($id_utilisateur);
      require_once('views/evenements/showEvent.php');
    }
    
    public function add() {
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
      $id_utilisateur = $_SESSION["id_utilisateur"];
      $id_categorie = $_POST["id_categorie"];
      $id_event = Evenement::generateRandomId();
      
      Evenement::addEvents($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $id_utilisateur, $id_categorie);
      Utilisateur::registrationEvent($id_utilisateur, $id_event);
      header("Location: ?controller=utilisateurs&action=monCompte");
    }
    public function inscriptionEvent() {
      $id_utilisateur = $_SESSION["id_utilisateur"];
      $id_event = $_GET["id_event"];
      Utilisateur::registrationEvent($id_utilisateur, $id_event);
      $this->showEvent();
    }

    public function desinscriptionEvent() {
      $id_utilisateur = $_SESSION["id_utilisateur"];
      $id_event = $_GET["id_event"];
      Utilisateur::unsubscribeEvent($id_utilisateur, $id_event);
      $this->showEvent();
    }

    public function update() {
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
      
      Evenement::updateEvent($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $id_categorie);
      header("Location: ?controller=utilisateurs&action=monCompte");
    }
    public function delete() {
      $id_event = $_GET["id_event"];
      Evenement::deleteEvent($id_event);
      header("Location: ?controller=utilisateurs&action=monCompte");
    }
  
    public function confirmerSuppression() {
        $id_event = $_GET["id_event"];
        require_once('views/evenements/confirmerSuppression.php');
    }

  }
?>