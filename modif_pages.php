<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle4.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h1 class="text-center"><span class="Titre">Les pages</span></h1>
<div class="container">
    <form class="text-center" method="POST">
    <?php 
        $id_histoire = $_GET["id_histoire"];

        if($BDD) {
            // on cherche les pages (preparation d'affichage des pages)
            $maRequete_pages = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
            $curseur = $BDD->prepare($maRequete_pages);
            $curseur->execute(array($id_histoire));
            while($tuple = $curseur->fetch()) {
            $id_page=$tuple["id_page"];
            $Titre_page = $tuple["page_titre"];
            $Text_page = $tuple["texte"];
            $modif_vie = $tuple["modif_vie"];
            $nb_choix =$tuple["nbr_choix"];
            $fin = $tuple["Fin"];
            ?>
            <label for="titre_page"> Titre de la page : </label><input type="text" name="titre_page" id=<?="titre_page_".$id_page?> size="35" value="<?=$Titre_page?>"></br>
            <label for="modif_vie"> Modification du vie : </label><input type="number" name="modif_vie" id=<?="modif_vie_".$id_page?> size="35" value="<?=$modif_vie?>"></br>
            <label for="nbr_choix"> Nombre de choix associés à cette page : </label><input type="number" name="nbr_choix" id=<?="nbr_choix_".$id_page?> size="35" value="<?=$nb_choix?>"></br>
            <label for="page" class="margin-left"> Le paragraphe : </label><br/><textarea cols='80' rows='20' name="page" id=<?="page_".$id_page?> value="<?=$Text_page?>"></textarea><br/>
            <input type="radio" name="Premier_page" id=<?="Premier_page_".$id_page?>>
            <label for="Premier_page">Première page</label>
            <input type="radio" name="fin_chemin" id=<?="fin_chemin_".$id_page?>>
            <label for="fin_chemin">Dernière page</label><br/> 
            <?php
            }
        }
    ?>
    </form>
</div>
</html>