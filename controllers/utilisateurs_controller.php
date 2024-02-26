<?php
  class UsersController {

    public function login() {
      $mail = $_POST["mail"];
      $pwd = $_POST["pwd"];

      Utilisateur::userConnexion($mail, $pwd);
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
      $events = Evenement::findAllperUser($id_utilisateur);
      $listEventsRegistered = Evenement::listEventsRegistered($id_utilisateur);
      
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
      $this->monCompte();
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
  }
?>