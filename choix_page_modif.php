<?php
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
<h1 class="text-center"><span class="Titre">Quelle page voulez-vous modifier ? </span></h1>
<?php 
        $id_histoire = $_GET["id_histoire"];

        if($BDD) {
            // on cherche les infomrations concernant l'histoire
            $maRequete_page = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
            $curseur = $BDD->prepare($maRequete_page);
            $curseur->execute(array($id_histoire));
            while($tuple = $curseur->fetch())
            {?>
            
            <a href=<?="modif_page.php?id_page=".$tuple["id_page"]."&id_histoire=".$id_histoire?>><p><h3><span class="presentation"><?=$tuple["page_titre"]?></span></h3></p>
            
            <?php
            }
        }
    ?>
</div>
</body>
</html>