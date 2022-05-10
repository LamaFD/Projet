<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    <div class="container text-center">
    <h1 class="text-center"><span class="Titre">Récapitulatif de votre aventure : </span></h1>
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
            <form type="POST">
            <input type="submit" name="Fin" value= "Retour à l'accueil" formaction="index.php">
            </form>
    </div>
</body>
</html>