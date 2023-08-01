<?php

class Etat extends Model
{
    protected $primaryKey = 'idEtat';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }


    public function animes()
    {
        return $this->hasMany(Anime::class,'idEtat','idEtat');
    }
}