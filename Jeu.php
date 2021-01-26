<?php
require_once "Autoloader.php";
Autoloader::register();

echo "Bienvenue dans ce jeu de démineur qui a bien pris la tête à tout le monde !";
$x = readline("combien de ligne ? ");
$y = readline("combien de colonne ? ");
$m = readline("combien de mines ? ");
$j = new Jeu($x, $y, $m);
