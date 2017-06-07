<?php
 class Request{

    public $url; // URL appelé par l'user'
    function __construct(){
        $this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '' ;
    }

 }
