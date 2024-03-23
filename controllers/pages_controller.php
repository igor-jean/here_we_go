<?php
  class PagesController {
    public function home() {
      try {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $perPage = isset($_GET['perPage']) ? intval($_GET['perPage']) : 9;
        $eventsData = Evenement::homePagination($page, $perPage);
        $eventsForPage = $eventsData['events'];
        $totalPages = $eventsData['totalPages'];
        $currentPage = $eventsData['currentPage'];
        require_once('views/pages/home.php');
      } catch(Exception $e) {
        echo "Erreur :".$e->getMessage();
    }
    }

    public function error() {
      require_once('views/pages/error.php');
    }
    
    public function categorie() {
      try {
        $id_categorie = $_GET["id_categorie"];
        $categorie = Categorie::find($id_categorie);
        $events = Evenement::findByCategoryId($id_categorie);
        require_once('views/pages/categorie.php');
      } catch(Exception $e) {
        echo "Erreur :".$e->getMessage();
    }

      }
  }
?>