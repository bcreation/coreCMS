<?php
 class Dispatcher{

    var $request;
    function __construct(){
        $this->request = new Request;
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController(); 
        $action = $this->request->action;     
        if( $this->request->prefix){
            $action = $this->request->prefix.'_'.$action;
        }
        if (!in_array($action,array_diff(get_class_methods($controller),get_class_methods('Controller')))){
            $this->error('Le controlleur '.$this->request->controller. ' n\'a pas d action');
        }
        call_user_func_array(
            array($controller, $action), $this->request->params
        );
        $controller->render($action);
    }
    
    function error($message){
        $controller = new Controller($this->request);
        $controller->Session = new Session();
        $controller->e404($message);  
    }
    
    function loadController(){
        $name = ucfirst($this->request->controller ).'Controller';              
        $file = ROOT.DS.'controller'.DS.$name.'.php';
        if( file_exists($file) !== true ){
            $this->error("No controlleur");
        }
        require $file;

        $controller = new $name($this->request);

        $controller->Session = new Session();
        $controller->Form = new Form($controller);
        return $controller;
    }
 }
