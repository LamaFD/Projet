<?php 
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

if($BDD) 
{
    $req_update = $BDD->prepare("UPDATE  `histoire` SET titre=:_titre , resume_histoire=:_resume, nbr_vie=:_vie WHERE id_histoire=:_id_histoire");
    $req_update->execute(array(
        '_titre' => $_POST["titre"],
        '_resume' => $_POST["resume"],
        '_vie' => $_POST["nbr_vie"],
        '_id_histoire' => $_POST["id_histoire"]
        ));                    
}
redirect("choix_page_modif.php?id_histoire=".$_POST["id_histoire"]);