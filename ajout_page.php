<?php
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    
    <div class="container">
        <form method="POST">

                <label for="titre_page"> Titre de votre page : </label><br/><input type="text" name="titre_page" id="titre_page" size="35" require/></br>
                <label for="modif_vie"> Modification du vie : </label><br/><input type="number" name="modif_vie" id="modif_vie" size="35" require/></br>
                <label for="nbr_choix"> Nombre de choix associés à cette page : </label><br/><input type="number" name="nbr_choix" id="nbr_choix" size="35" require/></br>
                <label for="page"> Votre paragraphe : </label><br/><textarea cols='90' rows='20' name="page" id="page" require></textarea><br/>
                <input type="radio" name="Premier_page" id="Premier_page">
                <label for="Premier_page">Est la premiere page</label><br/> 
                <input type="radio" name="fin" id="fin">
                <label for="fin">Est une fin</label><br/>  
                
            <input type="submit" value="Ajouter une page" formaction="ajout_page.php"/>
            <input type="submit" value="Fini" formaction="lien_pages.php"/>
            
            <?php
                if(!empty($_POST))
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
                    $tuple_page = $curseur->fetch();
                    if ($curseur->rowCount() == 1) {
                    ?>
                        <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> Vous avez deja ecrit cette page !
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

                        if(!empty($_POST["Premier_page"]))
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
                                Vous avez deja defini une premiere page à cette histoire
                                </div>
                            <?php }
                            else
                            {
                                // on associe l'id de la page comme etant l'id de la premiere page dans l'histoire actuelle
                                $req = $BDD->prepare('UPDATE `histoire` SET `id_premiere_page` = :_id_premiere_page WHERE id_histoire = :_id');
                                $req->execute(array(
                                '_id_premiere_page' => $tuple_page["id_page"],
                                '_id'=> $id_histoire
                                )); 
                            }
                            
                        }
                    }

                    /*if(!empty($_POST["Fini"]))
                    {
                        // on fait la requete afin de pouvoir verifier si une id est deja associé au id de la premiere page
                        $maRequete3 = "SELECT * FROM histoire WHERE id_histoire=?";
                        $curseur = $BDD->prepare($maRequete3);
                        $curseur->execute(array($id_histoire));
                        $tuple = $curseur->fetch();
                        // on verifie si la premiere page est deja defini
                        if(empty($tuple["id_premiere_page"]))
                        {?>
                            <div class="alert alert-secondary" role="alert">
                            Vous devez d'abord creer une page de depart de l'histoire !
                            </div>
                        <?php }
                        else
                        {
                            redirect("lien_pages.php");
                        }
                    }*/

                }}
            ?>
            
</form>
    </div>
</body>
</html>