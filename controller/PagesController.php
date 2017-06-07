<?php

class PagesController extends Controller{

    function view($name){
        $this->set(array(
            'msg' => 'yoh',
            'test' => 'oui',
        ), 'yoh '.$name);
        $this->render('index');
    }

}
