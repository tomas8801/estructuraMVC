<?php

class Paginas extends Controlador{
    public function __construct() {
        //echo 'Controlador de paginas cargado';
    }
    
    public function index(){
        $datos = [
            'titulo' => 'Bienvenidos a mi framework'
        ];
        $this->vista('inicio', $datos);
    }
    
}

