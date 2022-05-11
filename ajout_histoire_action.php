<?php 
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

$titre =$_POST['titre'];
$resume = $_POST['resume'];
$nbr_vie =$_POST['nbr_vie'];
if(isset($_FILES['image']))
{
    $image=$_FILES['image']['name'];
    if($image!=''){
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
        $image='livre.png';
    }
}                

if($BDD) 
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
    $maRequete = "SELECT * FROM histoire WHERE titre=? AND resume_histoire=? AND nbr_vie=?";
    $curseur = $BDD->prepare($maRequete);
    $curseur->execute(array($titre,$resume,$nbr_vie));
    $tuple = $curseur->fetch();
    $_SESSION["id_histoire"]=$tuple["id_histoire"];

    redirect("ajout_page.php"); 
             
}                