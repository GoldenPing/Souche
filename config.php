<?php


// à configurer !
//------------------------------------------------------------------------


$db = new PDO("mysql:host=127.0.0.1;dbname=;port=3306", "", "");


//------------------------------------------------------------------------


// NE PAS TOUCHER ! (en faite si car il ne faut pas stopper le progrés donc faites le mais en connaissance de cause)

spl_autoload_register(function ($class) {
    if (strpos($class, "Controller") !== false || $class == 'Route')
        include_once "controllers/" . $class . ".php";
    else if (strpos($class, "Service") !== false) {
        include_once "service/" . $class . ".php";
    } else if (strpos($class, "Utils") !== false)
        include_once "utils/" . $class . ".php";
    else
        include_once "models/" . $class . ".php";
});


function db()
{
    global $db;
    return $db;
}
