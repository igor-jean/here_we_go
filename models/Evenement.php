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
    public $id_utilisateur;
    public $id_categorie;


    public function __construct($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $nb_visiteur, $code_unique_label, $id_utilisateur, $id_categorie) {
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
      $this->id_utilisateur = $id_utilisateur;
      $this->id_categorie = $id_categorie;

    }
    // AFFICHER TOUS LES EVENEMENTS
    public static function all() {
        try {
            $list = [];
            $db = Db::getInstance();
            $req = $db->query('SELECT * FROM evenement WHERE inscrit = 1 ORDER BY date_event ASC');

            foreach($req->fetchAll() as $events) {
                $list[] = new Evenement($events['id_event'], $events['titre'], $events['date_event'], $events['heure_event'], $events['ville'], $events['adresse'], $events['code_postal'], $events['description_courte'], $events['description_longue'], $events['nb_places'], $events['prix'], $events['lien_billeterie'], $events['lien_event'], $events['nom_structure'], $events['nb_visiteur'], $events['code_unique_label'], $events['id_utilisateur'], $events['id_categorie']);
            }

            return $list;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de tous les événements : " . $e->getMessage());
        }
    }
    // AFFICHER LES EVENEMENT QUI NE SONT PAS ENCORE PASSE
    public static function allFuturEvent() {
        try {
            $list = [];
            $db = Db::getInstance();
            $currentDate = date('Y-m-d');
            $req = $db->query("SELECT * FROM evenement WHERE inscrit = 1 AND date_event >= '$currentDate' ORDER BY date_event ASC");
    
            foreach($req->fetchAll() as $events) {
                $list[] = new Evenement($events['id_event'], $events['titre'], $events['date_event'], $events['heure_event'], $events['ville'], $events['adresse'], $events['code_postal'], $events['description_courte'], $events['description_longue'], $events['nb_places'], $events['prix'], $events['lien_billeterie'], $events['lien_event'], $events['nom_structure'], $events['nb_visiteur'], $events['code_unique_label'], $events['id_utilisateur'], $events['id_categorie']);
            }
    
            return $list;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des événements à venir : " . $e->getMessage());
        }
    }
    
// AFFICHER LES EVENEMENTS ET FAIRE UNE PAGINATION 5/10/15
    public static function allForPagination($page = 1, $perPage = 5) {
        try {
            $list = [];
            $db = Db::getInstance();

            // Calculer le décalage pour la pagination
            $offset = ($page - 1) * $perPage;

            // Sélectionner le nombre total d'événements
            $countQuery = $db->query('SELECT COUNT(*) AS total FROM evenement');
            $totalEvents = $countQuery->fetchColumn();

            // Calculer le nombre total de pages
            $totalPages = ceil($totalEvents / $perPage);

            // Sélectionner les événements pour la page donnée
            $req = $db->prepare('SELECT * FROM evenement WHERE inscrit = 1 ORDER BY date_event ASC LIMIT :perPage OFFSET :offset ');
            $req->bindValue(':perPage', $perPage, PDO::PARAM_INT);
            $req->bindValue(':offset', $offset, PDO::PARAM_INT);
            $req->execute();

            foreach($req->fetchAll() as $event) {
                $list[] = new Evenement($event['id_event'], $event['titre'], $event['date_event'], $event['heure_event'], $event['ville'], $event['adresse'], $event['code_postal'], $event['description_courte'], $event['description_longue'], $event['nb_places'], $event['prix'], $event['lien_billeterie'], $event['lien_event'], $event['nom_structure'], $event['nb_visiteur'], $event['code_unique_label'], $event['id_utilisateur'], $event['id_categorie']);
            }

            return [
                'events' => $list,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ];
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des événements pour la pagination : " . $e->getMessage());
        }
    }




// trouver un evenement par son id
public static function find($id_event) {
    $db = Db::getInstance();
    $req = $db->prepare('SELECT * FROM evenement WHERE id_event = :id_event');
    $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
    $req->execute();
    $event = $req->fetch();
    if (!$event) {
        throw new Exception('Une erreure s\'est produite.');
    }
    return new Evenement($event['id_event'], $event['titre'], $event['date_event'], $event['heure_event'], $event['ville'], $event['adresse'], $event['code_postal'], $event['description_courte'], $event['description_longue'], $event['nb_places'], $event['prix'], $event['lien_billeterie'], $event['lien_event'], $event['nom_structure'], $event['nb_visiteur'], $event['code_unique_label'], $event['id_utilisateur'], $event['id_categorie']);
  }
