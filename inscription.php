
<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle4.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h1 class="text-center"><span class="Titre">Inscription</span></h1>
    
        <form class="text-center" method="POST">
        <input type="text" name="login" id="login" placeholder="Entrez votre login" require size="35"></br>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe" require size="35"></br>
        <input type="password" name="mdp2" id="mdp2" placeholder="Confirmez votre mot de passe" require size="35"></br>
        
        <button type="submit" >S'inscrire</button>
        <button type="reset">Effacer</button><br/>
        </form>
    

    <?php
        if(!empty($_POST) && !empty($_POST["mdp2"]))
        {
            if($_POST["mdp"]==$_POST["mdp2"])
            {
                $login =$_POST["login"];
                $mdp = $_POST["mdp"];
                $admin = "user";
    
                if($BDD) {
                $maRequete = "SELECT * FROM user WHERE user_login=? AND user_mdp=? AND user_role=?";
                $curseur = $BDD->prepare($maRequete);
                $curseur->execute(array($login,$mdp,$admin));
                if ($curseur->rowCount() == 1) {
                    ?>
                    <div class="alert alert-warning" role="alert">
                    <strong>Warning !</strong> Vous avez deja un compte !
                    </div>
                    <?php
                }
                else
                {
                    $req = $BDD->prepare('INSERT INTO `user` (`user_login`, `user_mdp`,`user_role`) VALUES (:_login, 
                    :_mdp,:_role)');
                    $req->execute(array(
                    '_login' => $login, 
                    '_mdp' => $mdp,
                    '_role' => "user" 
                    )); 
                    redirect("login.php");
                }

                }
            }
            else
            {?>
                <div class="alert alert-danger" role="alert">
                <strong>Warning!</strong> Vos mots de passes ne sont pas identiques !
                </div>
                <?php
            }
        }    
        ?>

</html>