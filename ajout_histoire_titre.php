<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>

<body>
    <div class="container">
        <form method="POST">
        <h3>Informations générales sur votre histoire</h3>
            <table>
                <tr>
            <td><label for="titre">Titre : </label></td><td><input type="text" name="titre" id="titre" size="35"/></td></tr>
            <tr><td><label for="resume">Résumé : </label></td><td><br/><textarea cols='50' rows='7' name="resume" id="resume"></textarea><br/></td></tr>
            <tr><td><label for="nbr_vie"> Nombre de vies en début d'aventure : </label></td><td><input type="number" name="nbr_vie" id="nbr_vie" /></td></tr>
</table>
<button type="submit" >Ajouter un paragraphe</button>

<?php 
    if(!empty($_POST))
    {
        $$_SESSION["titre"]=$_POST["titre"];
        $$_SESSION["resume"]=$_POST["resume"];
        $$_SESSION["nbr_vie"]=$_POST["nbr_vie"];

        $titre =$_POST["titre"];
        $resume = $_POST["resume"];
        $nbr_vie =$_POST["nbr_vie"];

        if($BDD) {
            $maRequete = "SELECT * FROM histoire WHERE titre=? AND resume_histoire=? AND nbr_vie=?";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($login,$mdp,$admin));
            if ($curseur->rowCount() == 1) {
                echo "Une histoire avec ces informations existe deja";
            }
            else
            {
                $req = $BDD->prepare('INSERT INTO `histoire` (`titre`, `resume_histoire`,`nbr_vie`) VALUES (:_titre, 
                :_resume,:_vies)');
                $req->execute(array(
                '_titre' => $titre, 
                '_resume' => $resume,
                '_vies' => $nbr_vie 
                ));
                redirect("ajout_histoire.php"); 
            }
        }}
    ?>
?>

</form>
</body>
</html>