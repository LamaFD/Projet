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
                Ecrivez votre histoire
            </span>
        </h1>
        <form class="text-center" method="POST" action="ajout_page_action.php">
                <label for="titre_page"> 
                    Titre de votre page : 
                </label>
                    <input type="text" name="titre_page" id="titre_page" size="35" require/>
                </br>
                <label for="modif_vie">
                     Modification du vie : 
                    </label>
                    <input type="number" name="modif_vie" id="modif_vie" size="35" require/>
                </br>
                <?php 
                if(empty($_GET["id_histoire_modif"])) // si l'ajout de page n'est pas demandé lors d'une modification 
                {?>
                    <label for="nbr_choix"> 
                        Nombre de choix associés à cette page : 
                    </label>
                    <input type="number" name="nbr_choix" id="nbr_choix" size="35" require/></br>
          <?php }
                else
                {?>
                    <input type="hidden" id="nbr_choix" name="nbr_choix" value=<?=0?>>
                    <input type="hidden" id="id_histoire_modif" name="id_histoire_modif" value=<?= $_GET["id_histoire_modif"] ?>>
          <?php }
                ?>
                
                <label for="page" class="margin-left">
                     Votre paragraphe : 
                    </label>
                    <br/>
                    <textarea cols='80' rows='20' name="page" id="page" require></textarea>
                    <br/>
    
                <label for="Premier_page">
                    La premiere page ?
                </label>
                <br/>
                <input type="radio" name="Premier_page" value="Oui"> Oui
                <input type="radio" name="Premier_page" value="Non" checked> Non<br>
                
                <label for="fin_chemin">Fin d'un chemin ?</label><br/>
                <input type="radio" name="fin_chemin" value="Oui"> Oui
                <input type="radio" name="fin_chemin" value="Non" checked> Non<br>

                <?php 
                if(empty($_GET["id_histoire_modif"])) // si l'ajout de page n'est pas demandé lors d'une modification 
                {?>
                    <button type="submit" name="ajout">Ajouter une page</button>
          <?php }
                ?>
                
                <button type="submit" name="finit">Fin</button> 
            
        </form>
    </div>

</body>
</html>