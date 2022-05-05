<?php
require_once "includes/functions.php";
session_start();
redirect('histoire_enCours.php?id_page='.$_GET["id_premiere_page"]."&vie=".$_GET["nbr_vie"]);