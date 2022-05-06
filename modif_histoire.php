<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle4.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h1 class="text-center"><span class="Titre">Informations générales sur votre histoire</span></h1>
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
        }
    ?>

<body>
    <main class="container">
        <form class="text-center" method="POST">
        <table>
            <tr><td><label for="titre">Titre : </label></td><td><input type="text" name="titre" id="titre" size="50" value="<?= $Titre ?>"></td></tr>
            <tr><td><label for="resume">Résumé : </label></td><td><br/><textarea cols='50' rows='7' name="resume" id="resume"><?php echo $Resume;?></textarea><br/></td></tr>
            <tr><td><label for="nbr_vie"> Nombre de vies en début d'aventure : </label></td><td><input type="number" name="nbr_vie" id="nbr_vie" value="<?= $nbr_vies ?>"/></td></tr>
            
        </table>
        <input type="submit" name="continuer_modif" value="Continuer" formaction=<?="choix_page_modif.php?id_histoire=".$id_histoire?> class="text-center">
    </main>
</form>
</body>
</html>