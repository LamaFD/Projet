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
        <?php 
        if($BDD) {
            while($page = $_SESSION['recap'])
            {
                $req_recap = "SELECT * FROM `page` WHERE id_page=?";
                $curs_recap = $BDD->prepare($req_recap);
                $curs_recap->execute(array($page));
                $tuple = $curs_recap->fetch();
                ?> 
                <p><?=$tuple['texte']?></p></br>
                <?php                                
            }
               }
            ?>

    </div>


</body>

</html>