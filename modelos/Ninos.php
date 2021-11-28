<?php
require_once('Utils.php');
class Ninos{
    
    protected $_conexion;
    public function __construct(){
        $this->_conexion = Utils::conectar();
    }
   
    public function selectAll(){
        $sql = 'SELECT * FROM ninos';
        return $this->_conexion->query($sql);
    }
    
    public function select($ID){
        $sql = 'SELECT * FROM ninos WHERE id_nino = '.(int)$ID;
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
            $sql = 'INSERT INTO ninos (nombre, apellido, fechanacimiento, bueno) VALUES ("'.$data['nombre'].'", "'.$data['apellido'].'", "'.$data['fechaNacimiento'].'", "'.$data['bueno'].'")';
            $this->_conexion->query($sql);
            return $this->_conexion->insert_id;
        }
    }
    
    public function update($data){
        if(empty($data['nombre'])){
            throw new Exception('Debe rellenar el campo de NOMBRE.');
        }else{
            $sql = 'UPDATE ninos SET nombre = "'.$data['nombre'].'", apellido = "'.$data['apellido'].'", fechanacimiento = "'.$data['fechaNacimiento'].'", bueno = "'.$data['bueno'].'" WHERE id_nino = '.(int)$data['id_nino'];
            $this->_conexion->query($sql);
            return (int)$data['id_nino'];
        }
    }
    
    public function delete($ID){
        $sql = 'DELETE FROM ninos WHERE id_nino = '.(int)$ID;
        return $this->_conexion->query($sql);
    }
}
