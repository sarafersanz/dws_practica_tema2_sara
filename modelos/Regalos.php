<?php
require_once('Utils.php');
class Regalos{
    
    protected $_conexion;
    public function __construct(){
        $this->_conexion = Utils::conectar();
    }
   
    public function selectAll(){
        $sql = 'SELECT * FROM regalos';
        return $this->_conexion->query($sql);
    }
    
    public function select($ID){
        $sql = 'SELECT * FROM regalos WHERE id_regalo = '.(int)$ID;
        $rows = $this->_conexion->query($sql);
        if((int)$rows->num_rows){
            $row = $rows->fetch_assoc();
        }else{
            $row = null;
        }
        return $row;
    }
    
    public function insert($data){
        if(empty($data['nombre'])){
            throw new Exception('Debe rellenar el campo de NOMBRE.');
        }else{
            $sql = 'INSERT INTO regalos (nombre, precio, id_reymago) VALUES ("'.$data['nombre'].'",  "'.$data['precio'].'", "'.(int)$data['id_reymago'].'")';
            $this->_conexion->query($sql);
            return $this->_conexion->insert_id;
        }
    }
    
    public function update($data){
        if(empty($data['nombre'])){
            throw new Exception('Debe rellenar el campo de NOMBRE.');
        }else{
            $sql = 'UPDATE regalos SET nombre = "'.$data['nombre'].'", precio = "'.$data['precio'].'", id_reymago = "'.(int)$data['id_reymago'].'" WHERE id_regalo = "'.(int)$data['id_regalo'].'"';
            $this->_conexion->query($sql);
            return (int)$data['id_regalo'];
        }
    }
    
    public function delete($ID){
        $sql = 'DELETE FROM regalos WHERE id_regalo = '.(int)$ID;
        return $this->_conexion->query($sql);
    }
}
