<?php

namespace App\Core;

use PDO;
use Exception;

class DbConnect
{
    protected $connection;
    protected $request;

    const SERVER = 'sqlprive-pc2372-001.eu.clouddb.ovh.net:35167';
    const USER = 'cefiidev1380';
    const PASSWORD = '64nwXdL8';
    const BASE = 'cefiidev1380';


    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::SERVER . ';dbname=' . self::BASE, self::USER, self::PASSWORD);

            // activation des erreur pdo
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // requete tab obj def

            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // Norme UTF-8

            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}



//Explications du fonctionnement de la classe DbConnect :
// Nous définissons une classe que nous utilisons principalement pour la connexion à la base de données. 
// Pour cela, nous utilisons la classe "PDO", comme expliqué dans le module "PHP2 avancé". Dans la classe "DbConnect", nous déclarons deux propriétés :
// l'une pour stocker la connexion PDO en tant qu'objet PDO, et l'autre pour stocker la requête à exécuter. 
// Nous utilisons le constructeur de la classe pour établir la connexion, ce qui permet de la récupérer lors de l'instanciation de la classe.

// Nous faisons appel à deux classes natives du langage PHP : "PDO" et "Exception". Pour y accéder, nous utilisons la directive "use".