<?php
require_once('Utils.php');
class Reyes{
    
    protected $_conexion;
    public function __construct(){
        $this->_conexion = Utils::conectar();
    }
   
    public function selectAll(){
        $sql = 'SELECT * FROM reyesmagos';
        return $this->_conexion->query($sql);
    }
        
    public function insert($data){
        if(empty($data['nombre'])){
            throw new Exception('Debe rellenar el campo de NOMBRE.');
        }else{
            $sql = 'INSERT INTO regalos (nombre) VALUES ("'.$data['nombre'].'")';
            var_dump($sql);
            $this->_conexion->query($sql);
            return $this->_conexion->insert_id;
        }
    }
}