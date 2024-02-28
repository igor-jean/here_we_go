<h1>EVENEMENTS</h1>

<h2>Gestion des evenements</h2>

attente de validation :<?php echo $nbDemande ?>
<ul>
    <?php foreach ($events as $event) { 
        echo "<li><a href='?controller=admin&action=validateAnEvent&id_event=".$event->getIdEvent()."'>".$event->getTitre()."</a>=======>".$event->getVille()."</li><br>";
    }
    ?>
</ul>

<h2>liste des evenements avec paginations</h2>

<ul>
    <?php
        foreach ($eventsForPage as $event) {
            echo "<li>".$event->getTitre()."=======>".$event->getVille()."<a href='?controller=admin&action=updateAnEvent&id_event=".
$event->getIdEvent()."'>Modifier</a></li>";
        }
    ?>
</ul>
<?php for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='?controller=admin&action=evenementsAdministration&page=$i&perPage=$perPage'>$i</a> ";
}
?>
<br>
<a href="?controller=admin&action=indexAdministration">Retour</a>