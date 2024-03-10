<?php
session_start();
ob_start();
require_once('models/Utilisateur.php');
$id_user = isset($_SESSION["id_utilisateur"])?$_SESSION["id_utilisateur"]:"";
if($id_user != "") {
  $user = Utilisateur::find($id_user);
  $premium = Utilisateur::premiumAccount($id_user);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <base href="/here_we_go/">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="styles/styles.css" rel="stylesheet" />
  <title>Here we go</title>
</head>
<body>
<?php
require_once('models/Categorie.php');
if(isset($_SESSION["login"]) && $_SESSION["login"] === "admin") {
  require_once "requires/navbarAdmin.php";
}
elseif(isset($_SESSION["login"]) && $_SESSION["login"] === "user") {
  require_once "requires/navbarUser.php";
}
else {
  require_once "requires/navbar.php";
}
?>
<main>
    <?php require_once('routes.php'); ?>
</main>
<?php require_once "requires/footer.php"; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>
