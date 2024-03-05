<?php
    class Categorie {

        private $id_categorie;
        private $libelle_categorie;
        private $couleur;

        public function __construct($id_categorie, $libelle_categorie, $couleur) {
            $this->id_categorie = $id_categorie;
            $this->libelle_categorie = $libelle_categorie;
            $this->couleur = $couleur;
        }

        public function getIdCategorie() {
            return $this->id_categorie;
        }
        
        public function setIdCategorie($id_categorie) {
            $this->id_categorie = $id_categorie;
        }
        
        public function getLibelleCategorie() {
            return $this->libelle_categorie;
        }
        
        public function setLibelleCategorie($libelle_categorie) {
            $this->libelle_categorie = $libelle_categorie;
        }
        
        public function getCouleur() {
            return $this->couleur;
        }
        
        public function setCouleur($couleur) {
            $this->couleur = $couleur;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();
            $req = $db->query('SELECT * FROM categorie ORDER BY libelle_categorie ASC');
      
            foreach($req->fetchAll() as $categories) {
              $list[] = new Categorie($categories['id_categorie'], $categories['libelle_categorie'], $categories['couleur']);
            }
      
            return $list;
          }

          public static function find($id_categorie) {
            $db = Db::getInstance();
            $req = $db->prepare('SELECT * FROM categorie WHERE id_categorie = :id_categorie');
            $req->bindParam(":id_categorie", $id_categorie, PDO::PARAM_INT);
            $req->execute();
            $categorie = $req->fetch();
        
            if (!$categorie) {
                throw new Exception('La catégorie demandée n\'existe pas.');
            }
        
            return new Categorie($categorie["id_categorie"], $categorie["libelle_categorie"], $categorie["couleur"]);
        }
        
        public static function update($id_categorie, $libelle_categorie, $couleur) {
            $db = Db::getInstance();
            $req = $db->prepare('UPDATE categorie SET libelle_categorie = :libelle_categorie, couleur = :couleur WHERE id_categorie = :id_categorie');
            $req->bindParam(":id_categorie", $id_categorie, PDO::PARAM_INT);
            $req->bindParam(":libelle_categorie", $libelle_categorie, PDO::PARAM_STR);
            $req->bindParam(":couleur", $couleur, PDO::PARAM_STR);
            $result = $req->execute();
        
            if (!$result) {
                throw new Exception('La mise à jour de la catégorie a échoué.');
            }
        }
        
        public static function add($libelle_categorie, $couleur) {
            $db = Db::getInstance();
            $req = $db->prepare('INSERT INTO categorie(libelle_categorie, couleur) VALUES (:libelle_categorie, :couleur)');
            $req->bindParam(":libelle_categorie", $libelle_categorie, PDO::PARAM_STR);
            $req->bindParam(":couleur", $couleur, PDO::PARAM_STR);
            $result = $req->execute();
        
            if (!$result) {
                throw new Exception('L\'ajout de la catégorie a échoué.');
            }
        }
        
        public static function findByEventId($id_event) {
            $db = Db::getInstance();
            $req = $db->prepare('SELECT c.* FROM categorie c INNER JOIN evenement e ON c.id_categorie = e.id_categorie WHERE e.id_event = :id_event');
            $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
            $req->execute();
            $categorie = $req->fetch();
        
            if (!$categorie) {
                throw new Exception('Aucune catégorie trouvée pour cet événement.');
            }
        
            return new Categorie($categorie["id_categorie"], $categorie["libelle_categorie"], $categorie["couleur"]);
        }
        
        
        
        
    }





?>