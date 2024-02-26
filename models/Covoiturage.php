<?php
class Covoiturage {
    private $id_covoiturage;
    private $montant_par_pers;
    private $information_de_contact;
    private $lieu_depart;
    private $descriptif;
    private $nb_place;
    private $heure_depart;
    private $id_vehicule_utilisateur;
    private $id_event;

    public function __construct($id_covoiturage, $montant_par_pers, $information_de_contact, $lieu_depart, $descriptif, $nb_place, $heure_depart, $id_vehicule_utilisateur, $id_event) {
        $this->id_covoiturage = $id_covoiturage;
        $this->montant_par_pers = $montant_par_pers;
        $this->information_de_contact = $information_de_contact;
        $this->lieu_depart = $lieu_depart;
        $this->descriptif = $descriptif;
        $this->nb_place = $nb_place;
        $this->heure_depart = $heure_depart;
        $this->id_vehicule_utilisateur = $id_vehicule_utilisateur;
        $this->id_event = $id_event;
    }
    // Ajouter un covoiturage
    public static function add($montant_par_pers, $information_de_contact, $lieu_depart, $descriptif, $nb_place, $heure_depart, $id_vehicule_utilisateur, $id_event) {
        $db = Db::getInstance();
        $req = $db->prepare("INSERT INTO covoiturage (montant_par_pers, information_de_contact, lieu_depart, descriptif, nb_place, heure_depart, id_vehicule_utilisateur, id_event) 
            VALUES (:montant_par_pers, :information_de_contact, :lieu_depart, :descriptif, :nb_place, :heure_depart, :id_vehicule_utilisateur, :id_event)");
        $req->bindParam(":montant_par_pers", $montant_par_pers);
        $req->bindParam(":information_de_contact", $information_de_contact);
        $req->bindParam(":lieu_depart", $lieu_depart);
        $req->bindParam(":descriptif", $descriptif);
        $req->bindParam(":nb_place", $nb_place);
        $req->bindParam(":heure_depart", $heure_depart);
        $req->bindParam(":id_vehicule_utilisateur", $id_vehicule_utilisateur);
        $req->bindParam(":id_event", $id_event);
        $req->execute();
        
    }
    
    // Afficher les covoiturage pour un evenement
    public static function getCovoituragesByEventId($id_event) {
        $db = Db::getInstance();
        $req = $db->prepare("
            SELECT c.*, u.prenom AS prenom_conducteur
            FROM covoiturage c 
            JOIN vehicule_utilisateur vu ON c.id_vehicule_utilisateur = vu.id_vehicule_utilisateur 
            JOIN utilisateur u ON vu.id_utilisateur = u.id_utilisateur 
            WHERE c.id_event = :id_event
        ");
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();
    
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        $covoiturages = [];
    
        foreach ($result as $row) {
            // Instanciation de l'objet Covoiturage
            $covoiturage = new Covoiturage(
                $row['id_covoiturage'],
                $row['montant_par_pers'],
                $row['information_de_contact'],
                $row['lieu_depart'],
                $row['descriptif'],
                $row['nb_place'],
                $row['heure_depart'],
                $row['id_vehicule_utilisateur'],
                $row['id_event']
            );
    
            // Ajout du nom du conducteur à l'objet Covoiturage
            $covoiturage->prenom_conducteur = $row['prenom_conducteur'];
    
            // Ajout de l'objet Covoiturage à la liste des covoiturages
            $covoiturages[] = $covoiturage;
        }
    
        return $covoiturages;
    }
    
    

    //Afficher un covoiturage 
    public static function find($id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM covoiturage WHERE id_covoiturage = :id_covoiturage");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->execute();
    
        $row = $req->fetch(PDO::FETCH_ASSOC);
    
        // Si aucun résultat trouvé, renvoie null
        if (!$row) {
            return null;
        }
    
        // Crée un objet Covoiturage avec les données récupérées
        return new Covoiturage(
            $row['id_covoiturage'],
            $row['montant_par_pers'],
            $row['information_de_contact'],
            $row['lieu_depart'],
            $row['descriptif'],
            $row['nb_place'],
            $row['heure_depart'],
            $row['id_vehicule_utilisateur'],
            $row['id_event']
        );
    }

    // afficher la ou les voiture d'un conducteur de covoiturage 
    public static function getVoituresByCovoiturageId($id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT vehicule_utilisateur.* FROM vehicule_utilisateur INNER JOIN covoiturage ON vehicule_utilisateur.id_vehicule_utilisateur = covoiturage.id_vehicule_utilisateur WHERE covoiturage.id_covoiturage = :id_covoiturage;");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->execute();
        
        $row = $req->fetch(PDO::FETCH_ASSOC) ;
        
        if (!$row) {
            return null;
        }
        
        return  new Vehicule(
            $row['id_vehicule_utilisateur'], 
            $row['libelle_vehicule'], 
            $row['imatriculation'], 
            $row['nb_places'], 
            $row["id_vehicule"], 
            $row["id_utilisateur"]
        );
    }
    // afficher le prenom du conducteur 
    public static function getNomConducteur($id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT utilisateur.prenom FROM utilisateur INNER JOIN vehicule_utilisateur ON utilisateur.id_utilisateur = vehicule_utilisateur.id_utilisateur INNER JOIN covoiturage ON vehicule_utilisateur.id_vehicule_utilisateur = covoiturage.id_vehicule_utilisateur WHERE covoiturage.id_covoiturage = :id_covoiturage ");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC) ;
        return $row["prenom"];
    }
    // s'inscrire a un covoit
    public static function registrationCovoiturage($id_covoiturage, $id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("INSERT INTO inscription_utilisateur_covoiturage (id_utilisateur, id_covoiturage, date_inscription_covoiturage) 
        VALUES (:id_utilisateur, :id_covoiturage, CURDATE());");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->execute();
    }
    // se desinscrire d'un covoit
    public static function unsubscribeCovoiturage($id_covoiturage, $id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("DELETE FROM inscription_utilisateur_covoiturage WHERE id_utilisateur = :id_utilisateur AND id_covoiturage = :id_covoiturage");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->execute();
    }
    // verifier si l'utilisateur est inscrit au covoiturage
    public static function verificationInscriptionCovoit($id_utilisateur, $id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM inscription_utilisateur_covoiturage WHERE id_utilisateur = :id_utilisateur AND id_covoiturage = :id_covoiturage");
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->execute();
        $count = $req->rowCount();
        return $count > 0;
    }
    // Getters
    public function getIdCovoiturage() {
        return $this->id_covoiturage;
    }

    public function getMontantParPers() {
        return $this->montant_par_pers;
    }

    public function getInformationDeContact() {
        return $this->information_de_contact;
    }

    public function getLieuDepart() {
        return $this->lieu_depart;
    }

    public function getDescriptif() {
        return $this->descriptif;
    }

    public function getNbPlace() {
        return $this->nb_place;
    }

    public function getHeureDepart() {
        return $this->heure_depart;
    }

    public function getIdVehiculeUtilisateur() {
        return $this->id_vehicule_utilisateur;
    }

    public function getIdEvent() {
        return $this->id_event;
    }

    // Setters
    public function setMontantParPers($montant_par_pers) {
        $this->montant_par_pers = $montant_par_pers;
    }

    public function setInformationDeContact($information_de_contact) {
        $this->information_de_contact = $information_de_contact;
    }

    public function setLieuDepart($lieu_depart) {
        $this->lieu_depart = $lieu_depart;
    }

    public function setDescriptif($descriptif) {
        $this->descriptif = $descriptif;
    }

    public function setNbPlace($nb_place) {
        $this->nb_place = $nb_place;
    }

    public function setHeureDepart($heure_depart) {
        $this->heure_depart = $heure_depart;
    }

    public function setIdVehiculeUtilisateur($id_vehicule_utilisateur) {
        $this->id_vehicule_utilisateur = $id_vehicule_utilisateur;
    }

    public function setIdEvent($id_event) {
        $this->id_event = $id_event;
    }
}
