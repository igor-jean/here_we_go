<?php
  class PagesController {
    public function home() {
      $events = Evenement::all();
      require_once('views/pages/home.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }

    public function connexion() {
      require_once('views/pages/connexion.php');
    }
    
    public function categorie() {
      $id_categorie = $_GET["id_categorie"];
      $categorie = Categorie::find($id_categorie);
      $events = Evenement::findByCategoryId($id_categorie);
      require_once('views/pages/categorie.php');
    }
  }
?>