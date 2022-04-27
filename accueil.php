
<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle2.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    <div class="container">
        <?php 
        // vérifie qu’on est bien connecté à la base de données
        if($BDD) {
        // On enregistre la requête SQL dans une variable
        $maRequete = "SELECT * FROM histoire ORDER BY id_histoire";
        // On envoie la requête “à travers la connexion” et on récupère le résultat
        $curseur = $BDD->query($maRequete);
        }

        // la méthode fetch positionne le curseur sur une ligne de la requête
        // et passe à la ligne suivante à chaque appel
        while($tuple = $curseur->fetch()) {
        // On affiche le contenu de la ligne
        
        ?>
            <h3><a href=<?="histoire_enCours.php"?>><span class="Titre"><?=$tuple["titre"]?></span></a></h3>
            <p><span class="Resume"><?=$tuple["resume_histoire"]?></span></p>
        <?php
        }
        ?>
        
    </div>

</body>


</html>