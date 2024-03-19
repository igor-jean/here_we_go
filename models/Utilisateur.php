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
              $list[] = new Utilisateur($users['id_utilisateur'], $users['mail'], $users['mot_de_passe'], $users['nom'], $users['prenom'], $users['avatar'], $users['ville'], $users['telephone'], $users['id_role']);
            }
      
            return $list;
          }
      
          public static function find($id_utilisateur) {
            $db = Db::getInstance();
            $id_article = intval($id_utilisateur);
            $req = $db->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur = :id_utilisateur');
            $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            $req->execute();
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
        
      
        public static function updateUser($id_utilisateur, $mail, $nom, $prenom, $avatar, $ville, $telephone, $role) {
                try {
                    $db = Db::getInstance();
                    $req = $db->prepare("UPDATE utilisateur SET mail = :mail, nom = :nom, prenom = :prenom, avatar = :avatar, ville = :ville, telephone = :telephone, id_role = :role WHERE id_utilisateur = :id_utilisateur");
                    $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                    $req->bindParam(":mail", $mail, PDO::PARAM_STR);
                    $req->bindParam(":nom", $nom, PDO::PARAM_STR);
                    $req->bindParam(":prenom", $prenom, PDO::PARAM_STR);
                    $req->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                    $req->bindParam(":ville", $ville, PDO::PARAM_STR);
                    $req->bindParam(":telephone", $telephone, PDO::PARAM_STR);
                    $req->bindParam(":role", $role, PDO::PARAM_INT);
                    $req->execute();
                    return true;
                } catch (Exception $e) {
                    echo "Une erreur s'est produite : ".$e->getMessage();
                    return false;
                }
            }
            public static function updateUserByUser($id_utilisateur, $mail, $nom, $prenom, $avatar, $ville, $telephone) {
                $db = Db::getInstance();
                $date = date("d-m-Y");
                $heure = date("s");
                
                // Vérifier si un fichier d'avatar est téléchargé
                if($avatar['name'] != "") {
                    $nameImage = $heure . "Sec-" . $date . "-" . basename(filter_var($avatar['name'], FILTER_SANITIZE_URL));
                    
                    // Déplacer le fichier téléchargé vers le répertoire de destination
                    if(move_uploaded_file($avatar['tmp_name'], 'imgUploaded/' . $nameImage)) {
                        try {
                            // Préparer et exécuter la requête SQL pour mettre à jour les informations de l'utilisateur avec le nouvel avatar
                            $req = $db->prepare("UPDATE utilisateur SET mail = :mail, nom = :nom, prenom = :prenom, avatar = :avatar, ville = :ville, telephone = :telephone WHERE id_utilisateur = :id_utilisateur");
                            $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                            $req->bindParam(":mail", $mail, PDO::PARAM_STR);
                            $req->bindParam(":nom", $nom, PDO::PARAM_STR);
                            $req->bindParam(":prenom", $prenom, PDO::PARAM_STR);
                            $req->bindParam(":avatar", $nameImage, PDO::PARAM_STR);
                            $req->bindParam(":ville", $ville, PDO::PARAM_STR);
                            $req->bindParam(":telephone", $telephone, PDO::PARAM_STR);
                            $req->execute();
                            
                            // Retourner true si la mise à jour a réussi
                            return true;
                        } catch (Exception $e) {
                            // Afficher un message d'erreur en cas d'échec de la mise à jour
                            echo "Une erreur s'est produite : " . $e->getMessage();
                            return false;
                        }
                    } else {
                        // En cas d'échec du déplacement du fichier, retourner false
                        return false;
                    }
                } else {
                    try {
                        // Préparer et exécuter la requête SQL pour mettre à jour les informations de l'utilisateur sans modifier l'avatar
                        $req = $db->prepare("UPDATE utilisateur SET mail = :mail, nom = :nom, prenom = :prenom, ville = :ville, telephone = :telephone WHERE id_utilisateur = :id_utilisateur");
                        $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
                        $req->bindParam(":nom", $nom, PDO::PARAM_STR);
                        $req->bindParam(":prenom", $prenom, PDO::PARAM_STR);
                        $req->bindParam(":ville", $ville, PDO::PARAM_STR);
                        $req->bindParam(":telephone", $telephone, PDO::PARAM_STR);
                        $req->execute();
                        
                        // Retourner true si la mise à jour a réussi
                        return true;
                    } catch (Exception $e) {
                        // Afficher un message d'erreur en cas d'échec de la mise à jour
                        echo "Une erreur s'est produite : " . $e->getMessage();
                        return false;
                    }
                }
            }
        
        public static function avatarDefault($id_utilisateur) {
                $db = Db::getInstance();
                $req = $db->prepare("UPDATE utilisateur SET avatar = 'avatar.png' WHERE id_utilisateur = :id_utilisateur");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
        }
            
            
            
            
        public static function delete($id_utilisateur) {
                $db = Db::getInstance();
                
                // Supprimer d'abord les enregistrements associés dans la table inscription_utilisateur_event
                $req = $db->prepare("DELETE FROM inscription_utilisateur_event WHERE id_event IN (SELECT id_event FROM evenement WHERE id_utilisateur = :id_utilisateur)");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
                
                // Ensuite, supprimer les enregistrements associés dans la table inscription_utilisateur_covoiturage
                $req = $db->prepare("DELETE FROM inscription_utilisateur_covoiturage WHERE id_utilisateur = :id_utilisateur");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
                
                // Enfin, supprimer l'utilisateur dans la table utilisateur
                $req = $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
            }
            
            
            public static function userConnexion($mail, $pwd) {
                $db = Db::getInstance();
                $req = $db->prepare("SELECT utilisateur.*, role.id_role FROM utilisateur JOIN role ON role.id_role = utilisateur.id_role WHERE mail = :mail");
                $req->bindParam(":mail", $mail);
                $req->execute();
                $reponse = $req->fetch(PDO::FETCH_ASSOC);
                
                try {
                        if(password_verify($pwd, $reponse["mot_de_passe"]) && $reponse["id_role"] == 1) {
                                $_SESSION["login"] = "admin";
                                $_SESSION["id_utilisateur"] = $reponse["id_utilisateur"];
                                
                        } elseif(password_verify($pwd, $reponse["mot_de_passe"]) && $reponse["id_role"] == 2) {
                                $_SESSION["login"] = "user";
                                $_SESSION["id_utilisateur"] = $reponse["id_utilisateur"];
                        } else {
                                throw new Exception("Le login ou le mot de passe est incorrecte.");
                        }

                } catch(Exception $e) {
                        $errorMessage = urlencode($e->getMessage());
                        return $errorMessage;
                        exit();
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
        
        public static function findUserForValidation() {
                $db = Db::getInstance();
                $list = [];
                $req = $db->prepare("SELECT * FROM utilisateur WHERE inscrit = 0 ORDER BY nom ASC");
                $req->execute();
                foreach($req->fetchAll() as $users) {
                        $list[] = new Utilisateur($users['id_utilisateur'], $users['mail'], $users['mot_de_passe'], $users['nom'], $users['prenom'], $users['avatar'], $users['ville'], $users['telephone'], $users['id_role']);
                }
                
                return $list;
        }
        
        public static function requestToValidate() {
                $db = Db::getInstance();
                $req = $db->prepare("SELECT COUNT(*) AS demandes FROM utilisateur WHERE inscrit = 0 ");
                $req->execute();
                $users = $req->fetchColumn();
                return $users;
        }
        public static function validate($id_utilisateur) {
                $db = Db::getInstance();
                $req = $db->prepare("UPDATE Utilisateur SET inscrit = 1 WHERE id_utilisateur = :id_utilisateur");
                $req->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
        }

        public static function countTotalUsers() {
                $db = Db::getInstance();
                $count = $db->query('SELECT COUNT(*) FROM utilisateur')->fetchColumn();
                return $count;
        }
            
        public static function getUsersPerPage($page = 1) {
                $list = [];
                $db = Db::getInstance();
                $offset = ($page - 1) * 50; // Toujours afficher 50 utilisateurs par page
                $req = $db->prepare('SELECT * FROM utilisateur WHERE inscrit = 1 ORDER BY nom ASC LIMIT :offset, 50');
                $req->bindParam(':offset', $offset, PDO::PARAM_INT);
                $req->execute();
                foreach($req->fetchAll() as $user) {
                        $list[] = new Utilisateur($user['id_utilisateur'], $user['mail'], $user['mot_de_passe'], $user['nom'], $user['prenom'], $user['avatar'], $user['ville'], $user['telephone'], $user['id_role']);
                }
                return $list;
        }
        // Verifier si l'utilisateur a participé a 10 evenement ou plus 
        public static function premiumAccount($id_utilisateur){
                $db = Db::getInstance();
                $req = $db->prepare("SELECT COUNT(id_event) FROM inscription_utilisateur_event WHERE id_utilisateur = :id_utilisateur");
                $req->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
                $count = $req->fetchColumn();
                return $count >= 10;
        }
        public static function findVille($id_utilisateur) {
                $db = Db::getInstance();
                $req = $db->prepare("SELECT ville FROM utilisateur WHERE id_utilisateur = :id_utilisateur");
                $req->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
                $req->execute();
                return $ville = $req->fetch(PDO::FETCH_ASSOC);
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