<?php

use PHPMailer\PHPMailer\PHPMailer;


class ValidatorUtils
{

    public $params;
    public $errorMsgs;
    private $lock;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->lock = true;
    }

    public function isNotNull(string $champ)
    {
        if (empty($this->params[$champ])) {
            $this->lock = false;
            $this->errorMsgs[$champ] = "$champ est vide";
        }
    }

    public function selectNull(string $champ)
    {
        if ($this->params[$champ] === ".") {
            $this->lock = false;
            $this->errorMsgs[$champ] = "$champ est mal renseigné";
        }
    }

    public function isMailValid(string $champ)
    {
        if (!filter_var($this->params[$champ], FILTER_VALIDATE_EMAIL)) {
            $this->lock = false;
            if (!isset($this->errorMsgs[$champ])) {
                $this->errorMsgs[$champ] = "$champ n'est pas un mail conforme";
            }
        }
    }

    public function minLenght(string $champ, int $lenght)
    {
        if (strlen($this->params[$champ]) < $lenght) {
            $this->lock = false;
            if (!isset($this->errorMsgs[$champ])) {
                $this->errorMsgs[$champ] = "$champ doit être d'une taille min de $lenght";
            }
        }
    }

    public function sameField(string $field1, string $field2)
    {
        if ($this->params[$field1] !== $this->params[$field2]) {
            $this->lock = false;
            $this->errorMsgs["champs"] = "les champs doivent être identique";
        }
    }


    public function isValidate()
    {
        if ($this->lock) {
            return true;
        } else {
            return $this->errorMsgs;
        }
    }

    public function validate()
    {
        return $this->params;
    }
}