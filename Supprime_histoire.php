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
    // Supprimer les pages associés à l'histoire
    $maRequete_pages = "DELETE FROM 'page' WHERE id_histoire=?";
    $curseur = $BDD->prepare($maRequete_pages);
    $curseur->execute(array($id_histoire));
    }
echo "hi";
redirect('admin.php');

