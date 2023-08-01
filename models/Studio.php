<?php

class Studio extends Model 
{
    protected $primaryKey = 'idStudio';

    
    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }
    
    
}