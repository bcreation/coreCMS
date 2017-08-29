<?php 
Class Session{
    function __construct(){
        if(!isset($_SESSION) ){
            session_start();
        }
    }

    public function setFlash($msg, $type = ""){
        $_SESSION['flash'] = array(
            'message' => $msg,
            'type' => $type
        );
    }

    public function flash(){
        if(isset($_SESSION['flash']['message'])){
            $html = '<div class="alert alert-success"><p>'.$_SESSION['flash']['message']."</p></div>";
            $_SESSION['flash'] = array();
        }
    }
}