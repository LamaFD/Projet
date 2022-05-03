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
        $id_histoire = $_GET["id_histoire"];

        if($BDD) {
            // on cherche les infomrations concernant l'histoire
            $maRequete_histoire = "SELECT * FROM histoire WHERE id_histoire=?";
            $curseur = $BDD->prepare($maRequete_histoire);
            $curseur->execute(array($id_histoire));
            while($tuple = $curseur->fetch()) {

            $Titre = $tuple["titre"];
            $Resume = $tuple["resume_histoire"];
            $nbr_vies = $tuple["nbr_vie"];
            }
            // on cherche les pages (preparation d'affichage des pages)
            $maRequete_pages = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
            $curseur2 = $BDD->prepare($maRequete_pages);
            $curseur2->execute(array($id_histoire));


        }
    ?>

<body>
    <main class="container">
        <form method="POST">
        <h3>Informations générales sur votre histoire</h3>
        <table>
            <tr><td><label for="titre">Titre : </label></td><td><input type="text" name="titre" id="titre" size="35" value=<?= $Titre ?>></td></tr>
            <tr><td><label for="resume">Résumé : </label></td><td><br/><textarea cols='50' rows='7' name="resume" id="resume" value=<?= $Resume ?>></textarea><br/></td></tr>
            <tr><td><label for="nbr_vie"> Nombre de vies en début d'aventure : </label></td><td><input type="number" name="nbr_vie" id="nbr_vie" value=<?= $nbr_vies ?>/></td></tr>
            
        </table>
    </main>




</form>
</body>
</html>