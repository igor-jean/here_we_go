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
            $req = $db->query('SELECT * FROM categorie');
      
            foreach($req->fetchAll() as $categories) {
              $list[] = new Categorie($categories['id_categorie'], $categories['libelle_categorie'], $categories['couleur']);
            }
      
            return $list;
          }
    }





?>