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
       
    public function selectRegaloMelchor(){
        $sql ='SELECT n.nombre AS nombre_nino_melchor, r.nombre AS nombre_regalo_melchor, r.precio FROM ninos n, regalos r, recibidos rb, reyesmagos rm WHERE rm.id_reymago = r.id_reymago AND rm.id_reymago = 1 AND r.id_regalo = rb.id_regalo AND n.id_nino = rb.id_nino and n.bueno = 1;';
        return $this->_conexion->query($sql);
        
    }
    public function selectRegaloGaspar(){
        $sql ='SELECT n.nombre AS nombre_nino_gaspar, r.nombre AS nombre_regalo_gaspar, r.precio FROM ninos n, regalos r, recibidos rb, reyesmagos rm WHERE rm.id_reymago = r.id_reymago AND rm.id_reymago = 2 AND r.id_regalo = rb.id_regalo AND n.id_nino = rb.id_nino and n.bueno = 1;';
        return $this->_conexion->query($sql);
        
    }
    public function selectRegaloBaltasar(){
        $sql ='SELECT n.nombre AS nombre_nino_baltasar, r.nombre AS nombre_regalo_baltasar, r.precio FROM ninos n, regalos r, recibidos rb, reyesmagos rm WHERE rm.id_reymago = r.id_reymago AND rm.id_reymago = 3 AND r.id_regalo = rb.id_regalo AND n.id_nino = rb.id_nino and n.bueno = 1;';
        return $this->_conexion->query($sql);
        
    }

    public function comprobarReyCarbon(){
        $sql ='SELECT r.id_reymago FROM regalos r WHERE r.nombre like "Carbón";';
        $rows = $this->_conexion->query($sql);
        if((int)$rows->num_rows){
            $row = $rows->fetch_assoc();
        }else{
            $row = null;
        }
        return $row;

    }
    public function comprobarMalo(){
        $sql ='SELECT n.id_nino, n.nombre as nombre_nino, r.nombre as nombre_carbon FROM ninos n, regalos r WHERE r.nombre like "Carbón" and n.bueno = 0;';
        return $this->_conexion->query($sql);
    }
  
 
}

