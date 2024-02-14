<?php

namespace App\Core;

class Form
{
    private $formElements;

    public function getFormElements()
    {
        return $this->formElements;
    }

    private function addAttributes(array $attributes): string
    {
        $att = "";

        foreach ($attributes as $attribute => $value) {
            $att .= " $attribute=\"" . htmlspecialchars($value, ENT_QUOTES) . "\"";
        }
        return $att;
    }

    public function startForm(string $action = '#', string $method = "POST", array $attributes = []): self
    {
        $this->formElements = "<form action='" . htmlspecialchars($action, ENT_QUOTES) . "' method='" . htmlspecialchars($method, ENT_QUOTES) . "'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }


    public function addLabel(string $for, string $text, array $attributes = []): self
    {
        $this->formElements .= "<label for='" . htmlspecialchars($for, ENT_QUOTES) . "'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        $this->formElements .= htmlspecialchars($text, ENT_QUOTES) . "</label>";
        return $this;
    }

    public function addInput(string $type, string $name, array $attributes = []): self
    {
        $this->formElements .= "<input type='" . htmlspecialchars($type, ENT_QUOTES) . "' name='" . htmlspecialchars($name, ENT_QUOTES) . "'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    public function addTextarea(string $name, string $text = '', array $attributes = []): self
    {
        $this->formElements .= "<textarea name='" . htmlspecialchars($name, ENT_QUOTES) . "'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        $this->formElements .= htmlspecialchars($text, ENT_QUOTES) . "</textarea>";
        return $this;
    }

    public function addSelect(string $name, array $option, array $attributes = []): self
    {
        $this->formElements .= "<select name='" . htmlspecialchars($name, ENT_QUOTES) . "'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";

        foreach ($option as $key => $value) {
            $this->formElements .= "<option value='" . htmlspecialchars($key, ENT_QUOTES) . "'>" . htmlspecialchars($value, ENT_QUOTES) . "</option>";
        }
        $this->formElements .= "</select>";
        return $this;
    }

    public function endForm(): self
    {
        $this->formElements .= "</form>";
        return $this;
    }

    public static function validatePost(array $post, array $fields): bool
    {
        foreach ($fields as $field) {
            if (empty($post[$field]) || !isset($post[$field])) {
                return false;
            }
        }
        return true;
    }

    public static function validateFiles(array $files, array $fields): bool
    {
        foreach ($fields as $field) {
            if (isset($files[$field]) && $files[$field]['error'] == 0) {
                return true;
            }
        }
        return false;
    }
}
