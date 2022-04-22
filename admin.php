<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>

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
            <h3 class="text-primary" ><?=$tuple["titre"]?></h3>
            <p><?=$tuple["resume"]?></p>
            <p>Nombre de fois joué : <?=$tuple["nbr_joue"]?> </p>
            <p>Nombre de vies au debut du jeu : <?=$tuple["nbr_vie"]?> </p>
            <input type="submit" name="lire" value="Lire" formaction=<?="histoire_enCours.php?titre=".$tuple["titre"]?>>
            <input type="submit" name="modif" value="Modifier" formaction=<?="modif_histoire.php?titre=".$tuple["titre"]?>>

        <?php
        }
        ?>
        
    </div>

</body>


</html>