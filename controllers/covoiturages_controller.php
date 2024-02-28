<?php
    class CovoituragesControllers {

        public function showCovoiturage() {
            $id_utilisateur = $_SESSION["id_utilisateur"];
            $id_covoiturage = $_GET["id_covoiturage"];

            $inscrit = Covoiturage::verificationInscriptionCovoit($id_utilisateur, $id_covoiturage);
            $conducteur = Covoiturage::getNomConducteur($id_covoiturage);
            $covoit = Covoiturage::find($id_covoiturage);
            $vehicule = Covoiturage::getVoituresByCovoiturageId($id_covoiturage);
            
            require_once('views/covoiturages/showCovoiturage.php');
        }
        public function createCovoiturage() {
            $id_utilisateur = $_SESSION["id_utilisateur"];
            $vehicules = Vehicule::findVehicule($id_utilisateur);
            $id_event = $_GET["id_event"];
            require_once('views/covoiturages/createCovoiturage.php');
        }
        public function addCovoiturage() {
            $montant_par_pers = $_POST["montant_par_pers"];
            $information_de_contact = $_POST["information_de_contact"];
            $lieu_depart = $_POST["lieu_depart"];
            $descriptif = $_POST["descriptif"];
            $nb_place = $_POST["nb_place"];
            $heure_depart = $_POST["heure_depart"];
            $id_vehicule_utilisateur = $_POST["id_vehicule_utilisateur"];
            $id_event = $_POST["id_event"];
            Covoiturage::add($montant_par_pers, $information_de_contact, $lieu_depart, $descriptif, $nb_place, $heure_depart, $id_vehicule_utilisateur, $id_event);
            header("Location: ?controller=evenements&action=showEvent&id_event=$id_event");
        }
        public function inscriptionCovoiturage() {
            $id_covoiturage = $_GET["id_covoiturage"];
            $id_utilisateur = $_SESSION["id_utilisateur"];
            Covoiturage::registrationCovoiturage($id_covoiturage, $id_utilisateur);
            $this->showCovoiturage();
        }
        
        public function desinscriptionCovoiturage() {
            $id_covoiturage = $_GET["id_covoiturage"];
            $id_utilisateur = $_SESSION["id_utilisateur"];
            Covoiturage::unsubscribeCovoiturage($id_covoiturage, $id_utilisateur);
            $this->showCovoiturage();
        }
        
        public function confirmationSuppression() {
            $id_covoiturage = $_GET["id_covoiturage"];
            $id_event = $_GET["id_event"];
            require_once('views/covoiturages/confirmationSuppression.php');
        }
        
        public function supprimerToutCovoit() {
            $id_covoiturage = $_GET["id_covoiturage"];
            Covoiturage::deleteCovoiturage($id_covoiturage);
            header("Location: ?controller=pages&action=home");
        }
        
        public function supprimerCovoitPerAdmin() {
            $id_covoiturage = $_GET["id_covoiturage"];
            $id_event = $_GET["id_event"];
            Covoiturage::deleteCovoiturage($id_covoiturage);
            header("Location: ?controller=admin&action=updateAnEvent&id_event=$id_event");
        }
        
    }
    
    
    ?>