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
            $tuple = $curseur->fetch();
            // update etat du vie
            $vie=$_GET["vie"]+$tuple["modif_vie"];
            $fini=$tuple["Fin"];
            if($vie<=0 || $fini==1) // On affiche le contenu de la page sans les choix
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
                    // afficher les choix :
                    // chercher les choix 
                    $maRequete_choix = "SELECT * FROM `choix` WHERE id_page_associe=? ORDER BY id_choix";
                    $curseur_choix = $BDD->prepare($maRequete_choix);
                    $curseur_choix->execute(array($tuple["id_page"]));
                    while($choix = $curseur_choix->fetch()) 
                    {?>
                        <input type="submit" name=<?="choix_".$choix["id_choix"]?>  value=<?="choix_".$choix["texte_choix"]?> formaction=<?="histoire_enCours.php?id_page=".$choix["id_page_suivante"]."&vie=".$vie?> >
                    <?php }
                ?>
                </form>
                <p class="navbar-left presentation italique">Nombre de vies restantes : <?=$vie?></p>
                
            <?php
            }}
            ?>
    </div>


</body>

</html>