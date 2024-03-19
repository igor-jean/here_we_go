<?php
  class UsersController {

    public function login() {
      try {
        if(empty($_POST["mail"]) || empty($_POST["pwd"])) {
          throw new Exception("Veuillez remplir tous les champs obligatoires.");
        }
        $mail = $_POST["mail"];
        $pwd = $_POST["pwd"];
        $error = Utilisateur::userConnexion($mail, $pwd);
        if ($error) {
          header("Location: ?controller=pages&action=home&error=$error");
          exit();
        } else {
          header("Location: ?controller=pages&action=home");
          exit();
        }
      } catch(Exception $e) {
        $errorMessage = urlencode($e->getMessage());
        header("Location: ?controller=pages&action=home&errorMessage=$errorMessage");
        exit();
      }
    }
    

    public function register() {
      try {
        $nom = $_POST["nom"];
        $ville = $_POST["ville"];
        $telephone = $_POST["telephone"];

        $requiredFields = ["mail", "confirmMail", "pwd", "confirmPwd", "prenom"];
        foreach ($requiredFields as $field) {
          if (empty($_POST[$field])) {
            throw new Exception("Veuillez remplir tous les champs obligatoires.");
          }
        }

        $mail = $_POST["mail"];
        $confirmMail = $_POST["confirmMail"];
        $pwd = $_POST["pwd"];
        $confirmPwd = $_POST["confirmPwd"];
        $prenom = $_POST["prenom"];
        Utilisateur::addUser($mail, $pwd, $nom, $prenom, $ville, $telephone);
        header("Location: ?controller=pages&action=home");
        exit();
      } catch(Exception $e) {
          $errorMessage = urlencode($e->getMessage());
          header("Location: ?controller=pages&action=home&error=$errorMessage");
          exit();
            }
      }
  

    public function deconnexion() {
      session_start();
      session_unset();
      session_destroy();
      header("Location: /here_we_go/accueil");
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
        $premium = Utilisateur::premiumAccount($id_utilisateur);
        require_once('views/utilisateurs/monCompte.php');

    }
    
    public function modifierInfosPerso() {
        $id_utilisateur = $_SESSION["id_utilisateur"];
        $user = Utilisateur::find($id_utilisateur);
        require_once('views/utilisateurs/modifierInfosPerso.php');
    }

    public function updateInfosPerso() {
      try {
        $nom = $_POST["nom"];
        $ville = $_POST["ville"];
        $telephone = $_POST["telephone"];
        if(empty($_POST["mail"]) || empty($_POST["prenom"])) {
          throw new Exception("Veuillez remplir tous les champs obligatoires.");
        }

        $id_utilisateur = $_SESSION["id_utilisateur"];
        $mail = $_POST["mail"];
        $prenom = $_POST["prenom"];
        $avatar =isset($_FILES["avatar"])?$_FILES["avatar"]:"";
        Utilisateur::updateUserByUser($id_utilisateur, $mail, $nom, $prenom, $avatar, $ville, $telephone);
        header("Location: ?controller=utilisateurs&action=monCompte");
      } catch(Exception $e) {
          $errorMessage = urlencode($e->getMessage());
          header("Location: ?controller=utilisateurs&action=modifierInfosPerso&error=$errorMessage");
            }
    }

    public function voirEvent() {
      try {
        $id_event = $_GET["id_event"];
        $event = Evenement::find($id_event);
        $categories = Categorie::all();
        $categorieFinded = Categorie::find($event->getId_categorie());
        $covoits = Covoiturage::getCovoituragesPerEvent($id_event);
        require_once('views/utilisateurs/voirEvent.php');
      } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }

    public function avatarParDefaut() {
      try {
        $id_utilisateur = $_SESSION["id_utilisateur"];
        Utilisateur::avatarDefault($id_utilisateur);
        $this->monCompte();
      } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }
    public function voirVehicule() {
      try {
        $id_vehicule_utilisateur = $_GET["id_vehicule_utilisateur"];
        $types = TypeVehicule::all();
        $vehicule = Vehicule::find($id_vehicule_utilisateur);
        require_once('views/utilisateurs/voirVehicule.php');
      } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }
    public function updateVehicule() {
      try {
        $id_vehicule_utilisateur = $_POST["id_vehicule_utilisateur"];
        $libelle_vehicule = $_POST["libelle_vehicule"];
        $imatriculation = $_POST["imatriculation"];
        $nb_places = $_POST["nb_places"];
        $id_vehicule = $_POST["id_vehicule"];
        $champsRequis = ["id_vehicule_utilisateur", "libelle_vehicule", "imatriculationc", "nb_places", "id_vehicule"];
        foreach ($champsRequis as $value) {
          if(empty($_POST[$value])) {
            throw new Exception("Veuillez remplir tous les champs obligatoires.");
          }
        }
        Vehicule::update($id_vehicule_utilisateur, $libelle_vehicule, $imatriculation, $nb_places, $id_vehicule);
        $this->monCompte();
      } catch(Exception $e) {
          $errorMessage = urlencode($e->getMessage());
          header("Location: ?controller=utilisateurs&action=voirVehicule&id_vehicule_utilisateur=$id_vehicule_utilisateur&error=$errorMessage");
            }
    }
    
    public function ajouterVehicule() {
      $types = TypeVehicule::all();
      require_once('views/utilisateurs/ajouterVehicule.php');
    }

    public function addVehicule() {
      try {
        $libelle_vehicule = $_POST["libelle_vehicule"];
        $immatriculation = $_POST["immatriculation"];
        $nb_places = $_POST["nb_places"];
        $id_vehicule = $_POST["id_vehicule"];
        if(empty($_POST["immatriculation"]) || empty($_POST["nb_places"]) || empty($_POST["id_vehicule"])) {
          throw new Exception("Veuillez remplir les champs obligatoires.");
        }

        $id_utilisateur = $_SESSION["id_utilisateur"];
        Vehicule::add($libelle_vehicule, $immatriculation, $nb_places, $id_vehicule, $id_utilisateur);
        $this->monCompte();
        } catch(Exception $e) {
            $errorMessage = urlencode($e->getMessage());
            header("Location: ?controller=utilisateurs&action=ajouterVehicule&error=$errorMessage");
            }
    }
    
    public function deleteVehicule() {
      try {
        $id_vehicule_utilisateur = $_GET["id_vehicule_utilisateur"];
        Vehicule::delete($id_vehicule_utilisateur);
        $this->monCompte();
      } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }

    public function ajoutPhoto() { 
      try {
        $id_event = $_GET["id_event"];
        $dejaPresent = PhotosEvenement::checkIfPhotoExistsForEvent($id_event);
        $photoActuelle = PhotosEvenement::findByIdEvent($id_event);
        require_once('views/utilisateurs/ajoutPhoto.php');
      }     catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }   
    }

    public function addPhoto() { 
      try {
        $id_event = $_POST["id_event"];
        $chemin = $_FILES["chemin"];
        PhotosEvenement::add($chemin, $id_event);
        $this->monCompte();
      }     catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }   
    }
    public function updatePhoto() {
      try {
        $id_event = $_POST["id_event"];
        $chemin = $_FILES["chemin"];
        PhotosEvenement::update($id_event, $chemin);
        $this->monCompte();
      }     catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }    
    }

    public function deletePhoto() { 
      try {
        $id_event = $_GET["id_event"];
        PhotosEvenement::delete($id_event);
        $this->monCompte();
      }     catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }   
    }

    public function telechargerSimpleCSV() {
      try {
        $id_event = $_GET["id_event"];
        $event = Evenement::find($id_event);
        $datas = [
            ["titre","date", "heure_event", "ville", "adresse", "code_postal", "description_courte", "description_longue", "nb_places", "prix", "lien_billeterie", "lien_event", "nom_structure", "nb_visiteur", "code_unique_label"],
            [$event->getTitre(), $event->getDateEvent(), $event->getHeureEvent(), $event->getVille(), $event->getAdresse(), $event->getCodePostal(), $event->getDescriptionCourte(), $event->getDescriptionLongue(), $event->getNbPlaces(), $event->getPrix(), $event->getLienBilleterie(), $event->getLienEvent(), $event->getNomStructure(), $event->getNbVisiteur()]
        ];
    
        Evenement::createCSV($datas);
      } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
    }

    public function telechargerTousCSV() {
      try {
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
      } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
  }
  
  public function premiumAccount() {
    $id_utilisateur = $_SESSION["id_utilisateur"];
    $events = Evenement::allFuturEvent();
    $villeUtilisateur = Utilisateur::findVille($id_utilisateur);
    require_once('views/utilisateurs/premiumAccount.php');
  }
    
  }
?>