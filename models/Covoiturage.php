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
        
        if (!$req->execute()) {
            throw new Exception('L\'ajout du covoiturage a échoué.');
        }
    }
    
    public static function update($id_covoiturage, $montant_par_pers, $information_de_contact, $lieu_depart, $descriptif, $nb_place, $heure_depart, $id_vehicule_utilisateur, $id_event) {
        $db = Db::getInstance();
        $req = $db->prepare( "UPDATE covoiturage SET montant_par_pers = :montant_par_pers, information_de_contact = :information_de_contact, lieu_depart = :lieu_depart, descriptif = :descriptif, nb_place = :nb_place, heure_depart = :heure_depart,  id_vehicule_utilisateur = :id_vehicule_utilisateur WHERE id_covoiturage = :id_covoiturage");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->bindParam(":montant_par_pers", $montant_par_pers, PDO::PARAM_INT);
        $req->bindParam(":information_de_contact", $information_de_contact, PDO::PARAM_STR);
        $req->bindParam(":lieu_depart", $lieu_depart, PDO::PARAM_STR);
        $req->bindParam(":descriptif", $descriptif, PDO::PARAM_STR);
        $req->bindParam(":nb_place", $nb_place, PDO::PARAM_INT);
        $req->bindParam(":heure_depart", $heure_depart, PDO::PARAM_STR);
        $req->bindParam(":id_vehicule_utilisateur", $id_vehicule_utilisateur, PDO::PARAM_INT);
        
        if (!$req->execute()) {
            throw new Exception('La mise à jour du covoiturage a échoué.');
        }
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
    // sélectionne les covoiturages futurs pour un utilisateur spécifié en fonction de la date actuelle
    public static function getCovoituragesFutursUtilisateur($id_utilisateur) {
        $list = [];
        $currentDate = date("Y-m-d");
        $db = Db::getInstance();
        $req = $db->prepare("SELECT covoiturage.* FROM covoiturage INNER JOIN evenement ON covoiturage.id_event = evenement.id_event INNER JOIN vehicule_utilisateur ON covoiturage.id_vehicule_utilisateur = vehicule_utilisateur.id_vehicule_utilisateur WHERE vehicule_utilisateur.id_utilisateur = :id_utilisateur AND evenement.date_event >= :current_date");
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_STR);
        $req->bindParam(":current_date", $currentDate, PDO::PARAM_STR);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Il y a une erreure.');
        }
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $resultat) {
            $covoiturage = new Covoiturage(
                $resultat['id_covoiturage'],
                $resultat['montant_par_pers'],
                $resultat['information_de_contact'],
                $resultat['lieu_depart'],
                $resultat['descriptif'],
                $resultat['nb_place'],
                $resultat['heure_depart'],
                $resultat['id_vehicule_utilisateur'],
                $resultat['id_event']
            );
            $list[] = $covoiturage;
        }
        return $list;
    }
    // Afficher les covoiturage auxquels je suis inscrit 
    public static function getCovoituragesInscritUtilisateur($id_utilisateur) {
        $list = [];
        $currentDate = date("Y-m-d");
        $db = Db::getInstance();
        $req = $db->prepare("SELECT covoiturage.* FROM covoiturage INNER JOIN inscription_utilisateur_covoiturage ON covoiturage.id_covoiturage = inscription_utilisateur_covoiturage.id_covoiturage INNER JOIN evenement ON covoiturage.id_event = evenement.id_event WHERE inscription_utilisateur_covoiturage.id_utilisateur = :id_utilisateur AND evenement.date_event >= :current_date");
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->bindParam(":current_date", $currentDate, PDO::PARAM_STR);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Il y a une erreur.');
        }
        foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $resultat) {
            $covoiturage = new Covoiturage(
                $resultat['id_covoiturage'],
                $resultat['montant_par_pers'],
                $resultat['information_de_contact'],
                $resultat['lieu_depart'],
                $resultat['descriptif'],
                $resultat['nb_place'],
                $resultat['heure_depart'],
                $resultat['id_vehicule_utilisateur'],
                $resultat['id_event']
            );
            $list[] = $covoiturage;
        }
        return $list;
    }
    
    //Afficher un covoiturage 
    public static function find($id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM covoiturage WHERE id_covoiturage = :id_covoiturage");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->execute();

        $row = $req->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new Exception('Aucun covoiturage trouvé avec cet identifiant.');
        }

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
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
    }
    // se desinscrire d'un covoit
    public static function unsubscribeCovoiturage($id_covoiturage, $id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("DELETE FROM inscription_utilisateur_covoiturage WHERE id_utilisateur = :id_utilisateur AND id_covoiturage = :id_covoiturage");
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
    }
    // verifier si l'utilisateur est inscrit au covoiturage
    public static function verificationInscriptionCovoit($id_utilisateur, $id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM inscription_utilisateur_covoiturage WHERE id_utilisateur = :id_utilisateur AND id_covoiturage = :id_covoiturage");
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->bindParam(":id_covoiturage", $id_covoiturage, PDO::PARAM_INT);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
        $count = $req->rowCount();
        return $count > 0;
    }
    // Verifier si l'utilisateur a deja proposer un covoiturage pour cet evenenement
    public static function checkIfOnlyOne($id_utilisateur, $id_event) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM covoiturage INNER JOIN vehicule_utilisateur ON covoiturage.id_vehicule_utilisateur = vehicule_utilisateur.id_vehicule_utilisateur WHERE vehicule_utilisateur.id_utilisateur = :id_utilisateur AND covoiturage.id_event = :id_event");
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
        $count = $req->rowCount();
        return $count > 0;
    }
    // Supprimer covoit et ses inscription
    public static function deleteCovoiturage($id_covoiturage) {
        // Supprimer les inscriptions associées au covoiturage
        $queryDeleteInscriptions = "DELETE FROM inscription_utilisateur_covoiturage WHERE id_covoiturage = :id_covoiturage";
        $stmtDeleteInscriptions = Db::getInstance()->prepare($queryDeleteInscriptions);
        $stmtDeleteInscriptions->bindParam(':id_covoiturage', $id_covoiturage);
        $stmtDeleteInscriptions->execute();
        if (!$stmtDeleteInscriptions->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
    
        // Supprimer le covoiturage lui-même
        $queryDeleteCovoiturage = "DELETE FROM covoiturage WHERE id_covoiturage = :id_covoiturage";
        $stmtDeleteCovoiturage = Db::getInstance()->prepare($queryDeleteCovoiturage);
        $stmtDeleteCovoiturage->bindParam(':id_covoiturage', $id_covoiturage);
        $stmtDeleteCovoiturage->execute();
        if (!$stmtDeleteCovoiturage->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
    }
    //Trouver l'id covoiturage avec l'id utilisateur et l'id event 
    public static function findCovoiturageId($id_utilisateur, $id_event) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT covoiturage.id_covoiturage FROM covoiturage INNER JOIN evenement ON covoiturage.id_event = evenement.id_event INNER JOIN vehicule_utilisateur ON covoiturage.id_vehicule_utilisateur = vehicule_utilisateur.id_vehicule_utilisateur WHERE vehicule_utilisateur.id_utilisateur = :id_utilisateur AND covoiturage.id_event = :id_event");
        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();
        
        $row = $req->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['id_covoiturage'];
        } else {
            return null;
        }
    }
    // Afficher les covoiturage d'un evenement
    public static function getCovoituragesPerEvent($id_event) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM covoiturage WHERE id_event = :id_event');
        $req->bindParam(':id_event', $id_event, PDO::PARAM_STR);
        $req->execute();
        if (!$req->execute()) {
            throw new Exception('Une erreure s\'est produite.');
        }
    
        foreach($req->fetchAll() as $covoiturage) {
            $list[] = new Covoiturage($covoiturage['id_covoiturage'], $covoiturage['montant_par_pers'], $covoiturage['information_de_contact'], $covoiturage['lieu_depart'], $covoiturage['descriptif'], $covoiturage['nb_place'], $covoiturage['heure_depart'], $covoiturage['id_vehicule_utilisateur'], $covoiturage['id_event']);
        }
    
        return $list;
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
