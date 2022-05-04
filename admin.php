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
        if($tuple["nbr_joue"]==0)
        {
            $taux=0;
        }
        else
        {
            $taux = ($tuple["nbr_reussites"]/$tuple["nbr_joue"])*100;
        }
        
        ?>
            <h3 class="text-primary" ><span class="Titre"><?=$tuple["titre"]?></span></h3>
            <p><span class="presentation"><?=$tuple["resume_histoire"]?></span></p>
            <p><span class="presentation">Nombre de vies au debut du jeu : <?=$tuple["nbr_vie"]?> </span></p>
            <p><span class="presentation">Nombre de fois joué : <?=$tuple["nbr_joue"]?></span> </p>
            <p> <span class="presentation">Taux de réussite : <?=$taux?></span> </p>
            <form class="text-center" method="POST">
            <input type="submit" name="lire" value="Lire" formaction=<?="histoire_enCours.php?id_page=".$tuple["id_premiere_page"]."&vie=".$tuple["nbr_vie"]?>>
            <input type="submit" name="modif" value="Modifier" formaction=<?="modif_histoire.php?id_histoire=".$tuple["id_histoire"]?>>
            <input type="submit" name="supprime" value="Supprimer" formaction=<?="Supprime_histoire.php?id_histoire=".$tuple["id_histoire"]?>>
            <?php 
            if($tuple["Cache"]==false) 
            {?>
                <input type="submit" name="cache" value="Cacher" formaction=<?="Visibilite_histoire.php?id_histoire=".$tuple["id_histoire"]?>>
            <?php }
            else
            {?>
                <input type="submit" name="montre" value="Rendre visible" formaction=<?="Visibilite_histoire.php?id_histoire=".$tuple["id_histoire"]?>>
            <?php }
            ?>
            
            </form>
        <?php
        }
        ?>
        
    </div>

</body>


</html>