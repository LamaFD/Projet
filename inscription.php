<?php echo "Lama" ?>

<?php
require_once "includes/functions.php";
require("connect.php");
session_start();
?>

<h2 class="text-center">Connexion</h2>
    <main class="well">
        <form method="POST">
        <input type="text" name="login" id="login" placeholder="Entrez un login"></br>
        <input type="password" name="mdp" id="mdp" placeholder="Entrez une mot de passe"></br>
        <button type="submit">S'inscrire</button>
        </form>
    </main>