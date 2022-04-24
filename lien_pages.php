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
        ?>
        <form method="POST">
        <?php
        while($tuple = $curseur->fetch()) {
        ?>
            <h3><?=$tuple["page_titre"]?></a></h3>
            <label for="choix_1"> Choix 1 : </label>
            <select name=<?="choix_1_".$tuple2["id_page"]?> id=<?="choix_1_".$tuple2["id_page"]?>>
                <?php 
                        // refaire une requete identique à la premiere afin de pouvoir afficher tous les pages
                        $maRequete2 = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
                        $curseur2 = $BDD->prepare($maRequete2);
                        $curseur2->execute(array($id_histoire));
                        while($tuple2 = $curseur2->fetch()) 
                        {?>
                            <option value=<?=$tuple2["id_page"]?>> <?=$tuple2["page_titre"]?> </option> 
                        <?php }
                ?>
            </select><br/>
            <label for="choix_2"> Choix 2 : </label>
            <select name=<?="choix_2_".$tuple2["id_page"]?> id=<?="choix_2_".$tuple2["id_page"]?>>
                <?php 
                        // refaire une requete identique à la premiere afin de pouvoir afficher tous les pages
                        $maRequete3 = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
                        $curseur3 = $BDD->prepare($maRequete3);
                        $curseur3->execute(array($id_histoire));
                        while($tuple3 = $curseur3->fetch()) 
                        {?>
                            <option value=<?=$tuple3["id_page"]?>> <?=$tuple3["page_titre"]?> </option> 
                        <?php }
                ?>
            </select>
        <?php
        }
        ?>
        <button type="submit" >Enregistrer</button>
        </form>
</div>
        <?php 
            if(!empty($_POST))
            {
                $maReq_update = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
                $curseur = $BDD->prepare($maRequete);
                $curseur->execute(array($id_histoire));
                while($tuple = $curseur->fetch()) {

                    // associer les id des pages suivantes la page actuelle aux choix
                    $req = $BDD->prepare('UPDATE `page` SET `choix_1` = :_choix_1 AND `choix_2` = :_choix_2  WHERE id_page = :_id');
                    $req->execute(array(
                    '_choix_1' =>$_POST["choix_1_".$tuple2["id_page"]],
                    '_choix_2' =>$_POST["choix_2_".$tuple2["id_page"]],
                    '_id'=> $tuple["id_page"]
                ));

                }
            }
        
        ?>

</body>
</html>