<?php

class TmpUser extends Model
{
    protected $primaryKey = 'idTmpUser';


    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }
}