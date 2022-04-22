<?php require_once "includes/functions.php"; ?>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php"> My Story</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-target">
            <?php if (isUserConnected()) {
                    if(administratorIsUserConnected()){ ?>
                <ul class="nav navbar-nav">
                    <li><a href="admin.php">Mode admin</a></li>
                </ul>
            <?php }} ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isUserConnected()) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Bienvenue</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">Se déconnecter</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Non connecté <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="login.php">Se connecter</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>