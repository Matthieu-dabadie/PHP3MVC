<?php

namespace App\Controllers;


abstract class Controller
{
    protected function token()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $token;
    }

    public function render(string $path, array $data = [])
    {
        extract($data);

        ob_start();

        include dirname(__DIR__) . '/Views/' . $path . '.php';

        $content = ob_get_clean();

        include dirname(__DIR__) . '/Views/base.php';
    }
}


// Explications du fonctionnement de la classe mère Controller :
// Dans la classe "Controller", on commence par déclarer le "namespace" de la classe afin de lui donner un espace de nom pour que l'autoloader puisse l'exécuter. 
// Pour cela, on utilise le mot clé "namespace" suivi de l'espace de nom. Ici, la racine de l'application se nomme "App" suivi du nom du dossier "Controllers".

// Ensuite, on déclare la classe "Controller" que l'on définit comme une classe abstraite avec le mot clé "abstract". Car nous n'allons jamais l'instancier. 
// Nous passerons tout le temps par les classes "Controller" qui l'étendent.



// Explications du fonctionnement de la classe Controller :

// Dans le contrôleur mère, nous ajoutons une méthode publique appelée "render", qui sera héritée par tous les contrôleurs de l'application.
// Cette méthode permet d'inclure la vue dans le contrôleur. Elle prend en paramètre une chaîne de caractères représentant le chemin vers la vue, 
// ainsi qu'un tableau contenant les données à afficher dans la vue.
// La dernière ligne de la méthode "render" utilise la chaîne de caractères passée en paramètre pour inclure le fichier de la vue. Ici, 
//le chemin est relatif à la racine de l'application avec la constante magique "__DIR__", suivi du dossier "Views", puis du nom de la vue.
// Le deuxième paramètre est un tableau contenant les données à afficher dans la vue. Ces données peuvent provenir de la base de données ou d'autres sources. 
// Grâce à la méthode "extract" de PHP, les index de ce tableau sont transformés en variables, facilitant ainsi leur manipulation dans la vue.