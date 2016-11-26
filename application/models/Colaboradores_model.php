<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores_model extends CI_Model
{
    private $nombre_tabla;

    public function __construct()
    {
        parent::__construct();

        $this->nombre_tabla = "ctl_colaboradores";
    }

    public function obtenerTodos()
    {
        $query = $this->db->get_where($this->nombre_tabla, ["estatus" => 1]);
        return $query->result_array();
    }

    public function obtenerPorId($id)
    {
        $query = $this->db->get_where($this->nombre_tabla, ["id" => $id], 1);
        return $query->row_array();
    }

    public function obtenerPorCredenciales($login, $password)
    {
        $query = $this->db->get_where($this->nombre_tabla, [
            "login" => $login,
            "passwd" => md5($password),
            "estatus" => 1
        ], 1);

        return $query->row_array();
    }
}