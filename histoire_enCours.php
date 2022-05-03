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
    <div class="container text-center">
        <?php 
        if($BDD) {
            $id_page = $_GET["id_page"];
        
            $maRequete = "SELECT * FROM `page` WHERE id_page=? ORDER BY id_page";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($id_page));
            while($tuple = $curseur->fetch()) {
            // update etat du vie
            $vie=$_GET["vie"]+$tuple["modif_vie"];
            if($vie==0) // On affiche le contenu de la page sans les choix
            {?>
                <h3><?=$tuple["page_titre"]?></a></h3>
                <p><?=$tuple["texte"]?></p>
                <p>Nombre de vies restants : <?=$vie?></p>
                Vous n'avez plus de vies restant, votre chemin est arrivée à sa fin ! </br>
                <form method="POST">
                <input type="submit" name="Fin" value= "FINI" formaction="histoire_fin.php">
                </form>
                
            <?php }

            else // On affiche le contenu de la page avec les choix 
            {?>
                <h3><?=$tuple["page_titre"]?></a></h3>
                <p><?=$tuple["texte"]?></p>
                
                <form method="POST">
                <input type=hidden name="vie" value=$vie>
                <input type="submit" name="id_page"  value=<?="Choix 1 :". $tuple["choix_1_texte"] ?> formaction=<?="histoire_enCours.php?id_page=".$tuple["choix_1"]."&vie=".$vie?> >
                <input type="submit" name="id_page"  value=<?="Choix 2 :".$tuple["choix_2_texte"] ?> formaction=<?="histoire_enCours.php?id_page=".$tuple["choix_2"]."&vie=".$vie?> >
                </form>
                <p>Nombre de vies restants : <?=$vie?></p>
                
            <?php
            }}}
            ?>
    </div>


</body>

</html>