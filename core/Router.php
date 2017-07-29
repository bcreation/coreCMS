<?php
 class Router{

    static $routes = array();
    /**
    * Permet de parser une url
    * @param : $url  URL a parser 
    * @return : tableau des paramètres 
    **/
    static function parse($url, $request){
        $url = trim($url,'/');
        $params = explode('/', $url);
        $request->controller = $params[0];
        $request->action = isset($params[1]) ? $params[1] : 'index' ;
        $request->params = array_slice($params,2);
        return true;
    }

    /**
    * Permet de parser une url
    * @redir : $url  URL a parser 
    * @url : tableau des paramètres 
    **/
    static function connect($redir,$url){
        $r=array();
        $r['origin'] = '/'.str_replace('/', '\/', $url).'/';
        self::$routes[] = $r;
    }

    /**
    * Permet de parser une url
    * @url : $url  URL a parser 
    **/
    static function url($url){
        foreach(self::$route as $v){
            if( preg_match($v['origin'], $url, $match)){
                debug($match);
            }
        }
        return $url;
    }

 }
