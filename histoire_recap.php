<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle4.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    <div class="container text-center">
    <h1 class="text-center"><span class="Titre">Recapitulative de votre aventure : </span></h1>
        <?php 
        if($BDD) {
            foreach($_SESSION['recap'] as $page)
            {
                $req_recap = "SELECT * FROM `page` WHERE id_page=?";
                $curs_recap = $BDD->prepare($req_recap);
                $curs_recap->execute(array($page));
                $tuple = $curs_recap->fetch();
                ?> 
                <h2><?=$tuple['page_titre']?></h2></br>
                <p><?=$tuple['texte']?></p></br>
                <?php                                
            }
               }
            ?>

    </div>


</body>

</html>