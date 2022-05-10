<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h1 class="text-center"><span class="Titre">Votre page</span></h1>
<div class="container">
    <form class="text-center" method="POST" action="modif_choix_action.php">
    <?php 
        $id_page = $_GET["id_page"];
        $id_histoire = $_GET["id_histoire"];
        if($BDD) {
            // on cherche la page (afin d'avoir le nombre de choix)
            $maRequete_page = "SELECT * FROM `page` WHERE id_page=?";
            $curseur = $BDD->prepare($maRequete_page);
            $curseur->execute(array($id_page));
            $tuple = $curseur->fetch();
            $nb_choix =$tuple["nbr_choix"];
            // chercher les informations concernant les choix
            $maRequete_choix = "SELECT * FROM `choix` WHERE id_page_associe=?";
            $curseur_choix = $BDD->prepare($maRequete_choix);
            $curseur_choix->execute(array($id_page));
            $nb=0;
            while($choix = $curseur_choix->fetch())
            {
                $nb++;?>
                <label for=<?="choix_".$nb?>> <?="Choix ".$nb?> </label>
                <input type="text" name=<?="choix_".$nb."_texte"?> id=<?="choix_".$nb."_texte"?> size="35" value="<?= $choix["texte_choix"] ?>"/>
                <select name=<?="choix_".$nb."_pageSuivante"?> id=<?="choix_".$nb."_pageSuivante"?> value=<?= $choix["id_page_suivante"] ?>>
                    <?php 
                            // refaire une requete identique à la premiere afin de pouvoir afficher tous les pages
                            $maRequete2 = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
                            $curseur2 = $BDD->prepare($maRequete2);
                            $curseur2->execute(array($_GET["id_histoire"]));
                            while($tuple2 = $curseur2->fetch()) 
                            {?>
                                <option value=<?=$tuple2["id_page"]?>> <?=$tuple2["page_titre"]?> </option>

                            <?php }
                    ?>
                </select><br/>
                <input type="submit" name="Supprimer_choix" value="Supprimer le choix" formaction=<?="Supprimer_choix.php?id_choix=".$choix["id_choix"]."&id_page=".$id_page?>>
                <br/>
                
            <?php }
            while($nb<$nb_choix) // si il doit avoir plus de choix que celle deja existantes
                {
                    $nb++;?>
                    <label for=<?="choix_".$nb?>> <?="Choix ".$nb?> </label>
                    <input type="text" name=<?="choix_".$nb."_texte"?> id=<?="choix_".$nb."_texte"?> size="35" value="<?= $choix["texte_choix"] ?>"/>
                    <select name=<?="choix_".$nb."_pageSuivante"?> id=<?="choix_".$nb."_pageSuivante"?>>
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
                    <input type="hidden" id="id_choix" name="id_choix" value=<?=$choix["id_choix"]?>>
                    <button type="submit" name="Supprimer_choix">Supprimer le choix</button></br>
                    
          <?php }
            
            ?>
            <input type="hidden" id="id_histoire" name="id_histoire" value=<?=$id_histoire?>>
            <input type="hidden" id="id_page" name="id_page" value=<?=$id_page?>>
            <input type="hidden" id="nbr_choix_actuelle" name="nbr_choix_actuelle" value=<?=$nb_choix?>>
            <button type="submit" name="Modifier">Confirmer les modifications</button>
            <button type="submit" name="Ajouter_choix">Ajouter un choix</button><br/>
  <?php }
    ?>
    </form>
</div>
</html>