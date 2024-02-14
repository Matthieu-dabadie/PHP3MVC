<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

use App\Autoloader;
use App\Core\Router;

include '../Autoloader.php';
Autoloader::register();

$route = new Router();

$route->routes();


// Explications du fonctionnement de l'index :

// L'index.php est le premier fichier exécuté et la seule porte d'entrée de l'application.

// Dans un premier temps, nous importons les classes "Autoloader" et "Routeur" via le mot clé "use" car nous utilisons le principe des "namespace".

// Nous incluons obligatoirement l'autoloader dans l'index car il va nous être utile pour exécuter la classe "Routeur".

// Nous incluons également le fichier de la classe "Autoloader" car nous exécutons la méthode "register", qui est une méthode "static", donc sans instanciation de la classe.

// Enfin, une fois la classe Routeur instanciée, nous exécutons la méthode "routes()" qui contient toute la logique du routeur,
// et donc l'exécution du contrôleur et de sa méthode pour lancer une action telle que l'affichage d'une page ou le traitement d'un formulaire.