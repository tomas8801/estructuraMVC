<?php
    //Clase controlador principal
    //se encarga de poder cargar los modelos y las vistas

class Controlador{
    
    //Cargar modelo
    public function modelo($modelo){
        //carga
        require_once '../app/models/'.$modelo.'.php';
        //Instanciar el modelo
        return new $modelo();
    }
    
    //Cargar vista
    public function vista($vista, $datos = []){
        //chequear si existe el archivo vista
        if (file_exists('../app/views/'.$vista.'.php')) {
            //carga
            require_once '../app/views/'.$vista.'.php';
        }else{
            die('La vista no existe');
        }
    }
}