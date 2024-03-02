<?php

class PhotosEvenement {
    // Propriétés
    public $id_photo;
    public $chemin;
    public $id_event;

    // Constructeur
    public function __construct($id_photo, $chemin, $id_event) {
        $this->id_photo = $id_photo;
        $this->chemin = $chemin;
        $this->id_event = $id_event;
    }


    public function getIdPhoto() {
        return $this->id_photo;
    }

    public function getChemin() {
        return $this->chemin;
    }

    public function setChemin($chemin) {
        $this->chemin = $chemin;
    }

    public function getIdEvent() {
        return $this->id_event;
    }

    public function setIdEvent($id_event) {
        $this->id_event = $id_event;
    }
    
    public static function add($chemin, $id_event) {
        $bdd = Db::getInstance();
        $date = date("d-m-Y");
        $heure = date("s");
        if ($chemin === "") {
            $nameImage = "" ;
        } else {
            $nameImage=$heure."Sec-".$date."-".basename(filter_var($chemin['name'] , FILTER_SANITIZE_URL)) ;
        }
        if ($chemin !== "" && move_uploaded_file($chemin['tmp_name'], 'photo_evenement/' . $nameImage)) {
            $req = $bdd->prepare("INSERT INTO photos_evenement (chemin , id_event) VALUES (:chemin, :id_event)");
            $req->bindParam(":chemin", $nameImage, PDO::PARAM_STR);
            $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
            $req->execute();
        }
    }
    public static function addPhotoParDefault($id_event) {
        $bdd = Db::getInstance();
        $nameImage = "photoEvenementParDefaut.jpg";
        $req = $bdd->prepare("INSERT INTO photos_evenement (chemin , id_event) VALUES (:chemin, :id_event)");
        $req->bindParam(":chemin", $nameImage, PDO::PARAM_STR);
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();
    }



    public static function findByIdEvent($id_event) {
        $bdd = Db::getInstance();
        $req = $bdd->prepare("SELECT * FROM photos_evenement WHERE id_event = :id_event");
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id_event) {
        $bdd = Db::getInstance();
        $req = $bdd->prepare("DELETE FROM photos_evenement WHERE id_event = :id_event");
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();
    }
    
    public static function update($id_event, $chemin) {
        $bdd = Db::getInstance();
        
        if ($chemin === "") {
            return false;
        }
    
        $date = date("d-m-Y");
        $heure = date("s");
        $newName = $heure."Sec-".$date."-".basename(filter_var($chemin['name'], FILTER_SANITIZE_URL));
    
        if (move_uploaded_file($chemin['tmp_name'], 'photo_evenement/' . $newName)) {
            $req = $bdd->prepare("UPDATE photos_evenement SET chemin = :chemin WHERE id_event = :id_event");
            $req->bindParam(":chemin", $newName, PDO::PARAM_STR);
            $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
            $req->execute();
            return true;
        } else {
            return false;
        }
    }

    public static function checkIfPhotoExistsForEvent($id_event) {
        $bdd = Db::getInstance();
        
        $req = $bdd->prepare("SELECT COUNT(*) AS count FROM photos_evenement WHERE id_event = :id_event");
        $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }

}