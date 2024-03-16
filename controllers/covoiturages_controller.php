<?php
    class CovoituragesControllers {

        public function showCovoiturage() {
            try {
                $id_utilisateur = $_SESSION["id_utilisateur"];
                $id_covoiturage = $_GET["id_covoiturage"];
                $id_event = isset($_GET["id_event"])?$_GET["id_event"]:"";
                $inscrit = Covoiturage::verificationInscriptionCovoit($id_utilisateur, $id_covoiturage);
                $conducteur = Covoiturage::getNomConducteur($id_covoiturage);
                $covoit = Covoiturage::find($id_covoiturage);
                $vehicule = Covoiturage::getVoituresByCovoiturageId($id_covoiturage);
                $verif = Covoiturage::checkIfOnlyOne($id_utilisateur, $id_event);
                require_once('views/covoiturages/showCovoiturage.php');
            } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
            
        }
        public function createCovoiturage() {
            try {
                $id_utilisateur = $_SESSION["id_utilisateur"];
                $id_event = $_GET["id_event"];
                $vehicules = Vehicule::findVehicule($id_utilisateur);
                require_once('views/covoiturages/createCovoiturage.php');
            } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
        }
        public function addCovoiturage() {
            try {
                $descriptif = $_POST["descriptif"];
                $information_de_contact = $_POST["information_de_contact"];
                $montant_par_pers = $_POST["montant_par_pers"];
                $lieu_depart = $_POST["lieu_depart"];
                $nb_place = $_POST["nb_place"];
                $heure_depart = $_POST["heure_depart"];
                $id_vehicule_utilisateur = $_POST["id_vehicule_utilisateur"];
                $id_event = $_POST["id_event"];
                $champsRequis = ["montant_par_pers", "lieu_depart", "nb_place", "heure_depart", "id_vehicule_utilisateur", "id_event"];
                foreach ($champsRequis as $value) {
                    if(empty($_POST[$value])) {
                        throw new Exception("Veuillez remplir les champs obligatoires.");
                    }
                }

                Covoiturage::add($montant_par_pers, $information_de_contact, $lieu_depart, $descriptif, $nb_place, $heure_depart, $id_vehicule_utilisateur, $id_event);
                header("Location: ?controller=evenements&action=showEvent&id_event=$id_event");
            } catch(Exception $e) {
                $errorMessage = urlencode($e->getMessage());
                header("Location: ?controller=covoiturages&action=createCovoiturage&id_event=$id_event&error=$errorMessage");
            }
        }
        
        public function modifCovoiturage() {
            $id_utilisateur = $_SESSION["id_utilisateur"];
            $id_covoiturage = $_GET["id_covoiturage"];
            $covoit = Covoiturage::find($id_covoiturage);
            $vehicules = Vehicule::findVehicule($id_utilisateur);
            require_once('views/covoiturages/modifCovoiturage.php');
        }

        public function updateCovoiturage() {
            try {
                $descriptif = $_POST["descriptif"];
                $information_de_contact = $_POST["information_de_contact"];
                $montant_par_pers = $_POST["montant_par_pers"];
                $lieu_depart = $_POST["lieu_depart"];
                $nb_place = $_POST["nb_place"];
                $heure_depart = $_POST["heure_depart"];
                $id_vehicule_utilisateur = $_POST["id_vehicule_utilisateur"];
                $id_covoiturage = $_POST["id_covoiturage"];
                $champsRequis = ["montant_par_pers", "lieu_depart", "nb_place", "heure_depart", "id_vehicule_utilisateur", "id_covoiturage"];
                foreach ($champsRequis as $value) {
                    if(empty($_POST[$value])) {
                        throw new Exception("Veuillez remplir les champs obligatoires.");
                    }
                }
                
                Covoiturage::update($id_covoiturage, $montant_par_pers, $information_de_contact, $lieu_depart, $descriptif, $nb_place, $heure_depart, $id_vehicule_utilisateur, $id_event);
                header("Location: ?controller=utilisateurs&action=monCompte");
            } catch(Exception $e) {
                $errorMessage = urlencode($e->getMessage());
                header("Location: ?controller=covoiturages&action=modifCovoiturage&id_covoiturage=$id_covoiturage&error=$errorMessage");
            }
        }
        public function inscriptionCovoiturage() {
            $id_covoiturage = $_GET["id_covoiturage"];
            $id_utilisateur = $_SESSION["id_utilisateur"];
            $operation = "-";
            Covoiturage::setNbPlaceDispo($id_covoiturage, $operation);
            Covoiturage::registrationCovoiturage($id_covoiturage, $id_utilisateur);
            $this->showCovoiturage();

        }
        
        public function desinscriptionCovoiturage() {
            $id_covoiturage = $_GET["id_covoiturage"];
            $id_utilisateur = $_SESSION["id_utilisateur"];
            $operation = "+";   
            Covoiturage::setNbPlaceDispo($id_covoiturage, $operation);
            Covoiturage::unsubscribeCovoiturage($id_covoiturage, $id_utilisateur);
            $this->showCovoiturage();

        }
        
        public function confirmationSuppression() {
            try {
                $id_covoiturage = $_GET["id_covoiturage"];
                $id_event = $_GET["id_event"];
                require_once('views/covoiturages/confirmationSuppression.php');
            } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
        }
        
        public function supprimerToutCovoit() {
            try {
                $id_covoiturage = $_GET["id_covoiturage"];
                Covoiturage::deleteCovoiturage($id_covoiturage);
                header("Location: ?controller=pages&action=home");
            } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
        }
        
        public function supprimerCovoitPerAdmin() {
            try {
                $id_covoiturage = $_GET["id_covoiturage"];
                $id_event = $_GET["id_event"];
                Covoiturage::deleteCovoiturage($id_covoiturage);
                header("Location: ?controller=admin&action=updateAnEvent&id_event=$id_event");
            } catch(Exception $e) {
                echo "Erreur :".$e->getMessage();
            }
        }
        
    }
    
    
    ?>