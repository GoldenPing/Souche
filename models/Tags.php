<?php

class Tags extends Model 
{
    protected $primaryKey = 'idTags';

    
    public function __construct()
    {
        parent::__construct($this->primaryKey);
    }
    
    
}
