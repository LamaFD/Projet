<?php 
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

if($BDD) 
{
    $id_histoire =$_POST["id_histoire"];
    $id_page =$_POST["id_page"];
    print_r($_POST["choix_1_pageSuivante"]);
    echo "next";
    print_r($_POST["choix_2_pageSuivante"]);
    if(isset($_POST["Modifier"])) // si l'utilisateur veut confirmer ses modifications
    {
        $nb=1;
        // on retrouve les choix associés à la page
        $maReq_choix = "SELECT * FROM `choix` WHERE id_page_associe=? ORDER BY id_choix";
        $curseur_choix = $BDD->prepare($maReq_choix);
        $curseur_choix->execute(array($id_page));
        while($tuple = $curseur_choix->fetch())
        {
            $req_update = $BDD->prepare("UPDATE  `choix` SET id_page_suivante=:_page_suivante , texte_choix=:_texte WHERE id_choix=:_id_choix ");
            $req_update->execute(array(
                '_page_suivante' => $_POST["choix_".$nb."_pageSuivante"],
                '_texte' => $_POST["choix_".$nb."_texte"],
                '_id_choix' => $tuple["id_choix"]
                )); 
            $nb++;
        }    
        redirect("choix_page_modif.php?id_histoire=".$_POST["id_histoire"]);
    }

    if(isset($_POST["Ajouter_choix"]))
    {
        $nv_nbr_choix = $_POST["nbr_choix_actuelle"]+1;
        // on change le nombre de choix associés à la page
        $maReq_modif = $BDD->prepare("UPDATE  `page` SET nbr_choix=:_nbr_choix WHERE id_page=:_id_page");
        $maReq_modif->execute(array(
            '_nbr_choix' => $nv_nbr_choix,
            '_id_page' => $id_page

            )); 
        
        // on insert un nouveau choix dans la bdd (permet de pouvoir l'update une fois que le joueur a decidé de confirmer ses modifications)
        $req = $BDD->prepare('INSERT INTO `choix` (`id_page_associe`) VALUES (:_id_page)');
        $req->execute(array(
            '_id_page' => $id_page
         ));

        redirect("modif_choix.php?id_histoire=".$id_histoire."&id_page=".$id_page);
    }            
}
