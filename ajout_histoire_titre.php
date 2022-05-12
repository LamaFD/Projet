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
    <main class="container">
        <h1 class="text-center">
            <span class="Titre">
                Informations générales sur votre histoire
            </span>
        </h1>
    <form enctype="multipart/form-data" class="text-center" method="POST" action="ajout_histoire_action.php">
        <table>
            <tr>
                <td>
                    <label for="titre">
                        Titre : 
                    </label>
                </td>
                <td>
                    <input type="text" name="titre" id="titre" size="50" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="resume">
                        Résumé : 
                    </label>
                </td>
                <td>
                    <br/>
                    <textarea cols='50' rows='7' name="resume" id="resume" required></textarea>
                    <br/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nbr_vie">
                         Nombre de vies en début d'aventure : 
                    </label>
                </td>
                <td>
                    <input type="number" name="nbr_vie" id="nbr_vie" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="image">
                         Image : 
                    </label>
                </td>
                <td>
                    <input type="file" name="image" id="image"/>
                </td>
            </tr>
        </table>
        <button type="submit" >Ajouter un paragraphe</button></br>
    </form>
    </main>
</body>
</html>