<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle2.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<h2 class="text-center"><span class="Titre">Connexion</span></h2>
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
        <button type="reset">Effacer</button><br/>
        <input type="submit" name="inscription" value="inscription" formaction="inscription.php">
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
            else if ($curseur->rowCount() == 0)
            {
                echo "Vous n'etes pas inscrit !";
            }
            }}
        ?>
    
    </html>

