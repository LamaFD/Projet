<?php 
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();


$titre_page =$_POST["titre_page"];
$modif_vie=$_POST["modif_vie"];
$nbr_choix=$_POST["nbr_choix"];
$page = $_POST["page"];
$id_histoire =$_SESSION["id_histoire"];
echo print_r($_POST);
if($BDD) {
    $maRequete = "SELECT * FROM `page` WHERE page_titre=? AND modif_vie=? AND nbr_choix=? AND texte=? AND id_histoire=?";
    $curseur = $BDD->prepare($maRequete);
    $curseur->execute(array($titre_page,$modif_vie,$nbr_choix,$page,$id_histoire));
    if ($curseur->rowCount() == 1) {
    ?>
        <div class="alert alert-warning" role="alert">
        <strong>Attention !</strong> Vous avez deja ecrit cette page !
        </div>
    <?php
    }
    else
    {
        $req = $BDD->prepare('INSERT INTO `page` (`page_titre`,`modif_vie`,`nbr_choix`, `texte`, `id_histoire`) VALUES (:_titre, :_modif_vie,:_nbr_choix,
        :_text,:_id_histoire)');
        $req->execute(array(
        '_titre' => $titre_page, 
        '_modif_vie' => $modif_vie,
        '_nbr_choix' => $nbr_choix,
        '_text' => $page,
        '_id_histoire' =>$id_histoire
        )); 

        // si la page est la fin d'un chemin
        if($_POST["fin_chemin"]=="Oui")
        {
            // on retrouve l'id de la page qui vient d'etre creer
            $maRequete = "SELECT * FROM `page` WHERE page_titre=? AND modif_vie=? AND nbr_choix=? AND texte=? AND id_histoire=?";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($titre_page,$modif_vie,$nbr_choix,$page,$id_histoire));
            $tuple_page = $curseur->fetch();
            // on update Fin
            $req_fin = $BDD->prepare('UPDATE `page` SET Fin=:_fin WHERE id_page=:_id');
            $req_fin->execute(array(
                '_fin' => 1,
                '_id' => $tuple_page["id_page"]
                ));
        }

        if($_POST["Premier_page"]=="Oui")
        {
            // on fait la requete afin de pouvoir verifier si une id est deja associé au id de la premiere page
            $maRequete2 = "SELECT * FROM histoire WHERE id_histoire=?";
            $curseur2 = $BDD->prepare($maRequete2);
            $curseur2->execute(array($id_histoire));
            $tuple = $curseur2->fetch();
            // on verifie si la premiere page est deja defini
            if(!empty($tuple["id_premiere_page"]))
            {?>
                <div class="alert alert-secondary" role="alert">
                Vous avez déjà défini la premiere page de cette histoire
                </div>
            <?php }
            else
            {
                // on retrouve l'id de la page qui vient d'etre creer
                $maRequete = "SELECT * FROM `page` WHERE page_titre=? AND modif_vie=? AND nbr_choix=? AND texte=? AND id_histoire=?";
                $curseur = $BDD->prepare($maRequete);
                $curseur->execute(array($titre_page,$modif_vie,$nbr_choix,$page,$id_histoire));
                $tuple_page = $curseur->fetch();
                // on associe l'id de la page comme etant l'id de la premiere page dans l'histoire actuelle
                $req = $BDD->prepare('UPDATE `histoire` SET `id_premiere_page` = :_id_premiere_page WHERE id_histoire = :_id');
                $req->execute(array(
                '_id_premiere_page' => $tuple_page["id_page"],
                '_id'=> $id_histoire
                )); 
            }
        }
    }
}

if(isset($_POST["ajout"])) // on veut ajouter une autre page
{
    redirect("ajout_page.php");
}

if(isset($_POST["finit"])) // si on a fini de creer des pages 
{
    if(empty($_POST["id_histoire_modif"])) // si l'ajout d'une page n'est pas demandé lors d'une modification
    {
    // on fait la requete afin de pouvoir verifier si une id est deja associé au id de la premiere page
    $maRequete3 = "SELECT * FROM histoire WHERE id_histoire=?";
    $curseur = $BDD->prepare($maRequete3);
    $curseur->execute(array($_SESSION["id_histoire"]));
    $tuple = $curseur->fetch();
        // on verifie si la premiere page est deja defini
        if(empty($tuple["id_premiere_page"]))
        {?>
            <div class="alert alert-danger" role="alert">
            <strong>Attention !</strong> Votre dernière page a bien été rajoutée mais vous ne pouvez pas finir la création de votre histoire sans avoir défini la première page de cette dernière !
            </div>
        <?php }
        else
        {
            redirect("lien_pages.php");
        }
    }

    else // si l'ajout d'une page est pas demandé lors d'une modification
    {
        redirect("choix_page_modif.php?id_histoire=".$id_histoire);
    }
}