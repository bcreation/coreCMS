<?php

class PagesController extends Controller{

    function view(){
        $this->loadModel('Portfolio');
        $posts = $this->Portfolio->find(array(
            'conditions' => 'id=1'
        ));
        print_r($posts);
    }

}
