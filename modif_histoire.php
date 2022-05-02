<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle2.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>

<?php 
        $id_histoire = $_SESSION["id_histoire_modif"];

        if($BDD) {
            // on cherche les infomrations concernant l'histoire
            $maRequete_histoire = "SELECT * FROM histoire WHERE id_histoire=?";
            $curseur = $BDD->prepare($maRequete_histoire);
            $curseur->execute(array($id_histoire));

            $Titre = $curseur["titre"];
            $Resume = $curseur["resume_histoire"];
            $nbr_vies = $cursuer["nbr_vie"];

            // on cherche les pages (preparation d'affichage des pages)
            $maRequete_pages = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
            $curseur2 = $BDD->prepare($maRequete_pages);
            $curseur2->execute(array($id_histoire));


        }
    ?>

<body>

        <form method="POST">
        <h3>Informations générales sur votre histoire</h3>
        <table>
            <tr><td><label for="titre">Titre : </label></td><td><input type="text" name="titre" id="titre" size="35" value=<?php $Titre ?>/></td></tr>
            <tr><td><label for="resume">Résumé : </label></td><td><br/><textarea cols='50' rows='7' name="resume" id="resume" value=<?php $Resume ?>></textarea><br/></td></tr>
            <tr><td><label for="nbr_vie"> Nombre de vies en début d'aventure : </label></td><td><input type="number" name="nbr_vie" id="nbr_vie" value=<?php $nbr_vies ?>/></td></tr>
            


        <?php ?>
            <label for="titre_page"> Titre de votre page : </label><br/><input type="text" name="titre_page" id="titre_page" size="35" require/></br>
            <label for="modif_vie"> Modification du vie : </label><br/><input type="number" name="modif_vie" id="modif_vie" size="35" require/></br>
            <label for="page"> Votre paragraphe : </label><br/><textarea cols='90' rows='20' name="page" id="page" require></textarea><br/>
            <input type="radio" name="Premier_page" id="Premier_page">
            <label for="Premier_page">Est la premiere page</label><br/>
        </table>




</form>
</body>
</html>