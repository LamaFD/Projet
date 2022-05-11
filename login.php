<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
    <h1 class="text-center">
        <span class="Titre">
            Connexion
        </span>
    </h1>
    <form class="text-center" method="POST">
    <br/>
        <input type="text" name="login" id="login" placeholder="Entrez votre login" require size="27"></br>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe" require size="27"></br>
        <span class="presentation">Etes vous un administrateur ?</span><br/>
        <input type="radio" name="Admin" value="Oui"> Oui
        <input type="radio" name="Admin" value="Non" checked> Non<br>
        <button type="submit">Se connecter</button>
        <button type="reset">Effacer</button><br/>
        <input type="submit" name="inscription" value="Inscription" formaction="inscription.php">
    </form>

    <?php
        if(!empty($_POST))
        {
            if($_POST["Admin"]=="Oui")
            {
                $admin="admin";
            }
            if($_POST["Admin"]=="Non")
            {
                $admin="user";
            }
            $login =$_POST["login"];
            $mdp = $_POST["mdp"];

            if($BDD) {
            $maRequete = "SELECT * FROM user WHERE user_login=? AND user_mdp=? AND user_role=?";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($login,$mdp,$admin));
            $tuple = $curseur->fetch();
            // si l'utilisateur existe dans la base de données
            if ($curseur->rowCount() == 1) {
                $_SESSION['role']=$admin;
                $_SESSION['id_user']= $tuple["id_user"];
                redirect("index.php");
            }
            // sinon
            else if ($curseur->rowCount() == 0)
            {?>
                <div class="text-center alert alert-danger" role="alert" >
                <strong>Attention !</strong> Vous n'êtes pas inscrit
                </div>
            <?php }
            }}
        ?>
    </html>

