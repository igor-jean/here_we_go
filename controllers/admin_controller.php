<?php
    class AdminController {
        public function indexAdministration() {
            $nbDemande = Evenement::requestToAddEvent();
            require_once('views/admin/indexAdministration.php');
        }
        public function utilisateursAdministration() {
            require_once('views/admin/utilisateurs.php');
        }
        public function evenementsAdministration() {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $perPage = isset($_GET['perPage']) ? intval($_GET['perPage']) : 5;
            $eventsData = Evenement::allForPagination($page, $perPage);
            $eventsForPage = $eventsData['events'];
            $totalPages = $eventsData['totalPages'];
            $currentPage = $eventsData['currentPage'];

            $events = Evenement::displayListValidate();
            $nbDemande = Evenement::requestToAddEvent();
            require_once('views/admin/evenements.php');
        }
        public function categorieVehiculeAdministration() {
            $categories = Categorie::all();
            require_once('views/admin/categorieVehiculeAdministration.php');
        }
// validation d'un evenement
        public function validateAnEvent() {
            $id_event = $_GET["id_event"];
            $event = Evenement::find($id_event);
            $categorie = Categorie::find($event->getId_categorie());
            require_once('views/admin/validateAnEvent.php');
        }
        
        public function validate() {
            $id_event = $_POST["id_event"];
            Evenement::validateEvent($id_event);
            $this->indexAdministration();
        }
        // modifier un evenement
        
        public function updateAnEvent() {
            $id_event = $_GET["id_event"];
            $event = Evenement::find($id_event);
            $categories = Categorie::all();
            $categorieFinded = Categorie::find($event->getId_categorie());
            require_once('views/admin/updateAnEvent.php');
        }
        
        public function update() {
            $id_event = $_POST["id_event"];
            $titre = $_POST["titre"];
            $date_event = $_POST["date_event"];
            $heure_event = $_POST["heure_event"];
            $ville = $_POST["ville"];
            $adresse = $_POST["adresse"];
            $code_postal = $_POST["code_postal"];
            $description_courte = $_POST["description_courte"];
            $description_longue = $_POST["description_longue"];
            $nb_places = $_POST["nb_places"];
            $prix = $_POST["prix"];
            $lien_billeterie = $_POST["lien_billeterie"];
            $lien_event = $_POST["lien_event"];
            $nom_structure = $_POST["nom_structure"];
            $id_categorie = $_POST["id_categorie"];
            
            Evenement::updateEvent($id_event, $titre, $date_event, $heure_event, $ville, $adresse, $code_postal, $description_courte, $description_longue, $nb_places, $prix, $lien_billeterie, $lien_event, $nom_structure, $id_categorie);
            $this->indexAdministration();
        }
        
        public function delete() {
            $id_event = $_GET["id_event"];
            Evenement::deleteEvent($id_event);
            $this->indexAdministration();
        }
        
        public function confirmerSuppression() {
            $id = $_GET["id_event"];
            require_once('views/admin/confirmerSuppression.php');
        }
        
        public function voirCategorie() {
            $id_categorie = $_GET["id_categorie"];
            $categorie = Categorie::find( $id_categorie);
            require_once('views/admin/voirCategorie.php');
        }
        
        public function updateCategorie() {
            $id_categorie = $_POST["id_categorie"];
            $libelle_categorie = $_POST["libelle_categorie"];
            $couleur = $_POST["couleur"];
            Categorie::update($id_categorie, $libelle_categorie, $couleur);
            $this->categorieVehiculeAdministration();
        }
        public function ajouterCategorie() {
            require_once('views/admin/ajouterCategorie.php');
        }

        public function addCategorie() {
            $libelle_categorie = $_POST["libelle_categorie"];
            $couleur = $_POST["couleur"];
            Categorie::add($libelle_categorie, $couleur);
            $this->categorieVehiculeAdministration();
        }









        
    }





?>