<?php
    require 'vendor/autoload.php';
    putenv('GOOGLE_APPLICATION_CREDENTIALS=alien-sol-416112-45a374d2449c.json');

    require_once "connexion.php";

    if(isset($_GET["controller"]) && isset($_GET["action"])) {
        $controller = $_GET["controller"];
        $action = $_GET["action"];
    }else {
        $controller = "pages";
        $action = "home";
    }

    require_once('views/layout.php');
?>