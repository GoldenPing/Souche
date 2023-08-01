<?php

class TypeAnimeService
{

    public static function getTypes()
    {
        return Type::all();
    }
}