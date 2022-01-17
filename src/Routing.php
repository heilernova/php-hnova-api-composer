<?php
namespace PhpNv;

use PhpNv\Routes\Route;

class Routing
{
    private static array $listRoutes = [];

    public static function AddRoute(string $url, string|callable|array $controller, ?callable $canActive = null ):Route
    {
        $r = new Route($url, $controller, $canActive);
        self::$listRoutes[] = $r;
        return $r;

    }

    /**
     * @return array<Route>
     */
    public static function getRoutes():array
    {
        return self::$listRoutes;
    }

    public static function find(string $http_url):null|Route
    {
        $routes = self::getRoutes();

        uasort($routes, function($a, $b){ return (strcmp($b->url, $a->url)); });

        $url_items = explode('/', $http_url);
        $url_items_num = count($url_items);
        
        $filter_routes =  array_filter($routes, function(Route $route) use ($url_items, $url_items_num, $http_url){
            if ($route->urlItemsNum == $url_items_num){
    
                $valid = true;
                foreach ($route->indexControllers as $index) {
    
                    if ($route->urlItems[$index] == $url_items[$index]){
    
                        $route->httpRequest = $http_url; $valid = true;
    
                    }else{
    
                        $valid = false;
                    }
                }
    
                return $valid;
    
            }else{
    
                return false;
    
            }
    
        });

        return array_shift($filter_routes);
    }
}