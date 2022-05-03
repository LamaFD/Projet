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
            
            <input type="text" name="choix_1_texte" id="choix_1_texte" size="35" placeholder="texte representant le choix 1"/>
            <select name=<?="choix_1_".$tuple["id_page"]?> id=<?="choix_1_".$tuple["id_page"]?>>
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
            <input type="text" name="choix_2_texte" id="choix_2_texte" size="35" placeholder="texte representant le choix 2"/>
            <select name=<?="choix_2_".$tuple["id_page"]?> id=<?="choix_2_".$tuple["id_page"]?>>
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
        </br>
        <button type="submit" >Enregistrer</button>
        </form>
</div>
        <?php 
            if(!isset($_POST))
            {
                echo $choix_1=$_POST["choix_1_55"];
                $maReq_update = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
                $curseur_update = $BDD->prepare($maReq_update);
                $curseur_update->execute(array($id_histoire));
                while($tuple_update = $curseur_update->fetch()) {
                    $choix_1=$_POST["choix_1_".$tuple_update["id_page"]];
                    $choix_2=$_POST["choix_2_".$tuple_update["id_page"]];

                    // associer les id des pages suivantes la page actuelle aux choix
                    $req = $BDD->prepare('UPDATE `page` SET `choix_1` = :_choix_1 AND `choix_2` = :_choix_2  WHERE id_page = :_id');
                    $req->execute(array(
                    '_choix_1' => $choix_1,
                    '_choix_2' => $choix_2,
                    '_id'=> $tuple_update["id_page"]
                ));

                }
            }
        
        ?>

</body>
</html>