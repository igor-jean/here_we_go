<div class="container">
    <h2>Modifier mon covoiturage</h2>
        <?php if(isset($_GET['error'])) {
        $errorMessage = urldecode($_GET['error']);
        echo '<div class="error-message">' . $errorMessage . '</div>';
    }
    ?>
        <form action="?controller=covoiturages&action=updateCovoiturage" method="POST">
            <input type="hidden" name="id_covoiturage" value="<?php echo $covoit->getIdCovoiturage();?>">
            <div>
                <label for="information_de_contact">Information de contact:</label><br>
                <input type="text" id="information_de_contact" name="information_de_contact" value="<?php echo $covoit->getInformationDeContact();?>" required><br>
            </div>
            <div>
                <label for="montant_par_pers">Montant par personne:</label><br>
                <input type="text" id="montant_par_pers" name="montant_par_pers" value="<?php echo $covoit->getMontantParPers();?>" required><br>
            </div>
            <div>
                <label for="lieu_depart">Lieu de départ:</label><br>
                <input type="text" id="lieu_depart" name="lieu_depart" value="<?php echo $covoit->getLieuDepart();?>" required><br>
            </div>
            <div>
                <label for="descriptif">Descriptif:</label><br>
                <textarea id="descriptif" name="descriptif" value="<?php echo $covoit->getDescriptif();?>"></textarea><br>
            </div>
            <div>
                <label for="nb_place">Nombre de places:</label><br>
                <input type="number" id="nb_place" name="nb_place" value="<?php echo $covoit->getNbPlace();?>" required><br>
            </div>
            <div>
                <label for="heure_depart">Heure de départ:</label><br>
                <input type="time" id="heure_depart" name="heure_depart" value="<?php echo $covoit->getHeureDepart();?>" required><br>
            </div>
            <div>
                <label for="id_vehicule_utilisateur">Véhicule utilisateur:</label><br>
                <select id="id_vehicule_utilisateur" name="id_vehicule_utilisateur" value="" required>
                    <option value="">Sélectionnez le véhicule utilisateur</option>
                    <?php foreach ($vehicules as $vehicule) {
                        echo "<option value='".$vehicule->getId_vehicule_utilisateur()."'>".$vehicule->getLibelle_vehicule()."</option>";
                    }
                    ?>
                </select><br>
            </div>
            <div>
                <input type="submit" value="Modifier">
            </div>
        </form>
</div>