<?php

class Note extends Model
{
    protected $primaryKey = 'idNote';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }
}