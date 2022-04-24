<?php
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
        $id_histoire =$_SESSION["id_histoire"];
        $maRequete = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
        $curseur = $BDD->prepare($maRequete);
        $curseur->execute(array($id_histoire));
        }

        while($tuple = $curseur->fetch()) {
        ?>
            <h3><?=$tuple["page_titre"]?></a></h3>
        <?php
        }
        ?>
</div>
</body>
</html>