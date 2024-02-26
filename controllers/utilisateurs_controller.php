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
      require_once('models/Vehicule.php');
      require_once('models/Evenement.php');
      
      $id_utilisateur = intval($_SESSION["id_utilisateur"]);
      $user = Utilisateur::find($id_utilisateur);
      $vehicules = Vehicule::findVehicule($id_utilisateur);
      $events = Evenement::findAllperUser($id_utilisateur);
      $listEventsRegistered = Evenement::listEventsRegistered($id_utilisateur);
      
      require_once('views/utilisateurs/monCompte.php');
    }

    
  }
?>