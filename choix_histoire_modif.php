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
<h2 class="text-center"><span class="Titre">Quelle histoire voulez-vous modifier ?</span></h2>
        <form class="text-center" method="POST">
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
            <input type="radio" name="<?=$tuple["id_histoire"]?>" id="<?=$tuple["id_histoire"]?>">
        <label for="<?=$tuple["id_histoire"]?>"><?=$tuple["titre"]?></label><br/>
        <?php
        }
        ?> 
        <input type="submit" name="inscription" value="Valider" formaction="modif_histoire.php">
</form>
</body>