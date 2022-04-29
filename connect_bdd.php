<?php
try {
$BDD = new PDO( "mysql:host=localhost;dbname=mystory;charset=utf8",
"metest","mystory", array(PDO::ATTR_ERRMODE
=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
die('Erreur fatale : ' . $e->getMessage());
}
?>