<?php

namespace App\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        // echo "Cette méthode affiche la page d'accueil";
        $this->render('home/index');
    }
}



//Explications du fonctionnement de la classe HomeController :

// Un contrôleur nommé HomeController est créé. Comme il s'agit d'une déclaration de classe, il est important de spécifier le "namespace". 
// Ce contrôleur hérite du contrôleur parent défini précédemment, pour bénéficier de ses paramètres.

// Une méthode publique appelée "index()" est déclarée pour l'instant, elle affiche simplement une chaîne de caractères.

// Le routeur cible ce contrôleur et sa méthode "index()" pour répondre à l'action de l'utilisateur via l'URL. À ce stade, 
// il est possible de tester l'URL en partant de la racine du dossier "public". Reprenez l'exemple d'URL expliqué dans le chapitre "routeur".
// Vous devriez voir l'instruction définie dans la méthode "index()" s'afficher.