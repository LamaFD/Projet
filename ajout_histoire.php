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
Première partie
<table>
            <tr><td><label for="premiere_page">Première page : </label></td><td><textarea cols='' rows='' name="premiere_page" id="premiere_page"></textarea></td></tr>
            <tr><td></td><td>Choix 1 :<select name="liaison1" id="liaison1"><option value="1">1</option> 
            <option value="2">2</option></select>
            Choix 2 :<select name="liaison2" id="liaison2"><option value="1">1</option><option value="2">2</option></select></td></tr>
</table>

<table>
            
            <tr><td>Paragraphe 1 : </td></tr>
            <tr><td><label for="paragraphe1">Votre paragraphe : </label></td><td><textarea cols='' rows='' name="paragraphe1" id="paragraphe1"></textarea></td></tr>
</tr>
</table>
    </div>
</body>
</html>

