<!doctype html>
<html>
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    <div class="container">
        <form action="">
            <label for="titre_paragraphe"> Titre de votre paragraphe : </label><br/><input type="text" name="titre_paragraphe" id="titre_paragraphe" size="35"/></br>
            <label for="premiere_page"> Votre paragraphe : </label><br/><textarea cols='90' rows='20' name="premiere_page" id="premiere_page"></textarea><br/>
            Choix 1 :<select name="liaison1" id="liaison1"><option value="1">1</option> 
            <option value="2">2</option></select>
            Choix 2 :<select name="liaison2" id="liaison2"><option value="1">1</option><option value="2">2</option></select><br/>
            <input type="submit" value="Ajouter un paragraphe" formaction="ajout_histoire.php"/>
            <input type="submit" value="Finir mon histoire" formaction="histoire_creee.php"/>
</form>
    </div>
</body>
</html>

