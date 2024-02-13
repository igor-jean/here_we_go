<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Here we go</title>
</head>
<body>
<?php
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
  
  <?php require_once('routes.php'); ?>
  
</body>
</html>
