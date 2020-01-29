<?php
    //Clase para conectarse a la base de datos y ejecutar consultas PDO

    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASSWORD;
        private $name = DB_NAME;
        
        private $dbh;
        private $stmt;
        private $error;
        
        public function __construct(){
            //configurar conexion
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->name;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            
            //Crear una instancia de PDO
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
                $this->dbh->exec("SET NAMES 'utf8'");
            } catch (PDOException $ex) {
                $this->error = $ex->getMessage();
                echo $this->error;
            }
        }
        
        //Preparamos la consulta
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }
        
        //Bindeamos los parametros de la consulta
        public function bind($parametro, $valor, $tipo = null){
            if (is_null($tipo)) {
                switch (true){
                    case is_int($valor):
                        $tipo = PDO::PARAM_INT;
                        break;
                    case is_bool($valor):
                        $tipo = PDO::PARAM_BOOL;
                        break;
                    case is_null($valor):
                        $tipo = PDO::PARAM_NULL;
                        break;
                    default :
                        $tipo = PDO::PARAM_STR;
                        break;
                }
            }
            $this->stmt->bindValue($parametro, $valor, $tipo);
            
        }
        
        //Ejecutamos la consulta
        public function execute(){
            return $this->stmt->execute();
        }
        
        //Obtenemos todos los registros
        public function registros(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        //Obtener un solo registro
        public function registro(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }
        
        //Obtener cantidad de filas con el metodo rowCount
        public function rowCount(){
            return $this->stmt->rowCount();
        }
        
        
    }   