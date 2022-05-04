<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

if($BDD) {
    $id_histoire = $_GET["id_histoire"];
    // modifier l'etat de la visibilité
    // chercher l'histoire
    $maRequete_histoire = "SELECT Cache FROM histoire WHERE id_histoire=?";
    $curseur = $BDD->prepare($maRequete_histoire);
    $curseur->execute(array($id_histoire));
    while($tuple = $curseur->fetch()) {
    //Si l'histoire est caché
    if($tuple["Cache"]==0)
    {
        $req = $BDD->prepare('UPDATE  histoire SET Cache=:_cache WHERE id_histoire=:_id');
        $req->execute(array(
            ':_cache' => 1,
            '_id' => $id_histoire,
            ));             
    }
    //Si l'histoire n'est pas caché
    else
    {
        $req = $BDD->prepare('UPDATE  histoire SET Cache=:_cache WHERE id_histoire=:_id');
        $req->execute(array(
            ':_cache' => 0,
            '_id' => $id_histoire
            ));   
    }
    }}
redirect('admin.php');