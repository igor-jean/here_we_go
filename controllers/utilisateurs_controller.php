<?php
  class UsersController {

    public function login() {
      $mail = $_POST["mail"];
      $pwd = $_POST["pwd"];

      Utilisateur::userConnexion($mail, $pwd);
      header("Location: ?controller=pages&action=home");
    }

    public function register() {
      $mail = $_POST["mail"];
      $confirmMail = $_POST["confirmMail"];
      $pwd = $_POST["pwd"];
      $confirmPwd = $_POST["confirmPwd"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $ville = $_POST["ville"];
      $telephone = $_POST["telephone"];
      if(!empty($mail) && !empty($pwd) && !empty($prenom) && $mail === $confirmMail && $pwd === $confirmPwd) {
        Utilisateur::addUser($mail, $pwd, $nom, $prenom, $ville, $telephone);
      }
  
    }

    public function deconnexion() {
      session_start();
      session_unset();
      session_destroy();
      header("Location: ?controller=pages&action=home");
    }

    public function monCompte() {
      $id_utilisateur = intval($_SESSION["id_utilisateur"]);
      $user = Utilisateur::find($id_utilisateur);
      $vehicules = Vehicule::findVehicule($id_utilisateur);
      $events = Evenement::findPastEvents($id_utilisateur);
      $eventsUpcoming = Evenement::findUpcomingEvents($id_utilisateur);
      $listEventsRegistered = Evenement::listEventsRegistered($id_utilisateur);
      $covoits = Covoiturage::getCovoituragesFutursUtilisateur($id_utilisateur);
      $covoitsInscrit = Covoiturage::getCovoituragesInscritUtilisateur($id_utilisateur);
      require_once('views/utilisateurs/monCompte.php');
    }
    
    public function modifierInfosPerso() {
      $id_utilisateur = $_SESSION["id_utilisateur"];
      $user = Utilisateur::find($id_utilisateur);
      require_once('views/utilisateurs/modifierInfosPerso.php');
    }

    public function updateInfosPerso() {
      $id_utilisateur = $_SESSION["id_utilisateur"];
      $mail = $_POST["mail"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $ville = $_POST["ville"];
      $telephone = $_POST["telephone"];
      $avatar =isset($_FILES["avatar"])?$_FILES["avatar"]:"";
      Utilisateur::updateUserByUser($id_utilisateur, $mail, $nom, $prenom, $avatar, $ville, $telephone);
      header("Location: ?controller=utilisateurs&action=monCompte");
    }

    public function voirEvent() {
      $id_event = $_GET["id_event"];
      $event = Evenement::find($id_event);
      $categories = Categorie::all();
      $categorieFinded = Categorie::find($event->getId_categorie());
      $covoits = Covoiturage::getCovoituragesPerEvent($id_event);
      require_once('views/utilisateurs/voirEvent.php');
    }

    public function avatarParDefaut() {
      $id_utilisateur = $_SESSION["id_utilisateur"];
      Utilisateur::avatarDefault($id_utilisateur);
      $this->monCompte();
    }
    public function voirVehicule() {
      $id_vehicule_utilisateur = $_GET["id_vehicule_utilisateur"];
      $types = TypeVehicule::all();
      $vehicule = Vehicule::find($id_vehicule_utilisateur);
      require_once('views/utilisateurs/voirVehicule.php');
    }
    public function updateVehicule() {
      $id_vehicule_utilisateur = $_POST["id_vehicule_utilisateur"];
      $libelle_vehicule = $_POST["libelle_vehicule"];
      $imatriculation = $_POST["imatriculation"];
      $nb_places = $_POST["nb_places"];
      $id_vehicule = $_POST["id_vehicule"];
      Vehicule::update($id_vehicule_utilisateur, $libelle_vehicule, $imatriculation, $nb_places, $id_vehicule);
      $this->monCompte();
    }
    
    public function ajouterVehicule() {
      $types = TypeVehicule::all();
      require_once('views/utilisateurs/ajouterVehicule.php');
    }

    public function addVehicule() {
      $libelle_vehicule = $_POST["libelle_vehicule"];
      $immatriculation = $_POST["immatriculation"];
      $nb_places = $_POST["nb_places"];
      $id_vehicule = $_POST["id_vehicule"];
      $id_utilisateur = $_SESSION["id_utilisateur"];
      Vehicule::add($libelle_vehicule, $immatriculation, $nb_places, $id_vehicule, $id_utilisateur);
      $this->monCompte();
    }
    
    public function deleteVehicule() {
      $id_vehicule_utilisateur = $_GET["id_vehicule_utilisateur"];
      Vehicule::delete($id_vehicule_utilisateur);
      $this->monCompte();
    }

    public function ajoutPhoto() {        
      $id_event = $_GET["id_event"];
      $dejaPresent = PhotosEvenement::checkIfPhotoExistsForEvent($id_event);
      $photoActuelle = PhotosEvenement::findByIdEvent($id_event);
      require_once('views/utilisateurs/ajoutPhoto.php');
    }

    public function addPhoto() {        
      $id_event = $_POST["id_event"];
      $chemin = $_FILES["chemin"];
      PhotosEvenement::add($chemin, $id_event);
      $this->monCompte();
    }
    public function updatePhoto() {        
      $id_event = $_POST["id_event"];
      $chemin = $_FILES["chemin"];
      PhotosEvenement::update($id_event, $chemin);
      $this->monCompte();
    }

    public function deletePhoto() {        
      $id_event = $_GET["id_event"];
      PhotosEvenement::delete($id_event);
      $this->monCompte();
    }

    public function telechargerSimpleCSV() {
      $id_event = $_GET["id_event"];
      $event = Evenement::find($id_event);
      $datas = [
          ["titre","date", "heure_event", "ville", "adresse", "code_postal", "description_courte", "description_longue", "nb_places", "prix", "lien_billeterie", "lien_event", "nom_structure", "nb_visiteur", "code_unique_label"],
          [$event->getTitre(), $event->getDateEvent(), $event->getHeureEvent(), $event->getVille(), $event->getAdresse(), $event->getCodePostal(), $event->getDescriptionCourte(), $event->getDescriptionLongue(), $event->getNbPlaces(), $event->getPrix(), $event->getLienBilleterie(), $event->getLienEvent(), $event->getNomStructure(), $event->getNbVisiteur()]
      ];
  
      Evenement::createCSV($datas);
    }

    public function telechargerTousCSV() {
      $id_user = $_SESSION["id_utilisateur"];
      $events = Evenement::findAllperUser($id_user);
      $filename = "tousLesEvenement.csv";
      // Initialiser le tableau de données avec le titre des colonnes
      $datas = [
          ["titre","date", "heure_event", "ville", "adresse", "code_postal", "description_courte", "description_longue", "nb_places", "prix", "lien_billeterie", "lien_event", "nom_structure", "nb_visiteur", "code_unique_label"]
      ];
  
      // Parcourir tous les événements récupérés
      foreach ($events as $event) {
          // Ajouter une nouvelle ligne pour chaque événement
          $datas[] = [
              $event->getTitre(), 
              $event->getDateEvent(), 
              $event->getHeureEvent(), 
              $event->getVille(), 
              $event->getAdresse(), 
              $event->getCodePostal(), 
              $event->getDescriptionCourte(), 
              $event->getDescriptionLongue(), 
              $event->getNbPlaces(), 
              $event->getPrix(), 
              $event->getLienBilleterie(), 
              $event->getLienEvent(), 
              $event->getNomStructure(), 
              $event->getNbVisiteur()
              // $event->getCodeUniqueLabel() // S'il est nécessaire d'ajouter cette valeur, assurez-vous de l'obtenir depuis la classe Evenement
          ];
      }
  
      // Créer le fichier CSV avec toutes les lignes d'événements
      Evenement::createCSV($datas, $filename);
  }
  
  
    
  }
?>