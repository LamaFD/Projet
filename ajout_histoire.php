<!doctype html>
<html>
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    <div class="container">
        <form action="">
            <label for="titre_page"> Titre de votre page : </label><br/><input type="text" name="titre_page" id="titre_page" size="35"/></br>
            <input type="radio" name="Premier_page" id="Premier_page">
            <label for="Premier_page">Est la premiere page</label><br/>
            <label for="page"> Votre paragraphe : </label><br/><textarea cols='90' rows='20' name="page" id="page"></textarea><br/>
            Choix 1 :<select name="liaison1" id="liaison1"><option value="1">1</option> 
            <option value="2">2</option></select>
            Choix 2 :<select name="liaison2" id="liaison2"><option value="1">1</option><option value="2">2</option></select><br/>
            <input type="submit" value="Ajouter un paragraphe" formaction="ajout_histoire.php"/>
            <input type="submit" value="Finir mon histoire" formaction="histoire_creee.php"/>
</form>
    </div>
</body>
</html>

