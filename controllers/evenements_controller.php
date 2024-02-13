<?php
  class EventsController {
    public function index() {
      $posts = Evenement::all();
      require_once('views/articles/index.php');
    }


    public function newEvent() {
      $categories = Categorie::all();
      require_once('views/evenements/newEvent.php');
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
      $nb_visiteur = $_POST["nb_visiteur"];
      $code_unique_label = $_POST["code_unique_label"];
      $id_utilisateur = $_SESSION["id_utilisateur"];
      $id_categorie = $_POST["id_categorie"];

      Evenement::addEvents($titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $nb_visiteur, $code_unique_label, $id_utilisateur, $id_categorie);
  }
  

  }
?>