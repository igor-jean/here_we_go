<?php
    $id_event = $_GET["id_event"];
    require_once "../connexion.php";
    require_once "..\models\Evenement.php";
    $event = Evenement::find($id_event)
?>
<style>
    body {
        padding: 0;
        margin: 0;
    }
    a {
        display: block;
    }
    img {
        width: 100%;
        height: 100%;
        object-fit :  cover;
        object-position: center;
    }
    span {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        color: black;
        font-size: 24px;
        font-family: sans-serif;
    }
</style>

    
<a href="/here_we_go/fiche_evenement/<?php echo $id_event ?>" target="_blank"><span><?php echo $event->getCode_unique_label();?> </span><img src="../assets/img/LOGO_iframe.png" alt=""></a>

