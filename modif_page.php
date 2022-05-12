<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h1 class="text-center"><span class="Titre">Votre page</span></h1>
<div class="container">
    <form class="text-center" method="POST" action="modif_page_action.php">
    <?php 
        $id_page = $_GET["id_page"];
        $id_histoire = $_GET["id_histoire"];

        if($BDD) {
            // on cherche les pages (preparation d'affichage des pages)
            $maRequete_pages = "SELECT * FROM `page` WHERE id_page=?";
            $curseur = $BDD->prepare($maRequete_pages);
            $curseur->execute(array($id_page));
            $tuple = $curseur->fetch();
            $Titre_page = $tuple["page_titre"];
            $Text_page = $tuple["texte"];
            $modif_vie = $tuple["modif_vie"];
            $nb_choix =$tuple["nbr_choix"];
            $fin = $tuple["Fin"];
            ?>
            <input type="hidden" id="id_histoire" name="id_histoire" value=<?=$id_histoire?>>
            <input type="hidden" id="id_page" name="id_page" value=<?=$id_page?>>
            <label for="titre_page"> Titre de la page : </label><input type="text" name="titre_page" id=<?="titre_page_".$id_page?> size="35" value="<?=$Titre_page?>" required></br>
            <label for="modif_vie"> Modification du vie : </label><input type="number" name="modif_vie" id="modif_vie" size="35" value="<?= $modif_vie ?>"   required/></br>
            <label for="page" class="margin-left"> Le paragraphe : </label><br/><textarea cols='80' rows='20' name="page" id=<?="page_".$id_page?>><?php echo $Text_page;?></textarea><br/>
            <?php
            if($fin==1){
                ?>
                <label for="fin_chemin">Une page de fin ? </label><br/>
                <input type="radio" name="fin_chemin" id="fin_chemin_oui" checked>
                <label for="fin_chemin_oui">Oui</label>
                <input type="radio" name="fin_chemin" id="fin_chemin_non">
                <label for="fin_chemin_non">Non</label>
            <?php ;}
            else
            {?>
                <label for="fin_chemin">Une page de fin ? </label><br/>
                <input type="radio" name="fin_chemin" id="fin_chemin_oui" >
                <label for="fin_chemin_oui">Oui</label>
                <input type="radio" name="fin_chemin" id="fin_chemin_non" checked>
                <label for="fin_chemin_non">Non</label>
            <?php ;}
            ?>
            <br/>
            <button type="submit" name="Modifier">Confirmer les modifications</button><br/>
            <button type="submit" name="Choix">Modifier les choix</button><br/>
            <?php }
    ?>
    </form>
</div>
</html>