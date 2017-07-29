<?php 
class Conf{

    static $debug = 1;
    static $databases = array(
        'default' => array(
            'host' => 'localhost:8889',
            'database' => 'Wulfila',
            'login' => 'root',
            'password' => 'root',
        ),
    );
}
Router::connect('post/:slug-:id', 'posts/view/id:([0-9]+)/slug:([a-z0-9\-])+');
