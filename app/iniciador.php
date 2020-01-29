<?php
    //Cargamos librerias
    require_once 'config/config.php';
    
    
//    require_once 'libreries/Database.php';
//    require_once 'libreries/Controller.php';
//    require_once 'libreries/Core.php';
    
    
    //Autoload php
    spl_autoload_register(function($nombreClase){
        //var_dump($nombreClase);
        require_once 'libreries/'.$nombreClase.'.php';
    });
    
//    function __autoload($className) {
//      if (file_exists($className . '.php')) {
//          require_once 'libreries/'.$className.'.php';
//          return true;
//      }
//      return false;
//}