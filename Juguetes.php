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
}