<?php
require_once "includes/functions.php";
require("connect_bdd.php");

session_start();
?>

<h2 class="text-center">Connexion</h2>
    <main class="well">
        <form method="POST">
        <input type="text" name="login" id="login" placeholder="Entrez votre login"></br>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe"></br>
        <button type="submit">Se connecter</button>
        </form>
    </main>

    <?php
        if(!empty($_POST))
        {
        if($BDD) {
        $maRequete = "SELECT Count(*) AS nb FROM user WHERE usr_login=:_log AND usr_password=:mdp";
        $curseur = $BDD->query($maRequete);
        $curseur->execute(array(
            "_log" => $_POST["login"],
            "mdp" => $_POST["mdp"]
           ));
        }
        ?>
    
        <?php
        
            $tuple = $curseur->fetch();
            if($tuple["nb"]!=0)
            {
                redirect("accueil.php"); 
            }   
        }
    ?>

