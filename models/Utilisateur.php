<?php
    class Utilisateur {
        public $id_utilisateur;
        public $mail;
        public $mot_de_passe;
        public $nom;
        public $prenom;
        public $avatar;
        public $ville;
        public $telephone;
        public $role = 2;



        public function __construct($id_utilisateur, $mail, $mot_de_passe, $nom, $prenom, $avatar, $ville, $telephone, $role) {
            $this->id_utilisateur = $id_utilisateur;
            $this->mail = $mail;
            $this->mot_de_passe = $mot_de_passe;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->avatar = $avatar;
            $this->ville = $ville;
            $this->telephone = $telephone;
            $this->role = $role;
          }

//  cherche tous les utilisateurs
          public static function all() {
            $list = [];
            $db = Db::getInstance();
            $req = $db->query('SELECT * FROM utilisateur');
      
            foreach($req->fetchAll() as $users) {
              $list[] = new Utilisateur($users['id_utilisateur'], $users['mail'], $users['mot_de_passe'], $users['nom'], $users['prenom'], $users['avatar'], $users['ville'], $users['telephone'], $users['role']);
            }
      
            return $list;
          }
      
          public static function findUser($id_utilisateur) {
            $db = Db::getInstance();
            $id_article = intval($id_utilisateur);
            $req = $db->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur = :id_utilisateur');
            $req->execute(array('id_utilisateur' => $id_utilisateur));
            $user = $req->fetch();
            return new Utilisateur($user['id_utilisateur'], $user['mail'], $user['mot_de_passe'], $user['nom'], $user['prenom'], $user['avatar'], $user['ville'], $user['telephone'], $user['id_role']);
          }
      
          public static function addUser($mail, $mot_de_passe, $nom, $prenom, $ville, $telephone) {
            try {
                if(empty($mail) || empty($mot_de_passe) || empty($nom) || empty($ville)) {
                    throw new Exception("Remplir les champs vides");
                }
                $hashedPwd = password_hash($mot_de_passe, PASSWORD_BCRYPT);
                $db = Db::getInstance();
                $req = $db->prepare("INSERT INTO utilisateur (mail, mot_de_passe, nom, prenom, ville, telephone, id_role) VALUES (:mail, :mot_de_passe, :nom, :prenom, :ville, :telephone, :id_role)");
                $role = 2;
                $req->execute(array(
                    ":mail" => $mail,
                    ":mot_de_passe" => $hashedPwd,
                    ":nom" => $nom,
                    ":prenom" => $prenom,
                    ":ville" => $ville,
                    ":telephone" => $telephone,
                    ":id_role" => $role
                ));
                header("Location: ?controller=pages&action=connexion");
            } catch (Exception $e) {
                echo "Une erreur s'est produite : ".$e->getMessage()."<br>Redirection automatique...";
                header("Location: ?controller=pages&action=home");
            }
        }
        
      
          public static function updateUser($id_article, $mail, $description, $date) {
            $db = Db::getInstance();
            $req = $db->prepare("UPDATE Utilisateur SET mail = :mail, mot_de_passe = :mot_de_passe, nom = :nom, prenom = :prenom, avatar = :avatar, ville = :ville, telephone = :telephone, role = :role, nb_places = :nb_places, prix = :prix, lien_billeterie = :lien_billeterie, lien_event = :lien_event, nom_structure = :nom_structure, nb_visiteur = :nb_visiteur, code_unique_label = :code_unique_label WHERE id_utilisateur = :id_utilisateur");
            $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            $req->bindParam(":mail", $mail, PDO::PARAM_STR);
            $req->bindParam(":mot_de_passe", $mot_de_passe, PDO::PARAM_STR);
            $req->bindParam(":nom", $nom, PDO::PARAM_STR);
            $req->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $req->bindParam(":avatar", $avatar, PDO::PARAM_STR);
            $req->bindParam(":ville", $ville, PDO::PARAM_INT);
            $req->bindParam(":telephone", $telephone, PDO::PARAM_STR);
            $req->bindParam(":role", $role, PDO::PARAM_STR);
            $req->bindParam(":nb_places", $nb_places, PDO::PARAM_INT);
            $req->bindParam(":prix", $prix, PDO::PARAM_STR);
            $req->bindParam(":lien_billeterie", $lien_billeterie, PDO::PARAM_STR);
            $req->bindParam(":lien_event", $lien_event, PDO::PARAM_STR);
            $req->bindParam(":nom_structure", $nom_structure, PDO::PARAM_STR);
            $req->bindParam(":nb_visiteur", $nb_visiteur, PDO::PARAM_INT);
            $req->bindParam(":code_unique_label", $code_unique_label, PDO::PARAM_STR);
            $req->execute();
            header("Location: ?controller=articles&action=index");
        }
        
        public static function deleteUser($id_article) {
                $db = Db::getInstance();
                $req = $db->prepare("DELETE FROM articles WHERE id_utilisateur = :id_utilisateur");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
                header("Location: ?controller=articles&action=index");
        }
        
        public static function userConnexion($mail, $pwd) {
                $db = Db::getInstance();
                $req = $db->prepare("SELECT utilisateur.*, role.id_role FROM utilisateur JOIN role ON role.id_role = utilisateur.id_role WHERE mail = :mail");
                $req->bindParam(":mail", $mail);
                $req->execute();
                $reponse = $req ->fetch(PDO::FETCH_ASSOC);
                if(password_verify($pwd, $reponse["mot_de_passe"]) && $reponse["id_role"] == 1) {
                        session_start();
                        $_SESSION["login"] = "admin";
                        $_SESSION["id_utilisateur"] = $reponse["id_utilisateur"];
                        header("Location: ?controller=pages&action=home");
                }elseif(password_verify($pwd, $reponse["mot_de_passe"]) && $reponse["id_role"] == 2) {
                        session_start();
                        $_SESSION["login"] = "user";
                        $_SESSION["id_utilisateur"] = $reponse["id_utilisateur"];
                        header("Location: ?controller=pages&action=home");
                }else {
                        $_SESSION["error"] = "Mail ou mot de passe incorrect.";
                        header("Location: ?controller=pages&action=home");
                }
        }
        
        public static function verifyRegistrationEvent($id_utilisateur, $id_event) {
                $db = Db::getInstance();
                $req = $db->prepare("SELECT * FROM inscription_utilisateur_event WHERE id_utilisateur = :id_utilisateur AND id_event = :id_event");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
                $req->execute();
                $count = $req->rowCount();
                return $count > 0;
        }
        
        public static function registrationEvent($id_utilisateur, $id_event) {
                $db = Db::getInstance();
                $req = $db->prepare("INSERT INTO inscription_utilisateur_event (id_utilisateur, id_event, date_inscription_event) VALUES (:id_utilisateur, :id_event, CURDATE())");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
                $req->execute();
        }

        public static function unsubscribeEvent($id_utilisateur, $id_event) {
                $db = Db::getInstance();
                $req = $db->prepare("DELETE FROM inscription_utilisateur_event WHERE id_utilisateur = :id_utilisateur AND id_event = :id_event");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->bindParam(":id_event", $id_event, PDO::PARAM_STR);
                $req->execute();
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

        public function getMail()
        {
                return $this->mail;
        }

        public function setMail($mail)
        {
                $this->mail = $mail;

                return $this;
        }

        public function getMot_de_passe()
        {
                return $this->mot_de_passe;
        }
        public function setMot_de_passe($mot_de_passe)
        {
                $this->mot_de_passe = $mot_de_passe;

                return $this;
        }
        public function getNom()
        {
                return $this->nom;
        }

        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }
 
        public function getPrenom()
        {
                return $this->prenom;
        }

        public function setPrenom($prenom)
        {
                $this->prenom = $prenom;

                return $this;
        }
        public function getAvatar()
        {
                return $this->avatar;
        }

        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

        public function getVille()
        {
                return $this->ville;
        }

        public function setVille($ville)
        {
                $this->ville = $ville;

                return $this;
        }

        public function getTelephone()
        {
                return $this->telephone;
        }
        public function setTelephone($telephone)
        {
                $this->telephone = $telephone;

                return $this;
        }
        public function getRole()
        {
                return $this->role;
        }
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }
    }













?>