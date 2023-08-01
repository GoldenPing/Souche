<?php

class Anime extends Model
{
    protected $primaryKey = 'idAnime';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, "A_POUR", "idAnime", "idTags");
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class,'FAIT_PAR',"idAnime","idStudio");
    }

    public function etat(){
        return $this->belongsTo(Etat::class, 'idEtat', 'idEtat');
    }
}
