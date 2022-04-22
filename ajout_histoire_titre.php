<!doctype html>
<html>
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>

<body>
    <div class="container">
        <form action="">
        <h3>Informations générales sur votre histoire</h3>
            <table>

                <tr>
            <td><label for="titre">Titre : </label></td><td><input type="text" name="titre" id="titre" size="35"/></td></tr>
            <tr><td><label for="resume">Résumé : </label></td><td><br/><textarea cols='50' rows='7' name="premiere_page" id="premiere_page"></textarea><br/></td></tr>
            <tr><td><label for="nbr_vie"> Nombre de vies en début d'aventure : </label></td><td><input type="number" name="nbr_vie" id="nbr_vie" /></td></tr>
</table>
<input type="submit" value="Ajouter un paragraphe" formaction="ajout_histoire.php"/>

</form>
</body>
</html>