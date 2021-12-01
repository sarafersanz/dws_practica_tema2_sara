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
        $sql = 'SELECT j.id_regalo, j.nombre FROM recibidos r, regalos j WHERE j.id_regalo = r.id_regalo AND r.id_nino = ' . (int)$id;
        return $this->_conexion->query($sql);
    }

    public function insert($id_nino, $id_regalo)
    {
        $validador = $this->comprobarRegalo($id_nino, $id_regalo);
        if ($validador->num_rows != 0) {
            throw new Exception('El regalo ya existe en la lista.');
        }
        else{
            $sql = 'INSERT INTO recibidos (id_nino, id_regalo) VALUES ("' . $id_nino . '", "' . $id_regalo . '")';
            $this->_conexion->query($sql);
            return $this->_conexion->insert_id;
        }
    }

    private function comprobarRegalo($id_nino, $id_regalo)
    {
        $sql = 'SELECT * FROM recibidos WHERE id_nino = "' . $id_nino . '" and id_regalo = "' . $id_regalo . '";';
        return $this->_conexion->query($sql);
    }
}
