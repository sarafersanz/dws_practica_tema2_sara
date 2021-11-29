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
//SELECT r.nombre, n.nombre, r.precio from reyesmagos rm, regalos r, recibidos rb, ninos n where rm.id_reymago = r.id_reymago and rm.id_reymago = 1 and r.id_regalo = rb.id_regalo and n.id_nino = rb.id_nino;