<h2>Ajouter une photo d'événement</h2>
<img src="photo_evenement/<?php echo $photoActuelle["chemin"] ;?>" alt="">

<form action="<?php if($dejaPresent){echo "?controller=utilisateurs&action=updatePhoto";} else {echo "?controller=utilisateurs&action=addPhoto";}  ; ?>" method="post" enctype="multipart/form-data">
    <label for="chemin">Choisir une photo :</label><br>
    <input type="file" id="chemin" name="chemin" accept=".jpg, .jpeg, .png"><br><br>
    
    <input type="hidden" name="id_event" value="<?php echo $id_event; ?>"><br><br>
    
    <input type="submit" value="<?php if($dejaPresent){echo "Modifier la photo";} else {echo "Ajouter la photo";}  ; ?>">
</form>
<a href="?controller=utilisateurs&action=deletePhoto&id_event=<?php echo $id_event; ?>">Supprimer la photo</a>