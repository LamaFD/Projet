<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>

<div class="container">
    <h1 class="text-center">
        <span class="Titre">
            Ajoutez les liens entre vos paragraphes
        </span>
    </h1>
    <?php 
    if($BDD) {
        $id_histoire =$_SESSION["id_histoire"];
        $nb_choix=1;
        $maRequete = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
        $curseur = $BDD->prepare($maRequete);
        $curseur->execute(array($id_histoire));
        }
        ?>
        <form class="text-center" method="POST" action="lien_pages_action.php">
        <?php
        while($tuple = $curseur->fetch()) {
        $nb_choix=1; // remise à 1 le nombre de choix 
        ?>
            <h3><?=$tuple["page_titre"]?></a></h3>
            <?php while($nb_choix<=$tuple["nbr_choix"]) 
            {?>
            <label for=<?="choix_".$nb_choix?>> <?="Choix ".$nb_choix?> </label>
            <input type="text" name=<?="choix_".$nb_choix."_".$tuple["id_page"]."_"."_texte"?> id=<?="choix_".$nb_choix."_".$tuple["id_page"]."_"."_texte"?> size="35" placeholder="texte representant le choix "/>
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
</body>
</html>