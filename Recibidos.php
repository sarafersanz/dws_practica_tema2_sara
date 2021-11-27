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
        $sql = 'SELECT * FROM recibidos WHERE id_nino = ' . (int)$id;
        return $this->_conexion->query($sql);
    }
}
