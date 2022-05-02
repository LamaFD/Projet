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
        
        if($BDD) {
            $id_page = $_GET["id_page"];
        
            $maRequete = "SELECT * FROM `page` WHERE id_page=? ORDER BY id_page";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($id_page));
            // update etat du vie
            $vie=$_GET["vie"]+$curseur["modif_vie"];
            if($vie==0) // On affiche le contenu de la page sans les choix
            {?>
                
                <h3><?=$curseur["page_titre"]?></a></h3>
                <p><?=$curseur["texte"]?></p>
                <p>Nombre de vies restants : <?=$curseur["nbr_vie"]?></p>
                Vous n'avez plus de vies restant, votre chemin est arrivée à sa fin ! 
                <input type="submit" name="Fin" value= "FINI" formaction=histoire_fin.php>
                
            <?php }

            else // On affiche le contenu de la page avec les choix 
            {?>
                <h3><?=$curseur["page_titre"]?></a></h3>
                <p><?=$curseur["texte"]?></p>
                <input type="submit" name="Choix_1" value=<?php $curseur["choix_1_texte"] ?> formaction=<?="histoire_enCours.php?id_page=".$curseur["choix_1"]?>>
                <input type="submit" name="Choix_2" value=<?php $curseur["choix_2_texte"] ?> formaction=<?="histoire_enCours.php?id_page=".$curseur["choix_2"]?>>

            }
            
            
            
                
            <?php
            }
            ?>

    </div>


</body>

</html>