<?php

namespace App\Entities;

class Creation
{
    private $id_creation;
    private $title;
    private $description;
    private $created_at;
    private $picture;

    /**
     * @return self  // Cette annotation indique le type de valeur renvoyée par la méthode. 
     */
    public function getId_creation()
    {
        return $this->id_creation;
    }

    /**
     * @param mixed // $id_creation Cette annotation est utilisée pour documenter le type et le nom du paramètre que prend une méthode.
     * @return self
     */
    public function setId_creation($id_creation)
    {
        $this->id_creation = $id_creation;
        return $this;
    }

    /**
     * @return self
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed 
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return self
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed 
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return self
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * @param mixed 
     * @return self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return self
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed 
     * @return self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }
}
