<?php require_once "includes/functions.php"; ?>
<link href="lib/css/feuillestyle2.css" rel="stylesheet">

<nav class="navbar navbar-default navbar-static-top navbar-custom" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php"> 
            <span class=""> <img src="dragon.PNG" alt="Dessin d'un dragon" width=28 /> </span> <span class="Titre"> My Story</span></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-target">
            <?php if (isUserConnected()) {
                    if(administratorIsUserConnected()){ ?>
                <ul class="nav navbar-nav">
                    <li><a href="admin.php"><span class="Titre">Mode admin</span></a></li>
                </ul>
                <ul class="nav navbar-nav">
                        <li><a href="ajout_histoire_titre.php"><span class="Titre">Créer une histoire</span></a></li>
                    </ul>
            <?php }} ?>

                <?php if (isUserConnected()) { ?>
                        <ul  class="nav navbar-nav navbar-right">
                            <li><a href="logout.php"><span class="Titre">Se déconnecter</span></a></li>
                        </ul>
                <?php } else { ?>
                        <ul  class="nav navbar-nav navbar-right ">
                            <li><a href="login.php"><span class=""> <img src="casque.PNG" alt="Dessin d'un casque de chevalier" width=38 /> </span><span class="Titre">Se connecter</span></a></li>
                        </ul>
                <?php } ?>
        </div>
    </div>
</nav>