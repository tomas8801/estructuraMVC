<?php

    /*
     * Mapear la url ingresada en el navegador,
     * 1-controlador
     * 2-método
     * 3-parámetro
     * Ejemplo: /articulos/actualizar/4
     */

     class Core{
         protected $controladorActual = 'paginas';
         protected $metodoActual = 'index';
         protected $parametros = [];
         
         //constructor
         public function __construct() {
             //print_r($this->getUrl());
             $url = $this->getUrl();
             
             //buscar en controladores si el controlador existe
             if (file_exists('../app/controllers/'.  ucwords($url[0]).'.php')) {
                 //si existe se setea como controlador por defecto
                 $this->controladorActual = ucwords($url[0]);
                 
                 //unset indice
                 unset($url[0]);
             }
             
             //requerir el controlador
             require_once '../app/controllers/'.$this->controladorActual.'.php';
             $this->controladorActual = new $this->controladorActual;
         }
         
         public function getUrl(){
//             echo $_GET['url'];
             
            if (isset($_GET['url'])) {
               //recortamos de la url los espacios a la derecha
               $url = rtrim($_GET['url'], '/');
               //filtramos los signos o simbolos
               $url = filter_var($url, FILTER_SANITIZE_URL);
               //dividimos la url en un array de strings donde la / es el delimitador
               $url = explode('/', $url);
               return $url;
            }
         }
         
     }