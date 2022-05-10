
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
            $maRequete = "SELECT * FROM histoire ORDER BY id_histoire DESC";
            $curseur = $BDD->query($maRequete);
            while($tuple = $curseur->fetch())
            {
                if($tuple["Cache"]==0)
                {
                    ?>
                <h3><img class="img-responsive movieImage" src="images/<?= $tuple['hist_img'] ?>"alt="Dessin correspondant à l'histoire" width=42 ><span class="Titre"><?=$tuple["titre"]?></span></h3>
                <p><span class="presentation"><?=$tuple["resume_histoire"]?></span></p>
                <form method="POST">
                <input type="submit" value="Lire" formaction=<?= "histoire_initialiser.php?id_page=".$tuple["id_premiere_page"]."&vie=".$tuple["nbr_vie"]."&id_histoire=".$tuple["id_histoire"] ?>>  
                    <?php 
                    if(isUserConnected())
                    {
                        $req_verifier = "SELECT * FROM `historique` WHERE id_histoire=? AND id_user=?";
                        $curs_hist = $BDD->prepare($req_verifier);
                        $curs_hist->execute(array($tuple["id_histoire"],$_SESSION['id_user']));
                        if($curs_hist->rowCount() == 1)
                        {
                        $historique = $curs_hist->fetch();
                        ?>
                        <input type="submit" value="Continuer" formaction=<?="histoire_initialiser.php?id_page=".$historique["id_page"]."&vie=".$historique["vie_actuelle"]."&id_histoire=".$tuple["id_histoire"] ?>>
                    <?php }
                    }
                    ?>
                </form>
            <?php }
            }
        }?>
        
    </div>

</body>
</html>