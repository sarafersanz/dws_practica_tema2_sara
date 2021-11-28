<?php

 require_once('Utils.php');
class Juguetes{
    protected $_conexion;
    public function __construct(){
        $this->_conexion = Utils::conectar();
    }

    public function selectAll(){
        $sql = 'SELECT * FROM juguetes;';
        //var_dump($sql);
        return $this->_conexion->query($sql);
    }

    /* public function insert($data){
        if(empty($data['juguete'])){
            throw new Exception('Debe rellenar el campo de NOMBRE.');
        }else{
            $sql = 'INSERT INTO juguetes (nombre, precio) VALUES ("'.$data['nombre'].'", "'.$data['precio'].'")';
            $this->_conexion->query($sql);
            return $this->_conexion->insert_id;
        }
    } */
}