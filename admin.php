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
    <div class="container">
        <?php 
        if($BDD) {
        $maRequete = "SELECT * FROM histoire ORDER BY id_histoire";
        $curseur = $BDD->query($maRequete);
        }
        while($tuple = $curseur->fetch()) {
        if($tuple["nbr_joue"]==0)
        {
            $taux=0;
        }
        else
        {
            $taux = ($tuple["nbr_reussites"]/$tuple["nbr_joue"])*100;
        }
        
        ?>
        <img class="img-responsive movieImage" src="images/<?= $tuple['hist_img'] ?>"alt="Dessin correspondant à l'histoire" width=42 >
            <h3 class="text-primary" ><span class="Titre"><?=$tuple["titre"]?></span></h3>
            <p><span class="presentation"><?=$tuple["resume_histoire"]?></span></p>
            <p><span class="presentation">Nombre de vies au debut du jeu : <?=$tuple["nbr_vie"]?> </span></p>
            <p><span class="presentation">Nombre de fois joué : <?=$tuple["nbr_joue"]?></span> </p>
            <p> <span class="presentation">Taux de réussite : <?=$taux?></span> </p>
            <form class="text-center" method="POST">
            <input type="submit" name="lire" value="Lire" formaction=<?="histoire_initialiser.php?id_page=".$tuple["id_premiere_page"]."&vie=".$tuple["nbr_vie"]."&id_histoire=".$tuple["id_histoire"]?>>
            <?php 
            $req_verifier = "SELECT * FROM `historique` WHERE id_histoire=? AND id_user=?";
            $curs_hist = $BDD->prepare($req_verifier);
            $curs_hist->execute(array($tuple["id_histoire"],$_SESSION['id_user']));
            if($curs_hist->rowCount() == 1)
            {
            $historique = $curs_hist->fetch();
            ?>
            <input type="submit" value="Continuer" formaction=<?="histoire_initialiser.php?id_page=".$historique["id_page"]."&vie=".$historique["vie_actuelle"]."&id_histoire=".$tuple["id_histoire"] ?>>
        <?php }
            ?>
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