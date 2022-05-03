
<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle3.css" rel="stylesheet">
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
            if($tuple["Cache"]==0)
            {
        ?>
            <h3><a href=<?="histoire_enCours.php?id_page=".$tuple["id_premiere_page"]."&vie=".$tuple["nbr_vie"]?>><span class="Titre"><?=$tuple["titre"]?></span></a></h3>
            <p><span class="presentation"><?=$tuple["resume_histoire"]?></span></p>
            <!--<table>
                <tr>
                <td><img class="img-responsive movieImage" src="images/<?= $tuple['hist_img'] ?>"alt="Dessin illustrant l'histoire" width=42></td><td><a href=<?="histoire_enCours.php?id_page=".$tuple["id_premiere_page"]."&vie=".$tuple["nbr_vie"]?>><h3><span class="Titre"><?=$tuple["titre"]?></span></h3></a></td></tr>
            <tr><td></td><td><span class="presentation"><?=$tuple["resume_histoire"]?></span></td></tr>
        </table>-->
        <?php
        }}
        ?>
        
    </div>

</body>


</html>