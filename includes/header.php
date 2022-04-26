<?php require_once "includes/functions.php"; ?>
<link href="lib/css/feuillestyle.css" rel="stylesheet">

<nav class="navbar navbar-default navbar-static-top navbar-custom" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php"> 
            <span class=""> <img src="dragon.PNG" alt="Dessin d'un dragon" width=28 /> </span> My Story</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-target">
            <?php if (isUserConnected()) {
                    if(administratorIsUserConnected()){ ?>
                <ul class="nav navbar-nav">
                    <li><a href="admin.php">Mode admin</a></li>
                </ul>
                <ul class="nav navbar-nav">
                        <li><a href="ajout_histoire_titre.php">Créer une histoire</a></li>
                    </ul>
            <?php }} ?>

                <?php if (isUserConnected()) { ?>
                        <ul  class="nav navbar-nav navbar-right">
                            <li><a href="logout.php">Se déconnecter</a></li>
                        </ul>
                <?php } else { ?>
                        <ul  class="nav navbar-nav navbar-right">
                            <li><a href="login.php"><span class=""> <img src="casque.PNG" alt="Dessin d'un casque de chevalier" width=38 /> </span>Se connecter</a></li>
                        </ul>
                <?php } ?>
        </div>
    </div>
</nav>