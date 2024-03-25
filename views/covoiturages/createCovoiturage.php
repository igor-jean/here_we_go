<div class="container">
<h2>Ajouter un covoiturage à un événement</h2>
<?php if(isset($_GET['error'])) {
    $errorMessage = urldecode($_GET['error']);
    echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
}
?>
    <form action="/here_we_go/submit_covoiturage" method="POST">
        <div class="mb-3">
            <label for="information_de_contact" class="form-label">Information de contact:</label>
            <input type="text" class="form-control" id="information_de_contact" name="information_de_contact" required>
        </div>
        <div class="mb-3">
            <label for="montant_par_pers" class="form-label">Montant par personne:</label>
            <input type="text" class="form-control" id="montant_par_pers" name="montant_par_pers" required>
        </div>
        <div class="mb-3">
            <label for="lieu_depart" class="form-label">Lieu de départ:</label>
            <input type="text" class="form-control" id="lieu_depart" name="lieu_depart" required>
        </div>
        <div class="mb-3">
            <label for="descriptif" class="form-label">Descriptif:</label>
            <textarea class="form-control" id="descriptif" name="descriptif" required></textarea>
        </div>
        <div class="mb-3">
            <label for="nb_place" class="form-label">Nombre de places:</label>
            <input type="number" class="form-control" id="nb_place" name="nb_place" required>
        </div>
        <div class="mb-3">
            <label for="heure_depart" class="form-label">Heure de départ:</label>
            <input type="time" class="form-control" id="heure_depart" name="heure_depart" required>
        </div>
        <div class="mb-3">
            <label for="id_vehicule_utilisateur" class="form-label">Véhicule utilisateur:</label>
            <select class="form-select" id="id_vehicule_utilisateur" name="id_vehicule_utilisateur" required>
                <option value="">Sélectionnez le véhicule utilisateur</option>
                <?php foreach ($vehicules as $vehicule) {
                    echo "<option value='".$vehicule->getId_vehicule_utilisateur()."'>".$vehicule->getLibelle_vehicule()."</option>";
                }
                ?>
            </select>
        </div>
        <input type="hidden" id="id_event" name="id_event" value="<?php echo $id_event; ?>">
        <div class="my-3 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a class="btn btn-secondary" href="/here_we_go/fiche_evenement/<?php echo $id_event; ?>">Retour</a>
        </div>
    </form>
</div>
