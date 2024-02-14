<?php

namespace App\Controllers;

use App\Core\Form;
use App\Entities\Creation;
use App\Models\CreationModel;

class CreationController extends Controller
{
    public function index()
    {
        $creations = new CreationModel();
        $list = $creations->findAll();

        $this->render('creation/index', ['list' => $list]);
    }

    public function add()
    {
        $erreur = '';
        $form = new Form();

        if (
            Form::validatePost($_POST, ['title', 'description', 'date']) &&
            Form::validateFiles($_FILES, ['picture']) &&
            isset($_POST['token']) && $_POST['token'] === $_SESSION['token']
        ) {
            // Vérifier la taille du fichier
            if ($_FILES["picture"]["size"] <= 4 * 1024 * 1024) { // 4Mo
                // Vérifier l'extension du fichier
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                $fileExtension = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    move_uploaded_file($_FILES["picture"]["tmp_name"], "images/" . $_FILES["picture"]["name"]);
                    $picture = "images/" . $_FILES["picture"]["name"];

                    $creation = new Creation();
                    $creation->setTitle($_POST['title']);
                    $creation->setDescription($_POST['description']);
                    $creation->setCreated_at($_POST['date']);
                    $creation->setPicture($picture);

                    $model = new CreationModel();
                    $model->create($creation);

                    header("Location:index.php?controller=creation&action=index");
                    exit();
                } else {
                    $erreur = "Le fichier doit être une image avec l'une des extensions suivantes : jpg, jpeg, png, gif, bmp, webp.";
                }
            } else {
                $erreur = "Le fichier est trop volumineux. Veuillez sélectionner un fichier de moins de 4 Mo.";
            }
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
            if (!empty($erreur)) {
                echo "<script>window.onload = function() { alert('$erreur'); }</script>";
            }
        }

        $form->startForm("", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("title", "Title", ["class" => "form-label"]);
        $form->addInput("text", "title", ["id" => "title", "class" => "form-control", "placeholder" => "Ajouter un titre"]);
        $form->addLabel("description", "Description", ["class" => "form-label"]);
        $form->addTextarea("description", "description de la création", ["id" => "description", "class" => "form-control", "rows" => 15]);
        $form->addLabel("date", "Date de publication", ["class" => "form-label"]);
        $form->addInput("date", "date", ["id" => "date", "class" => "form-control"]);
        $form->addLabel("picture", "Image de la création", ["class" => "form-label"]);
        $form->addInput("file", "picture", ["id" => "picture", "class" => "form-control mb-2"]);
        $form->addInput("hidden", "token", ["value" => $this->token()]);
        $form->addInput("submit", "add", ["value" => "ajouter", "class" => "btn btn-primary"]);
        $form->endForm();

        $this->render('creation/add', ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

    public function showCreation($id)
    {
        $creation = new CreationModel();
        $creation = $creation->find($id);
        $this->render('creation/showCreation', ['creation' => $creation]);
    }

    public function updateCreation($id)
    {
        $erreur = '';
        $picture = '';

        if (
            Form::validatePost($_POST, ['title', 'description', 'date', 'hidden']) &&
            isset($_POST['token']) && $_POST['token'] === $_SESSION['token']
        ) {
            $creation = new Creation();
            $creation->setTitle($_POST['title']);
            $creation->setDescription($_POST['description']);
            $creation->setCreated_at($_POST['date']);

            $picture = $_POST['hidden'];

            if (Form::validateFiles($_FILES, ['picture'])) {
                move_uploaded_file($_FILES["picture"]["tmp_name"], "images/" . $_FILES["picture"]["name"]);
                $picture = "images/" . $_FILES["picture"]["name"];
                $creation->setPicture($picture);
            } else {
                $creation->setPicture($_POST['hidden']);
            }

            $creations = new CreationModel();
            $creations->update($id, $creation);

            header("Location:index.php?controller=creation&action=index");
            exit();
        } else {
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }

        $creations = new CreationModel();
        $creation = $creations->find($id);

        $form = new Form();
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("title", "Title", ["class" => "form-label"]);
        $form->addInput("text", "title", ["id" => "title", "class" => "form-control", "placeholder" => "Ajouter un titre", "value" => $creation->title]);
        $form->addLabel("description", "Description", ["class" => "form-label"]);
        $form->addTextarea("description", $creation->description, ["id" => "description", "class" => "form-control", "rows" => 15]);
        $form->addLabel("date", "Date de publication", ["class" => "form-label"]);
        $form->addInput("text", "date", ["id" => "date", "class" => "form-control", "value" => $creation->created_at, "readonly" => ""]);
        $form->addLabel("picture", "Image de la création", ["class" => "form-label"]);
        $form->addInput("file", "picture", ["id" => "picture", "class" => "form-control mb-2"]);
        $form->addInput("hidden", "hidden", ["id" => "hidden", "class" => "form-control", "value" => $creation->picture]);
        $form->addInput("hidden", "token", ["value" => $this->token()]);
        $form->addInput("submit", "update", ["value" => "Modifier", "class" => "btn btn-primary"]);
        $form->endForm();

        $this->render("creation/updateCreation", ["updateForm" => $form->getFormElements(), "erreur" => $erreur, "creation" => $creation]);
    }

    public function deleteCreation($id)
    {
        if (isset($_POST['true'])) {
            $creations = new CreationModel();
            $creations->delete($id);
            header("Location:index.php?controller=creation&action=index");
        } elseif (isset($_POST['false'])) {
            header("Location:index.php?controller=creation&action=index");
        } else {
            $creations = new CreationModel();
            $creation = $creations->find($id);
        }

        $this->render('creation/deleteCreation', ["creation" => $creation]);
    }
}
