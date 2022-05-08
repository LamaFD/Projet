<?php require_once "includes/functions.php"; ?>
<link href="lib/css/feuillestyle5.css" rel="stylesheet">

<nav class="navbar navbar-default navbar-static-top navbar-custom" role="navigation">
    <div class="container">
        <table>
        <div class="collapse navbar-collapse" id="navbar-collapse-target">
        <td width="25%">
        <ul class="nav navbar-nav navbar-left">
        <li><a href="accueil.php"> 
            <span > <img src="images/dragon.PNG" alt="Dessin d'un dragon" width=28 /> </span> <span class="Titre"> My Story</span></a></li>
            </ul>    
        </td>
        
        
            
                <?php if (isUserConnected()) {
                    if(administratorIsUserConnected()){ ?>
                <td width="20%">
                <ul class="nav navbar-nav ">
                    <li><a href="admin.php"><span > <img src="images/modif.PNG" alt="Dessin d'un dragon" width=36 /> </span><span class="Titre">Mode admin</span></a></li>
                </ul>
                    </td>
                    <td width="20%">
                <ul class="nav navbar-nav">
                        <li><a href="ajout_histoire_titre.php"><span > <img src="images/crayon.PNG" alt="Dessin d'un dragon" width=22 /> </span><span class="Titre">Créer une histoire</span></a></li>
                    </ul>
                    </td>
            <?php }} ?>
            

                <?php if (isUserConnected()) { ?>
                        <ul  class="nav navbar-nav navbar-right">
                            <li><a href="logout.php"><span class="Titre"> <img src="images/casque.PNG" alt="Dessin d'un casque de chevalier" width=38 />Se déconnecter</span></a></li>
                        </ul>
                <?php } else { ?>
                        <ul  class="nav navbar-nav navbar-right">
                            <li><a href="login.php"><span class=""> <img src="images/casque.PNG" alt="Dessin d'un casque de chevalier" width=38 /> </span><span class="Titre">Se connecter</span></a></li>
                        </ul>
                
                <?php } ?>
        </div>
                </tr>
        </table>
                    
    </div>
</nav>