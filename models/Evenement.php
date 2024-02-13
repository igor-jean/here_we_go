<?php
  class Evenement {
    public $id_event;
    public $titre;
    public $date_event;
    public $heure_event;
    public $ville;
    public $adresse;
    public $code_postal;
    public $description_courte;
    public $description_longue;
    public $nb_places;
    public $prix;
    public $lien_billeterie;
    public $lien_event;
    public $nom_structure;
    public $nb_visiteur;
    public $code_unique_label;



    public function __construct($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $nb_visiteur, $code_unique_label) {
      $this->id_event = $id_event;
      $this->titre = $titre;
      $this->date_event = $date_event;
      $this->heure_event = $heure_event;
      $this->ville = $ville;
      $this->adresse = $adresse;
      $this->code_postal = $code_postal;
      $this->description_courte = $description_courte;
      $this->description_longue = $description_longue;
      $this->nb_places = $nb_places;
      $this->prix = $prix;
      $this->lien_billeterie = $lien_billeterie;
      $this->lien_event = $lien_event;
      $this->nom_structure = $nom_structure;
      $this->nb_visiteur = $nb_visiteur;
      $this->code_unique_label = $code_unique_label;

    }
    
    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM evenement');

      foreach($req->fetchAll() as $events) {
        $list[] = new Evenement($events['id_event'], $events['titre'], $events['date_event'], $events['heure_event'], $events['ville'], $events['adresse'], $events['code_postal'], $events['description_courte'], $events['description_longue'], $events['nb_places'], $events['prix'], $events['lien_billeterie'], $events['lien_event'], $events['nom_structure'], $events['nb_visiteur'], $events['code_unique_label']);
      }

      return $list;
    }

    public static function find($id_event) {
      $db = Db::getInstance();
      $id_article = intval($id_event);
      $req = $db->prepare('SELECT * FROM evenement WHERE id_event = :id_event');
      $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
      $req->execute();
      $post = $req->fetch();
      return new Evenement($events['id_event'], $events['titre'], $events['date_event'], $events['heure_event'], $events['ville'], $events['adresse'], $events['code_postal'], $events['description_courte'], $events['description_longue'], $events['nb_places'], $events['prix'], $events['lien_billeterie'], $events['lien_event'], $events['nom_structure'], $events['nb_visiteur'], $events['code_unique_label']);
    }

    public static function findAllperUser($id_user) {
      $db = Db::getInstance();
      $list = [];
      $req = $db->prepare('SELECT * FROM evenement WHERE id_utilisateur = :id_utilisateur');
      $req->bindParam(":id_utilisateur", $id_user, PDO::PARAM_STR);
      $req->execute();
      $events = $req->fetchAll();
      foreach ($events as $event) {
          $list[] = new Evenement(
              $event['id_event'],
              $event['titre'],
              $event['date_event'],
              $event['heure_event'],
              $event['ville'],
              $event['adresse'],
              $event['code_postal'],
              $event['description_courte'],
              $event['description_longue'],
              $event['nb_places'],
              $event['prix'],
              $event['lien_billeterie'],
              $event['lien_event'],
              $event['nom_structure'],
              $event['nb_visiteur'],
              $event['code_unique_label'],
              $event['id_utilisateur'],
              $event['id_categorie']
          );
      }
      return $list;
    }
  
    public static function listEventsRegistered($id_user) {
        $db = Db::getInstance();
        $list = [];
        $req = $db->prepare("SELECT evenement.*, inscription_utilisateur_event.id_event FROM evenement INNER JOIN inscription_utilisateur_event ON evenement.id_event = inscription_utilisateur_event.id_event WHERE inscription_utilisateur_event.id_utilisateur = :id_utilisateur;
        ");
        $req->bindParam(":id_utilisateur", $id_user, PDO::PARAM_STR);
        $req->execute();
        $events = $req->fetchAll();
        foreach ($events as $event) {
          $list[] = new Evenement(
              $event['id_event'],
              $event['titre'],
              $event['date_event'],
              $event['heure_event'],
              $event['ville'],
              $event['adresse'],
              $event['code_postal'],
              $event['description_courte'],
              $event['description_longue'],
              $event['nb_places'],
              $event['prix'],
              $event['lien_billeterie'],
              $event['lien_event'],
              $event['nom_structure'],
              $event['nb_visiteur'],
              $event['code_unique_label'],
              $event['id_utilisateur'],
              $event['id_categorie']
          );
      }
      return $list;

    }



    public static function addEvents($titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $nb_visiteur, $code_unique_label, $id_utilisateur, $id_categorie) {

      
      $db = Db::getInstance();
      $id_event = null;
        
        do {
            $id_event = Evenement::generateRandomId(); 
            $req_check = $db->prepare("SELECT id_event FROM evenement WHERE id_event = :id_event");
            $req_check->bindParam(":id_event", $id_event);
            $req_check->execute();
            $exists = $req_check->fetch();
        } while ($exists); 


      $req = $db->prepare("INSERT INTO evenement (id_event, titre, date_event, heure_event, ville, adresse, code_postal, description_courte, description_longue, nb_places, prix, lien_billeterie, lien_event, nom_structure, nb_visiteur, code_unique_label, id_utilisateur, id_categorie) VALUES (:id_event, :titre, :date_event, :heure_event, :ville, :adresse, :code_postal, :description_courte, :description_longue, :nb_places, :prix, :lien_billeterie, :lien_event, :nom_structure, :nb_visiteur, :code_unique_label, :id_utilisateur, :id_categorie)");
      $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
      $req->bindParam(":titre", $titre, PDO::PARAM_STR);
      $req->bindParam(":date_event", $date_event, PDO::PARAM_STR);
      $req->bindParam(":heure_event", $heure_event, PDO::PARAM_STR);
      $req->bindParam(":ville", $ville, PDO::PARAM_STR);
      $req->bindParam(":adresse", $adresse, PDO::PARAM_STR);
      $req->bindParam(":code_postal", $code_postal, PDO::PARAM_INT);
      $req->bindParam(":description_courte", $description_courte, PDO::PARAM_STR);
      $req->bindParam(":description_longue", $description_longue, PDO::PARAM_STR);
      $req->bindParam(":nb_places", $nb_places, PDO::PARAM_INT);
      $req->bindParam(":prix", $prix, PDO::PARAM_STR);
      $req->bindParam(":lien_billeterie", $lien_billeterie, PDO::PARAM_STR);
      $req->bindParam(":lien_event", $lien_event, PDO::PARAM_STR);
      $req->bindParam(":nom_structure", $nom_structure, PDO::PARAM_STR);
      $req->bindParam(":nb_visiteur", $nb_visiteur, PDO::PARAM_INT);
      $req->bindParam(":code_unique_label", $code_unique_label, PDO::PARAM_STR);
      $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
      $req->bindParam(":id_categorie", $id_categorie, PDO::PARAM_INT);
      $req->execute();
      header("Location: ?controller=utilisateurs&action=monCompte");
      
    } 
    
    public static function generateRandomId() {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
  
      for ($i = 0; $i < 7; $i++) {
          $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
  
      return $randomString;
  }

    
    public static function updateEvent($id_article, $titre, $description, $date) {
      $db = Db::getInstance();
      $req = $db->prepare("UPDATE evenement SET titre = :titre, date_event = :date_event, heure_event = :heure_event, ville = :ville, adresse = :adresse, code_postal = :code_postal, description_courte = :description_courte, description_longue = :description_longue, nb_places = :nb_places, prix = :prix, lien_billeterie = :lien_billeterie, lien_event = :lien_event, nom_structure = :nom_structure, nb_visiteur = :nb_visiteur, code_unique_label = :code_unique_label WHERE id_event = :id_event");
      $req->bindParam(":id_event", $id_event, PDO::PARAM_INT);
      $req->bindParam(":titre", $titre, PDO::PARAM_STR);
        $req->bindParam(":date_event", $date_event, PDO::PARAM_STR);
        $req->bindParam(":heure_event", $heure_event, PDO::PARAM_STR);
        $req->bindParam(":ville", $ville, PDO::PARAM_STR);
        $req->bindParam(":adresse", $adresse, PDO::PARAM_STR);
        $req->bindParam(":code_postal", $code_postal, PDO::PARAM_INT);
        $req->bindParam(":description_courte", $description_courte, PDO::PARAM_STR);
        $req->bindParam(":description_longue", $description_longue, PDO::PARAM_STR);
        $req->bindParam(":nb_places", $nb_places, PDO::PARAM_INT);
        $req->bindParam(":prix", $prix, PDO::PARAM_STR);
        $req->bindParam(":lien_billeterie", $lien_billeterie, PDO::PARAM_STR);
        $req->bindParam(":lien_event", $lien_event, PDO::PARAM_STR);
        $req->bindParam(":nom_structure", $nom_structure, PDO::PARAM_STR);
        $req->bindParam(":nb_visiteur", $nb_visiteur, PDO::PARAM_INT);
        $req->bindParam(":code_unique_label", $code_unique_label, PDO::PARAM_STR);
      $req->execute();
      header("Location: ?controller=evenements&action=index");
    }

    public static function deleteEvent($id_article) {
      $db = Db::getInstance();
      $req = $db->prepare("DELETE FROM articles WHERE id_event = :id_event");
      $req->bindParam(":id_event", $id_event, PDO::PARAM_INT);
      $req->execute();
      header("Location: ?controller=evenements&action=index");
    }



        // Getters
        public function getIdEvent() {
          return $this->id_event;
      }
  
      public function getTitre() {
          return $this->titre;
      }
  
      public function getDateEvent() {
          return $this->date_event;
      }
  
      public function getHeureEvent() {
          return $this->heure_event;
      }
  
      public function getVille() {
          return $this->ville;
      }
  
      public function getAdresse() {
          return $this->adresse;
      }
  
      public function getCodePostal() {
          return $this->code_postal;
      }
  
      public function getDescriptionCourte() {
          return $this->description_courte;
      }
  
      public function getDescriptionLongue() {
          return $this->description_longue;
      }
  
      public function getNbPlaces() {
          return $this->nb_places;
      }
  
      public function getPrix() {
          return $this->prix;
      }
  
      public function getLienBilleterie() {
          return $this->lien_billeterie;
      }
  
      public function getLienEvent() {
          return $this->lien_event;
      }
  
      public function getNomStructure() {
          return $this->nom_structure;
      }
  
      public function getNbVisiteur() {
          return $this->nb_visiteur;
      }
  
      public function getCodeUniqueLabel() {
          return $this->code_unique_label;
      }
  
      // Setters
      public function setIdEvent($id_event) {
          $this->id_event = $id_event;
      }
  
      public function setTitre($titre) {
          $this->titre = $titre;
      }
  
      public function setDateEvent($date_event) {
          $this->date_event = $date_event;
      }
  
      public function setHeureEvent($heure_event) {
          $this->heure_event = $heure_event;
      }
  
      public function setVille($ville) {
          $this->ville = $ville;
      }
  
      public function setAdresse($adresse) {
          $this->adresse = $adresse;
      }
  
      public function setCodePostal($code_postal) {
          $this->code_postal = $code_postal;
      }
  
      public function setDescriptionCourte($description_courte) {
          $this->description_courte = $description_courte;
      }
  
      public function setDescriptionLongue($description_longue) {
          $this->description_longue = $description_longue;
      }
  
      public function setNbPlaces($nb_places) {
          $this->nb_places = $nb_places;
      }
  
      public function setPrix($prix) {
          $this->prix = $prix;
      }
  
      public function setLienBilleterie($lien_billeterie) {
          $this->lien_billeterie = $lien_billeterie;
      }
  
      public function setLienEvent($lien_event) {
          $this->lien_event = $lien_event;
      }
  
      public function setNomStructure($nom_structure) {
          $this->nom_structure = $nom_structure;
      }
  
      public function setNbVisiteur($nb_visiteur) {
          $this->nb_visiteur = $nb_visiteur;
      }
  
      public function setCodeUniqueLabel($code_unique_label) {
          $this->code_unique_label = $code_unique_label;
      }
  }
?>