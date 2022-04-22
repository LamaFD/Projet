<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h2 class="text-center">Connexion</h2>
    <main class="well">
        <form class="text-center" method="POST">
        <input type="text" name="login" id="login" placeholder="Entrez votre login"></br>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe"></br>
        Etes vous un admin ?<br/>
        <input type="radio" name="AdminOui" id="AdminOui">
        <label for="AdminOui">Oui</label><br/>
        <input type="radio" name="AdminNon" id="AdminNon">
        <label for="AdminNon">Non</label><br/>
        <button type="submit">Se connecter</button>
        <button type="reset">Annuler</button>
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
    </html>

