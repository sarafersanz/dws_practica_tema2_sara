<?php

require_once('Utils.php');
class Recibidos
{
    protected $_conexion;
    public function __construct()
    {
        $this->_conexion = Utils::conectar();
    }

    public function selectFromNino($id)
    {
        $sql = 'SELECT j.id_juguete, j.nombre FROM recibidos r, juguetes j where j.id_juguete = r.id_juguete and r.id_nino = ' . (int)$id;
        return $this->_conexion->query($sql);
    }

    public function insert($id_nino, $id_juguete)
    {
        $sql = 'INSERT INTO recibidos (id_nino, id_juguete) VALUES ("'.$id_nino.'", "'.$id_juguete.'")';
        print_r($sql);   
        $this->_conexion->query($sql);
            return $this->_conexion->insert_id;
    }
}
