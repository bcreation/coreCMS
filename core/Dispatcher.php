<?php
 class Dispatcher{

    var $request;
    function __construct(){
        $this->request = new Request;
         var_dump( $this->request);
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();      
        if (!in_array($this->request->action,array_diff(get_class_methods($controller),get_class_methods('Controller')))){
            $this->error('Le controlleur '.$this->request->controller. ' n\'a pas d action');
        }
        call_user_func_array(
            array($controller, $this->request->action), $this->request->params
        );
  
        $controller->render($this->request->action);
    }

    function error($message){
        $controller = new Controller($this->request);
        $controller->e404($message);  
    }

    function loadController(){
        $name = ucfirst($this->request->controller ).'Controller';              
        $file = ROOT.DS.'controller'.DS.$name.'.php';
        if( file_exists($file) !== true ){
            $this->error("No controlleur");
        }
        require $file;
        return $controller = new $name($this->request);
    }
 }
