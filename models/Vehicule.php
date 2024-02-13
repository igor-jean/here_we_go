<?php
    class Vehicule {
        public $id_vehicule_utilisateur;
        public $libelle_vehicule;
        public $immatriculation;
        public $nb_places;
        public $id_vehicule;
        public $id_utilisateur;
        
        
        public function __construct($id_vehicule_utilisateur, $libelle_vehicule, $immatriculation, $nb_places, $id_vehicule, $id_utilisateur) {
        $this->id_vehicule_utilisateur = $id_vehicule_utilisateur;
        $this->libelle_vehicule = $libelle_vehicule;
        $this->immatriculation = $immatriculation;
        $this->nb_places = $nb_places;
        $this->id_vehicule = $id_vehicule;
        $this->id_utilisateur = $id_utilisateur;
    }
//     FONCTION POUR TROUVER LES VEHICULES D4UN UTILISATEUR
    public static function findVehicule($id_utilisateur) {
        $db = Db::getInstance();
        $list = [];
        $req = $db->prepare('SELECT * FROM vehicule_utilisateur WHERE id_utilisateur = :id_utilisateur');
        $req->execute(array('id_utilisateur' => $id_utilisateur));
        foreach ($req->fetchAll() as $vehicule) {
            $list[] = new Vehicule($vehicule['id_vehicule_utilisateur'], $vehicule['libelle_vehicule'], $vehicule['imatriculation'], $vehicule['nb_places'], $vehicule['id_vehicule'], $vehicule['id_utilisateur']);
        }
        return $list;
      }
    
//       SETTER ET GETTER
        public function getId_vehicule_utilisateur()
        {
                return $this->id_vehicule_utilisateur;
        }

        public function setId_vehicule_utilisateur($id_vehicule_utilisateur)
        {
                $this->id_vehicule_utilisateur = $id_vehicule_utilisateur;

                return $this;
        }

        public function getLibelle_vehicule()
        {
                return $this->libelle_vehicule;
        }

        public function setLibelle_vehicule($libelle_vehicule)
        {
                $this->libelle_vehicule = $libelle_vehicule;

                return $this;
        }

        public function getImmatriculation()
        {
                return $this->immatriculation;
        }

        public function setImmatriculation($immatriculation)
        {
                $this->immatriculation = $immatriculation;

                return $this;
        }

        public function getNb_places()
        {
                return $this->nb_places;
        }

        public function setNb_places($nb_places)
        {
                $this->nb_places = $nb_places;

                return $this;
        }

        public function getId_vehicule()
        {
                return $this->id_vehicule;
        }

        public function setId_vehicule($id_vehicule)
        {
                $this->id_vehicule = $id_vehicule;

                return $this;
        }

        public function getId_utilisateur()
        {
                return $this->id_utilisateur;
        }

        public function setId_utilisateur($id_utilisateur)
        {
                $this->id_utilisateur = $id_utilisateur;

                return $this;
        }
}
    ?>