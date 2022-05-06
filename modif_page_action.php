<?php 
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

if($BDD) 
{
    $fin=0;
    if(isset($_POST["fin_chemin_oui"]))
    {
        $fin=1;
    }
    $req_update = $BDD->prepare("UPDATE  `page` SET page_titre=:_titre , modif_vie=:_vie, texte=:_texte, Fin=:_fin WHERE id_page=:_id_page");
    $req_update->execute(array(
        '_titre' => $_POST["titre_page"],
        '_vie' => $_POST["modif_vie"],
        '_texte' => $_POST["page"],
        '_fin' => $fin,
        '_id_page' => $_POST["id_page"]
        ));  
    if(isset($_POST["Modifier"]))
    {
        redirect("choix_page_modif.php?id_histoire=".$_POST["id_histoire"]);
    } 
    if(isset($_POST["Choix"]))
    {
        redirect("modif_choix.php?id_histoire=".$_POST["id_histoire"]."&id_page=".$_POST["id_page"]);
    }                 
}
