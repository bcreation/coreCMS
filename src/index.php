<?php 
    DEFINE('WEBROOT', dirname(__FILE__) );
    DEFINE('ROOT', dirname(WEBROOT) );
    DEFINE('DS', DIRECTORY_SEPARATOR );
    DEFINE('СORE', ROOT.DS.'core');
    DEFINE('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    
    require СORE.DS.'includes.php';
    new Dispatcher();
 ?>
  
