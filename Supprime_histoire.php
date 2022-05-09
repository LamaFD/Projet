<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

if($BDD) {
    $id_histoire = $_GET["id_histoire"];
    // supprimer l'histoire
    $maRequete_histoire = "DELETE FROM histoire WHERE id_histoire=?";
    $curseur = $BDD->prepare($maRequete_histoire);
    $curseur->execute(array($id_histoire));
    //trouver les pages liées à l'histoire
    $req_page = "SELECT * FROM `page` WHERE id_histoire=?";
    $curseur_page = $BDD->prepare($req_page);
    $curseur_page->execute(array($id_histoire));
    while($tuple_page = $curseur_page->fetch())
    {
        // supprimer les choix liées aux pages
        $maRequete_choix = "DELETE FROM `choix` WHERE id_page_associe=?";
        $curseur_choix = $BDD->prepare($maRequete_choix);
        $curseur_choix->execute(array($tuple_page["id_page"]));
    }
    // supprimer les pages liées à l'histoire 
    $maRequete_pages = "DELETE FROM `page` WHERE id_histoire=?";
    $curseur_supp_page = $BDD->prepare($maRequete_pages);
    $curseur_supp_page->execute(array($id_histoire));
    }
redirect('admin.php');

