<?php

/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 01/12/2016
 * Time: 09:49 PM
 */
abstract class MY_Model extends CI_Model
{
    public $nombre_tabla;

    public function __construct($nombre_tabla)
    {
        parent::__construct();
        $this->nombre_tabla = $nombre_tabla;
    }

    final public function obtenerTodos()
    {
        $query = $this->db->get_where($this->nombre_tabla);
        return $query->result_array();
    }

    final public function obtenerPorId($id)
    {
        $query = $this->db->get_where($this->nombre_tabla, ["id" => $id], 1);
        return $query->row_array();
    }

    final public function crear($data)
    {
        return $this->db->insert($this->nombre_tabla, $data) ? true : false;
    }

    final public function editar($id, $data)
    {
        return $this->db->where("id", $id)->update($this->nombre_tabla, $data) ? true : false;
    }

    final public function eliminar($id)
    {
        return $this->db->delete($this->nombre_tabla, ["id" => $id]) ? true : false;
    }
}