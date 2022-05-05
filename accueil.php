
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
        if($BDD) {
            $maRequete = "SELECT * FROM histoire ORDER BY id_histoire";
            $curseur = $BDD->query($maRequete);
            while($tuple = $curseur->fetch())
            {
                if($tuple["Cache"]==0)
                {
                    print_r($tuple);////////////////////////////////////////////////
                    ?>
                <h3><img class="img-responsive movieImage" src="images/<?= $tuple['hist_img'] ?>"alt="Dessin correspondant à l'histoire" width=42 ><span class="Titre"><?=$tuple["titre"]?></span></h3>
                <p><span class="presentation"><?=$tuple["resume_histoire"]?></span></p>
                <!--<table>
                    <tr>
                    <td><img class="img-responsive movieImage" src="images/<?= $tuple['hist_img'] ?>"alt="Dessin illustrant l'histoire" width=42></td><td><a href=<?="histoire_enCours.php?id_page=".$tuple["id_premiere_page"]."&vie=".$tuple["nbr_vie"]?>><h3><span class="Titre"><?=$tuple["titre"]?></span></h3></a></td></tr>
                <tr><td></td><td><span class="presentation"><?=$tuple["resume_histoire"]?></span></td></tr>
            </table>-->
                <form>
                    <input type="submit" name="commencer" value="Commencer" formaction=<?="histoire_enCours.php?id_page=".$tuple["id_premiere_page"]."&vie=".$tuple["nbr_vie"]?>>
                    <?php 
                    if(isUserConnected())
                    {
                        $req_verifier = "SELECT * FROM `historique` WHERE id_histoire=? AND id_user=?";
                        $curs_hist = $BDD->prepare($req_verifier);
                        $curs_hist->execute(array($tuple["id_histoire"],$_SESSION['id_user']));
                        if($curs_hist->rowCount() == 1)
                        {
                        ?>
                        <input type="submit" name="continuer" value="Continuer">
                    <?php }
                    }
                    ?>
                </form>
            <?php }}?>
        <?php
            if(isset($_POST))
            {
                
            }
        }
        ?>
        
    </div>

</body>
</html>