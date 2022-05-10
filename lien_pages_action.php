<?php 
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();

if($BDD) {
    
        $id_histoire =$_SESSION["id_histoire"];
        $maReq = "SELECT * FROM `page` WHERE id_histoire=? ORDER BY id_page";
        $curseur_update = $BDD->prepare($maReq);
        $curseur_update->execute(array($id_histoire));
        while($tuple = $curseur_update->fetch())
        {
            $nb_choix_lies_pages =$tuple["nbr_choix"];
            $nb_choix=1;
            While($nb_choix<=$nb_choix_lies_pages) 
            {
                $req = $BDD->prepare('INSERT INTO `choix` (`id_page_associe`,`id_page_suivante`,`texte_choix`) VALUES (:_id_page_associe, :_id_page_suivante, :_texte_choix)' );
                $req->execute(array(
                        '_id_page_associe'=> $tuple["id_page"],
                        '_id_page_suivante'=> $_POST["choix_".$nb_choix."_".$tuple["id_page"]],
                        '_texte_choix' => $_POST["choix_".$nb_choix."_".$tuple["id_page"]."_"."_texte"]
                ));
                $nb_choix++;
            }
        }
    
}
redirect("index.php");