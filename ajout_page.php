<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    
    <div class="container">
    <h1 class="text-center"><span class="Titre">Ecrivez votre histoire</span></h1>
        <form class="text-center" method="POST">

                <label for="titre_page"> Titre de votre page : </label><input type="text" name="titre_page" id="titre_page" size="35" require/></br>
                <label for="modif_vie"> Modification du vie : </label><input type="number" name="modif_vie" id="modif_vie" size="35" require/></br>
                <label for="nbr_choix"> Nombre de choix associés à cette page : </label><input type="number" name="nbr_choix" id="nbr_choix" size="35" require/></br>
                <label for="page" class="margin-left"> Votre paragraphe : </label><br/><textarea cols='80' rows='20' name="page" id="page" require></textarea><br/>
                <input type="radio" name="Premier_page" id="Premier_page">
                <label for="Premier_page">Première page</label>
                <input type="radio" name="fin_chemin" id="fin_chemin">
                <label for="fin_chemin">Dernière page</label><br/>  
                <button type="submit" name="ajout">Ajouter une page</button>
                <button type="submit" name="finit">Fin</button> 
            
        </form>
    </div>
    <?php
                if(isset($_POST["ajout"]) || isset($_POST["finit"]))
                {
                    if(!empty($_POST["titre_page"]))
                    {
                        $titre_page =$_POST["titre_page"];
                        $modif_vie=$_POST["modif_vie"];
                        $nbr_choix=$_POST["nbr_choix"];
                        $page = $_POST["page"];
                        $id_histoire =$_SESSION["id_histoire"];

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
                            if(isset($_POST["fin_chemin"]))
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

                            if(isset($_POST["Premier_page"]))
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
                    }

                    if(isset($_POST["ajout"])) // on veut ajouter une autre page
                    {
                        redirect("ajout_page.php");
                    }

                    if(isset($_POST["finit"])) // si on a fini de creer des pages 
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

                }
            ?>
</body>
</html>