// trouver les evenement créé par l'utilisateur 
    public static function findAllperUser($id_user) {
      $db = Db::getInstance();
      $list = [];
      $req = $db->prepare('SELECT * FROM evenement WHERE id_utilisateur = :id_utilisateur');
      $req->bindParam(":id_utilisateur", $id_user, PDO::PARAM_STR);
      $req->execute();
      $events = $req->fetchAll();
      if (!$events) {
        throw new Exception('Une erreure s\'est produite.');
    }
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
// trouver les evenement créé par l'utilisateur qui se sont deja passé et les trier tu plus recent au plus eloigné
    public static function findPastEvents($id_user) {
        $db = Db::getInstance();
        $list = [];
        // Sélectionner les événements de l'utilisateur qui se sont déjà déroulés, triés par date dans l'ordre décroissant
        $req = $db->prepare('SELECT * FROM evenement WHERE id_utilisateur = :id_utilisateur AND date_event < CURDATE() ORDER BY date_event ASC');
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
    
// trouver les evenement créé par l'utilisateur qui ne sont pas encore passé et les trier tu plus proche au plus eloigné
    public static function findUpcomingEvents($id_user) {
        $db = Db::getInstance();
        $list = [];
        // Sélectionner les événements de l'utilisateur qui n'ont pas encore eu lieu, triés par date
        $req = $db->prepare('SELECT * FROM evenement WHERE id_utilisateur = :id_utilisateur AND date_event >= CURDATE() ORDER BY date_event ASC');
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
    
  // trouver les evenements auquels l'utilisateur est inscrit 
    public static function listEventsRegistered($id_user) {
        $db = Db::getInstance();
    $list = [];
    $currentDate = date("Y-m-d"); // Date actuelle

    $req = $db->prepare("SELECT evenement.*, inscription_utilisateur_event.id_event FROM evenement 
                         INNER JOIN inscription_utilisateur_event 
                         ON evenement.id_event = inscription_utilisateur_event.id_event 
                         WHERE inscription_utilisateur_event.id_utilisateur = :id_utilisateur 
                         AND evenement.date_event >= :current_date 
                         ORDER BY evenement.date_event ASC");

    $req->bindParam(":id_utilisateur", $id_user, PDO::PARAM_STR);
    $req->bindParam(":current_date", $currentDate, PDO::PARAM_STR);
    $req->execute();
    $events = $req->fetchAll();
    if (!$events) {
        throw new Exception('Une erreure s\'est produite.');
    }

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


// créer un evenement 
    public static function addEvents($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $id_utilisateur, $id_categorie) {
        $db = Db::getInstance();
        $dateNow = date("Y-m-d");
        $inscrit = 0;
        $departement = substr($code_postal, 0, 2);
        $code_unique_label = self::checkAndGenerateUniqueLabel($departement);

        $req = $db->prepare("INSERT INTO evenement (id_event, titre, date_event, heure_event, ville, adresse, code_postal, description_courte, description_longue, nb_places, prix, lien_billeterie, lien_event, nom_structure, code_unique_label, id_utilisateur, id_categorie, date_ajout, inscrit) VALUES (:id_event, :titre, :date_event, :heure_event, :ville, :adresse, :code_postal, :description_courte, :description_longue, :nb_places, :prix, :lien_billeterie, :lien_event, :nom_structure, :code_unique_label, :id_utilisateur, :id_categorie, :date_ajout, :inscrit)");
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
        $req->bindParam(":code_unique_label", $code_unique_label, PDO::PARAM_STR);
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->bindParam(":id_categorie", $id_categorie, PDO::PARAM_INT);
        $req->bindParam(":date_ajout", $dateNow, PDO::PARAM_STR);
        $req->bindParam(":inscrit", $inscrit, PDO::PARAM_INT);
        
        // Exécuter la requête et vérifier si elle s'est bien déroulée
        if (!$req->execute()) {
            throw new Exception('Une erreur s\'est produite lors de l\'ajout de l\'événement.');
        }
    }
      
    
    public static function generateRandomId() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $db = Db::getInstance();
    
        // Générer un identifiant aléatoire de 7 caractères
        for ($i = 0; $i < 7; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        // Vérifier si l'identifiant généré existe déjà dans la table des événements
        do {
            $id_event = $randomString;
            $req_check = $db->prepare("SELECT id_event FROM evenement WHERE id_event = :id_event");
            $req_check->bindParam(":id_event", $id_event);
            $req_check->execute();
            $exists = $req_check->fetch();
        } while ($exists);
    
        return $id_event;
    }
    // Generer le code unique label
    public static function generateUniqueLabel($departement) {
        // Récupérer l'année en cours
        $annee = date("Y");
        
        // Obtenir les deux derniers chiffres de l'année
        $anneeDerniersChiffres = substr($annee, -2);
        
        // Générer 5 caractères aléatoires comprenant des chiffres et des lettres
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        
        // Formater le code avec le "-" et le numéro de département
        $codeUnique = $randomString . "-" . $anneeDerniersChiffres . $departement;
        
        return $codeUnique;
    }
    //Verifier si le code existe deja et en créer un nouveau s'il existe deja
    public static function checkAndGenerateUniqueLabel($codePostal) {
        do {
            // Générer un nouveau code unique label
            $codeUnique = self::generateUniqueLabel($codePostal);
            
            // Vérifier s'il existe déjà dans la base de données
            if (!self::isUniqueLabelExists($codeUnique)) {
                // Le code unique n'existe pas encore, donc on peut le retourner
                return $codeUnique;
            }
            // Si le code unique existe déjà, on recommence la boucle pour en générer un nouveau
        } while (true);
    }
    //Verifie si le code est dans la base
    private static function isUniqueLabelExists($codeUnique) {
        // Requête pour vérifier si le code unique existe déjà dans la base de données
        $db = Db::getInstance();
        $req = $db->prepare('SELECT COUNT(*) FROM evenement WHERE code_unique_label = :codeUnique');
        $req->bindParam(':codeUnique', $codeUnique);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
        $count = $req->fetchColumn();
        
        // Retourne vrai si le code unique existe déjà, sinon faux
        return $count > 0;
    }
    
    
    
// Modifier un evenement 
    public static function updateEvent($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $id_categorie) {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE evenement SET titre = :titre, date_event = :date_event, heure_event = :heure_event, ville = :ville, adresse = :adresse, code_postal = :code_postal, description_courte = :description_courte, description_longue = :description_longue, nb_places = :nb_places, prix = :prix, lien_billeterie = :lien_billeterie, lien_event = :lien_event, nom_structure = :nom_structure, inscrit = 0 WHERE id_event = :id_event");
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
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
    }
    // Supprimer un evenement 
    public static function deleteEvent($id_event) {
        $db = Db::getInstance();
        
        // Supprimer les entrées correspondantes dans inscription_utilisateur_event
        $req1 = $db->prepare("DELETE FROM inscription_utilisateur_event WHERE id_event = :id_event");
        $req1->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req1->execute();

        // Supprimer les photos 
        $req2 = $db->prepare("DELETE FROM photos_evenement WHERE id_event = :id_event");
        $req2->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req2->execute();

        // Exécuter la première requête de suppression
        if (!$req1->execute()) {
            throw new Exception('Une erreur s\'est produite lors de la suppression des inscriptions à l\'événement.');
        }
        
        // Ensuite, supprimer l'événement de la table evenement
        $req3 = $db->prepare("DELETE FROM evenement WHERE id_event = :id_event");
        $req3->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req3->execute();
    }
    
    
    
    
    // fonction pour afficher le nombre de demande d'ajout d'evenement pour les admins 
    
    public static function requestToAddEvent() {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT COUNT(*) AS demandes FROM evenement WHERE inscrit = 0 ");
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
        $pendingEvents = $req->fetchColumn();
        return $pendingEvents;
    }
// FONCTION POUR AFFICHER LA LISTE DES EVENEMENTS A VALIDER
    public static function displayListValidate() {
        $db = Db::getInstance();
        $list = [];
        $req = $db->prepare("SELECT * FROM evenement WHERE inscrit = 0 ORDER BY date_event ASC");
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
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


    public static function createCSV($datas, $filename = "evenement.csv", $delimiter = ";") {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
    
        // Nettoyer le tampon de sortie
        ob_end_clean();
    
        $file = fopen('php://output', 'w');
    
    
        // Écrire les données dans le fichier CSV
        foreach ($datas as $data) {
            fputcsv($file, $data, $delimiter);
        }
    
        fclose($file);
    
        // Flusher le tampon de sortie
        ob_flush();
    
        // Utiliser exit pour éviter toute sortie inattendue après
        exit();
    }

    // Valider l'événement
    public static function validateEvent($id_event) {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE evenement SET inscrit = 1 WHERE id_event = :id_event");
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
    }

    public static function findByCategoryId($id_categorie) {
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM evenement WHERE id_categorie = :id_categorie');
        $req->bindParam(":id_categorie", $id_categorie, PDO::PARAM_INT);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
        $events = $req->fetchAll(); 
    
        $list = [];
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
    //Rechercher un evenement par un mot clé
    public static function searchEventKeyword($keyword){ 
        $db = Db::getInstance(); 
        $req = $db->prepare('SELECT * FROM evenement WHERE titre like :keyword OR description_courte like :keyword OR description_longue like :keyword OR nom_structure like :keyword OR date_event like :keyword'); 
        $req->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $req->execute();
        $events = $req->fetchAll(); 
        $list = [];
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

    public function getId_utilisateur() {
        return $this->id_utilisateur;
    }


    public function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }

    public function getCode_unique_label() {
        return $this->code_unique_label;
    }

    /**
     * Get the value of id_categorie
     */ 
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */ 
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }
  }
?>