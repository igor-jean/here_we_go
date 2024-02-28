
    <h2>Ajouter un covoiturage à un événement</h2>
    <form action="?controller=covoiturages&action=addCovoiturage" method="POST">
        <div>
            <label for="information_de_contact">Information de contact:</label><br>
            <input type="text" id="information_de_contact" name="information_de_contact" required><br>
        </div>
        <div>
            <label for="montant_par_pers">Montant par personne:</label><br>
            <input type="text" id="montant_par_pers" name="montant_par_pers" required><br>
        </div>
        <div>
            <label for="lieu_depart">Lieu de départ:</label><br>
            <input type="text" id="lieu_depart" name="lieu_depart" required><br>
        </div>
        <div>
            <label for="descriptif">Descriptif:</label><br>
            <textarea id="descriptif" name="descriptif" required></textarea><br>
        </div>
        <div>
            <label for="nb_place">Nombre de places:</label><br>
            <input type="number" id="nb_place" name="nb_place" required><br>
        </div>
        <div>
            <label for="heure_depart">Heure de départ:</label><br>
            <input type="time" id="heure_depart" name="heure_depart" required><br>
        </div>
        <div>
            <label for="id_vehicule_utilisateur">Véhicule utilisateur:</label><br>
            <select id="id_vehicule_utilisateur" name="id_vehicule_utilisateur" required>
                <option value="">Sélectionnez le véhicule utilisateur</option>
                <?php foreach ($vehicules as $vehicule) {
                    echo "<option value='".$vehicule->getId_vehicule_utilisateur()."'>".$vehicule->getLibelle_vehicule()."</option>";
                }
                ?>
            </select><br>
        </div>
            <input type="hidden" id="id_event" name="id_event" value="<?php echo $id_event;  ?>">
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>