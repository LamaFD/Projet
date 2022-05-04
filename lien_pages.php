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
        $nb_choix=1;
        $maRequete = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
        $curseur = $BDD->prepare($maRequete);
        $curseur->execute(array($id_histoire));
        }
        ?>
        <form method="POST">
        <?php
        while($tuple = $curseur->fetch()) {
        $nb_choix=1; // remise à 1 le nombre de choix 
        ?>
            <h3><?=$tuple["page_titre"]?></a></h3>
            <?php while($nb_choix<=$tuple["nbr_choix"]) 
            {?>
            <label for=<?="choix_".$nb_choix?>> <?="Choix ".$nb_choix?> </label>
            <input type="text" name=<?="choix_".$nb_choix."_texte"?> id=<?="choix_".$nb_choix."_texte"?> size="35" placeholder="texte representant le choix "/>
            <select name=<?="choix_".$nb_choix."_".$tuple["id_page"]?> id=<?="choix_".$nb_choix."_".$tuple["id_page"]?>>
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
            
        <?php
        $nb_choix++; // augmenter nb_choix de 1 
        }}
        ?>
        </br>
        <button type="submit" name="submit">Enregistrer</button>
        </form>
</div>
        <?php 
            if(isset($_POST["submit"]))
            {
                echo "hi";
                $maReq = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
                $curseur_update = $BDD->prepare($maReq);
                $curseur_update->execute(array($id_histoire));
                while($tuple = $curseur_update->fetch())
                {
                    echo "enter here";
                    $nb_choix=1;
                    While($nb_choix<=$tuple["nbr_choix"]) 
                    {
                        echo $_POST["choix_".$nb_choix."_".$tuple["id_page"]];
                        echo $_POST["choix_".$nb_choix."_texte"];
                        $req = $BDD->prepare('INSERT INTO `choix` (`id_page_associe`,`id_page_suivante`,`texte_choix`) VALUES (:_id_page_associe, :_id_page_suivante, :_texte_choix)' );
                        $req->execute(array(
                                '_id_page_associe'=> $tuple["id_page"],
                                '_id_page_suivante'=> $_POST["choix_".$nb_choix."_".$tuple["id_page"]],
                                '_texte_choix' => $_POST["choix_".$nb_choix."_texte"]
                        ));
                        $nb_choix++;
                    }
                }
                
                
            }
        
        ?>

</body>
</html>