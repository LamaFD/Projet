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
        <form method="POST">
            <?php 
                for($i=0; $i<$_SESSION["nbr_chapitres"];$i++)
                {?> 
                    </br>
                    <label for="titre_page"> Titre de votre page : </label><br/><input type="text" name="titre_page" id="titre_page" size="35"/></br>
                    <label for="page"> Votre paragraphe : </label><br/><textarea cols='90' rows='20' name="page" id="page"></textarea><br/>
                    </br>
                <?php ;}
            ?>
            <input type="button" name="ajout_page" id="ajout_page" value="ajouter une page (vous allez perdre tout ce que vous avez deja redigé)">
            <input type="button" name="fini" id="fini" value="Fini"?>>
            
            <?php
                if(!empty($_POST["ajout_page"]))
                { 
                    
                    $_SESSION["nbr_chapitres"]++;
                
                }
            ?>
            
</form>
    </div>
</body>
</html>