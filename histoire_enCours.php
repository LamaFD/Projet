<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>

        <?php 
        // vérifie qu’on est bien connecté à la base de données
        if($BDD) {
            // On enregistre la requête SQL dans une variable
            $maRequete = "SELECT * FROM page ORDER BY id_histoire";
            // On envoie la requête “à travers la connexion” et on récupère le résultat
            $curseur = $BDD->query($maRequete);
            }
    
            // la méthode fetch positionne le curseur sur une ligne de la requête
            // et passe à la ligne suivante à chaque appel
            while($tuple = $curseur->fetch()) {
            // On affiche le contenu de la ligne
            
            ?>
                <h3><a href=<?="histoire_enCours.php"?>><?=$tuple["titre"]?></a></h3>
                <p><?=$tuple["resume"]?></p>
            <?php
            }
            ?>

    </div>


</body>

</html>