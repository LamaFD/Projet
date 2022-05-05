<?php
require_once "includes/functions.php";
require("connect_bdd.php");
session_start();
?>

<!doctype html>
<html>
<link href="lib/css/feuillestyle4.css" rel="stylesheet">
<?php require_once "includes/head.php"; ?>
<?php require_once "includes/header.php"; ?>
<body>
    <div class="container text-center">
        <?php 
        if($BDD) {
            $id_page = $_GET["id_page"];
        
            $maRequete = "SELECT * FROM `page` WHERE id_page=? ORDER BY id_page";
            $curseur = $BDD->prepare($maRequete);
            $curseur->execute(array($id_page));
            $tuple = $curseur->fetch();
            // enregistrer l'id de l'histoire afin de pouvoir sauvgarder l'avancement
            $id_histoire = $tuple["id_histoire"];
            // update etat du vie
            $vie=$_GET["vie"]+$tuple["modif_vie"];
            $fini=$tuple["Fin"];
            if($vie<=0 || $fini==1) // On affiche le contenu de la page sans les choix
            {?>
                <h3><?=$tuple["page_titre"]?></a></h3>
                <p><span class="presentation"><?=$tuple["texte"]?></span></p>
                <p>Nombre de vies restants : <?=$vie?></p>
                <?php if($fini==0)
                { 
                   echo "Vous n'avez plus de vies restant, votre chemin est arrivée à sa fin !" ;
                } 
                else
                {
                    echo "Vous etes arrivés à la fin de l'histoire !" ;
                }?>
                </br>
                <form method="POST">
                <input type="submit" name="Fin" value= "FINI" formaction="histoire_fin.php">
                </form>
                
            <?php }

            else // On affiche le contenu de la page avec les choix 
            {?>
                <h3><?=$tuple["page_titre"]?></a></h3>
                <p><span class="presentation"><?=$tuple["texte"]?></span></p>
                
                <form method="POST" class="form2">
                <input type=hidden name="vie" value=$vie>
                
                <?php 
                    // chercher les choix 
                    $maRequete_choix = "SELECT * FROM `choix` WHERE id_page_associe=? ORDER BY id_choix";
                    $curseur_choix = $BDD->prepare($maRequete_choix);
                    $curseur_choix->execute(array($id_page));
                    // afficher les choix
                    echo "ici";
                    while($choix = $curseur_choix->fetch()) 
                    {
                        echo "here"////////////////////////////////////////////////////?>
                        
                        <input type="submit" name=<?="choix_".$choix["id_choix"]?>  value=<?="choix_".$choix["texte_choix"]?> formaction=<?="histoire_enCours.php?id_page=".$choix["id_page_suivante"]."&vie=".$vie?> >
                    <?php }
                ?>
                </form>
                <p class="navbar-left presentation italique">Nombre de vies restantes : <?=$vie?></p>
                
            <?php
            }}
            ?>

            <?php // enregistrer l'avancement dans l'histoire?>
            <?php if(isUserConnected())
                    {?>
            <form method="POST">
                <button type="submit" name="enregistrer">Marquer la page</button> 
            </form>
               <?php }
               if(isset($_POST["enregistrer"]))
               {
                   // preparation de la requette permettant de verifier si l''histoire a deja été commencé par l'utilisateur
                   $req_verifier = "SELECT * FROM `historique` WHERE id_histoire=? AND id_user=?";
                   $curs_hist = $BDD->prepare($req_verifier);
                   $curs_hist->execute(array($id_histoire,$_SESSION['id_user']));
                   if($curs_hist->rowCount() == 1)
                   {
                       // update les données deja disponible 
                       $req_update = $BDD->prepare('UPDATE  historique SET vie_actuelle=:_vie AND id_page=:_page WHERE id_histoire=:_id_histoire AND id_user=:_id_user');
                       $req_update->execute(array(
                           ':_cache' => 0,
                           '_id_histoire' => $id_histoire,
                           '_id_user' => $_SESSION['id_user']
                           ));
               
                   }
                   else
                   {
                       // on ajoute une ligne dans la base qui contient les informations
                       $req_ajout = $BDD->prepare('INSERT INTO `historique` (`id_user`, `id_histoire`,`id_page`,`vie_actuelle`) VALUES (:_user, 
                       :_histoire,:_page,:_vie)');
                       $req_ajout->execute(array(
                       '_user' => $_SESSION['id_user'], 
                       '_histoire' => $id_histoire,
                       '_page' => $id_page,
                       '_vie' => $vie
                       )); 
                   }
               }
            ?>

    </div>


</body>

</html>