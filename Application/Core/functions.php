<?php
/**
 * Kiolvassa a konfigurációs állomány tartalmát és tömbben adja vissza.
 */
function getConfig($confPath)
{
    return json_decode( file_get_contents($confPath),true);
}
/**
 * Az addRout függvény végzi a regisztrációt.
 */
function addRoute($pattern, $controller)
{
    global $routes;
    $routes['%'.$pattern.'%'] = $controller;
}

/**
 * A routing függvény végzi a kikeresést. Ha nem talál egyezést a tisztított url
 * és a regisztrált minta között, meghívja a notFoundController-t.
 * 
 */
function routing($cleanedUri)
{
    global $routes;
 
    foreach($routes as $pattern => $controller)
    {        
        if(preg_match($pattern, $cleanedUri, $matches))
        {            
            $controller($matches);
            return;
        }
    }
    notFoundController();
}


/**
 * A view függvény a kapott adatokat kibontja és átadja a layoutnak.
 * A $datas-nak tartalmaznia kell egy 'view' kulcsot!
 */
function view($datas)
{
    extract($datas);
    require_once APPPATH.'Templates/_layout.php';
}