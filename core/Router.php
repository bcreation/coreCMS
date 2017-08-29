<?php
 class Router{

    static $routes = array();
    static $prefixes = array();

     /**
    * Permet de parser une url
    * @param : $url  URL a parser 
    * @return : tableau des paramètres 
    **/
    static function prefix($url, $prefix){
        self::$prefixes[$url] = $prefix;
    }

    /**
    * Permet de parser une url
    * @param : $url  URL a parser 
    * @return : tableau des paramètres 
    **/
    static function parse($url, $request){
        $url = trim($url,'/');
        if(empty($url)){
            $url = Router::$routes[0]['url'];
        }else{
            foreach(Router::$routes as $k=>$v){
                if( preg_match($v['catcher'], $url, $match)){
                    $request->controller = $v['controlleur'];
                    $request->action = $v['action'];
                    $request->params = array();
                    foreach($v['params'] as $k=>$v){
                        $request->params[$k] = $match[$k];                    
                    }
                    return $request;
                }
            }
        }
        $params = explode('/', $url);
        if( in_array($params[0], array_keys(self::$prefixes)) ){
            $request->prefix = self::$prefixes[$params[0]];
            array_shift($params);
        }
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
        $r['params']=array();
        $r['redir'] = $redir;
        $r['url'] = $url;
        $r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/','${1}:(?P<${1}>${2})', $url);
        $r['origin'] = '/^'.str_replace('/', '\/', $r['origin']).'(?P<args>\/?.*)$/';
        $params = explode('/', $url);
        foreach($params as $k=>$v){
            if(strpos($v,':') ){
                $p = explode(':', $v);
                $r['params'][$p[0]]  = $p[1];
            }else{
                if($k === 0){
                    $r['controlleur'] = $v;
                }else if($k === 1){
                    $r['action'] = $v;
                }
            }
        }
        $r['catcher'] = $redir;
        foreach($r['params']as $k=>$v){
            $r['catcher'] = str_replace(":$k","(?P<$k>$v)",$r['catcher']);
        }
        $r['catcher'] = '/^'.str_replace('/', '\/', $r['catcher']).'(?P<args>\/?.*)$/';
        self::$routes[] = $r;
    }

    /**
    * Permet de parser une url
    * @url : $url  URL a parser 
    **/
    static function url($url){
        
        foreach(self::$routes as $v){
            if( preg_match($v['origin'], $url, $match)){
                foreach($match as $k=>$w){
                    if(!is_numeric($k)){
                        $v['redir'] = str_replace(":$k", $w, $v['redir'] );
                    }
                }
                return str_replace('//','/', $v['redir'].$match['args']);
            }
        }
        foreach(self::$prefixes as $k=>$v){
            if(strpos($url, $v) === 0){
                $url = str_replace($v,$k,$url);
            }
        }
        return '/'.$url;
    }

 }
