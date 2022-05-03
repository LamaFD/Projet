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
    //verifier que des pages sont liées à l'histoire
    $req_verifier = "SELECT * FROM `page` WHERE id_histoire=?";
    $curseur_verifier = $BDD->prepare($req_verifier);
    $curseur_verifier->execute(array($id_histoire));
    $nb = $curseur->rowCount();
    if($nb!=0)
    {
        // Supprimer les pages associés à l'histoire
        $maRequete_pages = "DELETE FROM `page` WHERE id_histoire=?";
        $curseur = $BDD->prepare($maRequete_pages);
        $curseur->execute(array($id_histoire));
    }
    }
redirect('admin.php');

