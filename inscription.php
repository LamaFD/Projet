
<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>

<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h2 class="text-center">Inscription</h2>
    <main class="well">
        <form class="text-center" method="POST">
        <input type="text" name="login" id="login" placeholder="Entrez votre login" require></br>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe" require></br>
        <input type="password" name="mdp2" id="mdp2" placeholder="Remettez votre mot de passe" require></br>
        
        <button type="submit" >S'inscrire</button>
        <button type="reset">Effacer</button><br/>
        </form>
    </main>

    <?php
        if(!empty($_POST))
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
                    echo "Vous avez deja un compte";
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
                }

                }
            }
            else
            {
                echo "Vos mots de passes ne sont pas identiques";
            }
        }    
        ?>

</html>