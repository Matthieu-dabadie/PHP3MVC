<?php

namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Creation;


class CreationModel extends DbConnect
{
    public function findAll()
    {

        $this->request = "SELECT * FROM creation";
        $result = $this->connection->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }


    public function find(int $id)
    {
        $this->request = $this->connection->prepare("SELECT * FROM creation WHERE id_creation = :id_creation");
        $this->request->bindParam(":id_creation", $id);
        $this->request->execute();
        $creation = $this->request->fetch();
        return $creation;
    }

    public function create(Creation $creation)
    {
        $this->request = $this->connection->prepare("INSERT INTO creation VALUES (NULL, :title, :description, :created_at, :picture)");
        $this->request->bindValue(":title", $creation->getTitle());
        $this->request->bindValue(":description", $creation->getDescription());
        $this->request->bindValue(":created_at", $creation->getCreated_at());
        $this->request->bindValue(":picture", $creation->getPicture());
        $this->executeTryCatch();
    }

    public function update(int $id, Creation $creation)
    {
        $this->request = $this->connection->prepare("UPDATE creation
                                                     SET title = :title, description = :description, created_at = :created_at, picture = :picture
                                                     WHERE id_creation = :id_creation");
        $this->request->bindValue(":id_creation", $id);
        $this->request->bindValue(":title", $creation->getTitle());
        $this->request->bindValue(":description", $creation->getDescription());
        $this->request->bindValue(":created_at", $creation->getCreated_at());
        $this->request->bindValue(":picture", $creation->getPicture());
        $this->executeTryCatch();
    }

    public function delete(int $id)
    {
        $this->request = $this->connection->prepare("DELETE FROM creation WHERE id_creation = :id_creation");
        $this->request->bindParam(":id_creation", $id);
        $this->executeTryCatch();
    }

    private function executeTryCatch()
    {
        try {
            $this->request->execute();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $this->request->closeCursor();
    }
}



//Explications du fonctionnement de la classe Creation :

// Pour gérer toutes les requêtes liées à l'entité "Creation", nous avons déclaré une classe "CreationModel". 
// Cette classe étend la classe "DbConnect" pour utiliser la connexion à la base de données. Nous utilisons donc la propriété "$this->connection" pour chaque requête,
// ainsi que "$this->requete" pour stocker la requête à exécuter.

// Chaque méthode déclarée dans cette classe représente une requête : 

// - "findAll()" pour récupérer la liste des créations 
// - "find()" pour récupérer une création 
// - "create()" pour ajouter une nouvelle création 
// - "update()" pour mettre à jour une création 
// - Pour ces deux dernières méthodes, nous utilisons l'injection de dépendance.
// - "delete()" pour supprimer une création

// Enfin, nous avons déclaré une méthode pour exécuter les requêtes en faisant appel à la méthode "execute".
// Il est important de noter que chaque classe externe ne peut être accessible qu'en utilisant le mot-clé "use" suivi de son "namespace".
// Pour simplifier l'intégration des "namespace", vous pouvez utiliser l'extension "PHP Namespace Resolver".