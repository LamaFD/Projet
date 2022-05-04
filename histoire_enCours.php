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
            $fini=$tuple["Fin"];
            if($vie==0 || $fini==1) // On affiche le contenu de la page sans les choix
            {?>
                <h3><?=$tuple["page_titre"]?></a></h3>
                <p><span class="presentation"><?=$tuple["texte"]?></span></p>
                <p>Nombre de vies restants : <?=$vie?></p>
                <?php if($fini==0)
                { 
                   echo "Vous n'avez plus de vies restant, votre chemin est arrivée à sa fin !" ;
                } 
                else
                {
                    echo "Vous etes arrivés à la fin de l'histoire !" ;
                }?>
                </br>
                <form method="POST">
                <input type="submit" name="Fin" value= "FINI" formaction="histoire_fin.php">
                </form>
                
            <?php }

            else // On affiche le contenu de la page avec les choix 
            {?>
                <h3><?=$tuple["page_titre"]?></a></h3>
                <p><span class="presentation"><?=$tuple["texte"]?></span></p>
                
                <form method="POST" class="form2">
                <input type=hidden name="vie" value=$vie>
                <?php 
                    while($nb_choix<=$tuple[""])
                ?>
                <input type="submit" name="id_page"  value=<?="Choix 1 :". $tuple["choix_1_texte"] ?> formaction=<?="histoire_enCours.php?id_page=".$tuple["choix_1"]."&vie=".$vie?> >
                <input type="submit" name="id_page"  value=<?="Choix 2 :".$tuple["choix_2_texte"] ?> formaction=<?="histoire_enCours.php?id_page=".$tuple["choix_2"]."&vie=".$vie?> >
                </form>
                <p class="navbar-left presentation italique">Nombre de vies restantes : <?=$vie?></p>
                
            <?php
            }}}
            ?>
    </div>


</body>

</html>