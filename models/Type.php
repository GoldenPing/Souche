<?php

class Type extends Model
{
    protected $primaryKey = 'idType';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }
}