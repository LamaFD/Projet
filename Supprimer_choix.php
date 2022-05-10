<?php 
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

if($BDD) 
{
    $id_choix =$_GET["id_choix"];
    // on retrouve la page associé au choix
    $Req_choix = "SELECT * FROM `choix` WHERE id_choix=?";
    $choix = $BDD->prepare($Req_choix);
    $choix->execute(array($id_choix));
    $tuple = $choix->fetch();
    $id_page_associe = $tuple["id_page_associe"];
    // on modifie le nombre de choix dans la page
    $req = $BDD->prepare('UPDATE `page` SET nbr_choix=(nbr_choix-1) WHERE id_page=:_id');
    $req->execute(array(
        '_id' => $id_page_associe,
        )); 
    // on supprime le choix 
    $Supprimer_choix = "DELETE FROM `choix` WHERE id_choix=?";
    $Supprimer_choix = $BDD->prepare($Supprimer_choix);
    $Supprimer_choix->execute(array($id_choix));           
       
    redirect("modif_choix.php?id_histoire=".$_POST["id_histoire"]."&id_page=".$_POST["id_page"]);        
}    
