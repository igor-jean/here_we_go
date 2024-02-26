<?php
class TypeVehicule {
    private $id_vehicule;
    private $type;

    public function __construct($id_vehicule, $type) {
        $this->id_vehicule = $id_vehicule;
        $this->type = $type;
    }

    public function getIdVehicule() {
        return $this->id_vehicule;
    }

    public function getType()  {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM type_vehicule');
        foreach($req->fetchAll() as $vehicule) {
            $list[] = new TypeVehicule($vehicule['id_vehicule'], $vehicule['type']);
        }
        return $list;
    }

    public static function delete($id_vehicule) {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM type_vehicule WHERE id_vehicule = :id_vehicule');
        $req->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
        $req->execute();
    }

    public static function find($id_vehicule) {
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM type_vehicule WHERE id_vehicule = :id_vehicule');
        $req->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
        $req->execute();
        $vehicule = $req->fetch();
        return new TypeVehicule($vehicule['id_vehicule'], $vehicule['type']);
    }
    public static function update($id_vehicule, $type) {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE type_vehicule SET type = :type WHERE id_vehicule = :id_vehicule');
        $req->bindParam(':type', $type, PDO::PARAM_STR);
        $req->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
        $req->execute();
    }

    public static function add($type) {
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO type_vehicule (type) VALUES (:type)');
        $req->bindParam(':type', $type, PDO::PARAM_STR);
        $req->execute();
    }
    
}
?>
