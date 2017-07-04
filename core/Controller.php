<?php
class Controller{

    public $request; 
    private $vars = array(); 
    public $layout = 'default';
    private $rendered = false;

    function __construct($request = null){
        if($request){
            $this->request = $request;
        }
    }
/**
 * Manage the view
 *
 * @param [type] $view
 * @return void
 */
    public function render($view){
  
        if($this->rendered){
            return false;
        }
        extract($this->vars);
        if(strpos($view,'/') === 0){
            $view = ROOT.DS.'view'.$view.'.php';
            
        }else{
            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
        }
        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.'default.php';
        $this->rendered = true;
    }
/**
 * Manage the variables to send at the view
 *
 * @param [type] $key
 * @param [type] $value
 * @return void
 */
    public function set($key,$value=null){
        if(is_array($key)){
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;

        }
    }
/**
 * Manage the loading of a model
 *
 * @param [type] $name
 * @return void
 */
    public function loadModel($name){
        $file = ROOT.DS.'model'.DS.$name.'.php';
        require_once($file);
        if( !isset($this->$name)){
            $this->$name = new $name();
        }
    }
/**
 * Manage errors 404
 *
 * @param [type] $msg
 * @return void
 */
    public function e404($msg){
        header("HTTP/1,0 404 Not Found");
        $this->set('message',$msg);
        $this->render("/errors/404");
        die();
    }

/**
 * Call a Controller from a view 
 *
 * @param [type] $controller
 * @param [type] $action
 * @return void
 */
    public function request($controller, $action){

        $controller .= 'Controller';
        require_once ROOT.DS.'controller'.DS.$controller.'.php';
        $c = new $controller();
        return $c->$action();

    }

}
