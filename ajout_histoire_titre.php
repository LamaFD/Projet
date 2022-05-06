<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle4.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>

<body>
    <main class="container">
    <h1 class="text-center"><span class="Titre">Informations générales sur votre histoire</span></h1>
    <form enctype="multipart/form-data" class="text-center" method="POST">
        <table>
             <tr><td><label for="titre">Titre : </label></td><td><input type="text" name="titre" id="titre" size="50"/></td></tr>
            <tr><td><label for="resume">Résumé : </label></td><td><br/><textarea cols='50' rows='7' name="resume" id="resume"></textarea><br/></td></tr>
            <tr><td><label for="nbr_vie"> Nombre de vies en début d'aventure : </label></td><td><input type="number" name="nbr_vie" id="nbr_vie" /></td></tr>
            <tr><td><label for="image"> Image : </label></td><td>
                <input type="file" name="image" id="image"/></td></tr>    
        </table>
    <button type="submit" >Ajouter un paragraphe</button></br>
    </form>
    </main>
</body>

<?php 
    if(!empty($_POST))
    {
        print_r($_FILES);
        print_r($_POST);
   
        $titre =$_POST["titre"];
        $resume = $_POST["resume"];
        $nbr_vie =$_POST["nbr_vie"];
        if(isset($FILES["image"]))
        {
            $image=$_POST["image"];
            $tmpFile = $_FILES['image']['tmp_name'];
                if (is_uploaded_file($tmpFile)) {
                // upload movie image
                $image2 = basename($_FILES['image']['name']);
                $uploadedFile = "images/$image2";
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile);
                }
        }
        else
        {
            $image="livre.png";
        }
        

        if($BDD) {
            $maRequete = "SELECT * FROM histoire WHERE titre=? AND resume_histoire=? AND nbr_vie=?";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($titre,$resume,$nbr_vie));
            if ($curseur->rowCount() == 1) {
                echo "Une histoire avec ces informations existe deja";
            }
            else
            {
                $req = $BDD->prepare('INSERT INTO `histoire` (`titre`, `resume_histoire`,`nbr_vie`,`hist_img`) VALUES (:_titre, 
                :_resume,:_vies,:_image)');
                $req->execute(array(
                '_titre' => $titre, 
                '_resume' => $resume,
                '_vies' => $nbr_vie,
                '_image' => $image,
                )); 
                // on refait la requete afin de pouvoir retrouver l'id de l'histoire, ce qui va servir lorsequ'on veut enregistrer les pages
                $curseur->execute(array($titre,$resume,$nbr_vie));
                $tuple = $curseur->fetch();
                $_SESSION["id_histoire"]=$tuple["id_histoire"];

                redirect("ajout_page.php");
            } 
        }}
    ?>



</html>