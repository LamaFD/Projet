<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<body>
    <?php 
    $_SESSION['recap'] = array(); // initialisation afin de pouvoir l'utiliser lorseque l'utilisateur va lire une histoire
    $id_histoire = $_GET["id_histoire"];
    $req = $BDD->prepare('UPDATE  histoire SET nbr_joue=(nbr_joue+1) WHERE id_histoire=:_id');
    $req->execute(array(
        '_id' => $id_histoire,
        ));
    redirect("histoire_enCours.php?id_page=".$_GET["id_page"]."&vie=".$_GET["vie"]."&id_histoire=".$_GET["id_histoire"]) ;               
    ?>
</body>
</html>