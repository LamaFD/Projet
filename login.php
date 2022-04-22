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
        <input type="text" name="login" id="login" placeholder="Entrez votre login" require></br>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe" require></br>
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
            if(!empty($_POST["AdminOui"]))
            {
                $admin="admin";
            }
            if(!empty($_POST["AdminNon"]))
            {
                $admin="user";
            }
            $login =$_POST["login"];
            $mdp = $_POST["mdp"];

            if($BDD) {
            $maRequete = "SELECT * FROM user WHERE user_login=? AND user_mdp=? AND user_role=?";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($login,$mdp,$admin));
            if ($curseur->rowCount() == 1) {
                $_SESSION['role']=$admin;
                redirect("accueil.php");
            }
            }}
        ?>
    
    </html>

