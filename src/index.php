<?php 
    $debut = microtime(true);
    DEFINE('WEBROOT', dirname(__FILE__) );
    DEFINE('ROOT', dirname(WEBROOT) );
    DEFINE('DS', DIRECTORY_SEPARATOR );
    DEFINE('СORE', ROOT.DS.'core');
    DEFINE('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    
    require СORE.DS.'includes.php';
    new Dispatcher();
?>
<div style="position:fixed;bottom:0;left:0;right:0;background:red;color:white;padding:5px;" >
    <?= 'Page généré en ' . round( microtime(true ) - $debut , 5 ).' seconde'; ?>
 </div>
  
