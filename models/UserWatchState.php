<?php

class UserWatchState extends Model{


    protected $primaryKey = 'idUserwatchstate';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }


    public function anime()
    {
        return $this->belongsTo(Anime::class, 'idAnime','idAnime');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser' , 'idUser');
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class, 'idEtat' , 'idEtat');
    }

    public function note(){
        return $this->belongsTo(Note::class,'idNote','idNote');
    }
}
