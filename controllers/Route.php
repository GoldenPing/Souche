<?php
/*

function get et post :
- $url = l'url relative, sans / au début
  Ne faire que des urls simples (sans /)
- $controleur : string = nom du contrôleur
- $action : string = nom de la méthode à exécuter


Peu importe GET ou POST, l'action est exécutée avec toutes 
les valeurs (GET et POST) mélangées en paramètre
*/

class Route
{

    public static function get($url, $controller, $action)
    {
        (new Route())->answer($url, $controller, $action);
    }

    public static function post($url, $controller, $action)
    {
        (new Route())->answer($url, $controller, $action);

    }

    public function answer($url, $controller, $action)
    {
        $params = [];
        foreach ($_POST as $k => $v) $params[$k] = $v;
        foreach ($_GET as $k => $v) $params[$k] = $v;
        if (isset($_GET["page"]) && $_GET["page"] == $url)
            (new $controller())->$action($params);
    }
}