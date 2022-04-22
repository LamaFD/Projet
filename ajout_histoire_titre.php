<!doctype html>
<html>
<?php require_once "includes/head.php"; ?>

<body>
    <div class="container">
        <?php require_once "includes/header.php"; ?>
        <form action="">
            
            <table>
                <tr><td>Informations générales </td></tr>
                <tr>
            <td><label for="titre">Titre : </label></td><td><input type="text" name="titre" id="titre" size="35"/></td></tr>
            <tr><td><label for="resume">Résumé : </label></td><td><input type="text" name="resume" id="resume" size="35"/></td></tr>
            <tr><td><label for="nbr_vie"> Nombre de vies en début d'aventure : </label></td><td><input type="number" name="nbr_vie" id="nbr_vie" /></td></tr>
</table>
<input type="submit" value="Ajouter un paragraphe"/>
</body>
</html>