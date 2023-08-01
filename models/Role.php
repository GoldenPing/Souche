<?php

class Role extends Model
{
    protected $primaryKey = 'idRole';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }

    public function user()
    {
        return $this->hasMany(User::class,'idRole','idRole');
    }
}