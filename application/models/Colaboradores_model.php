<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("ctl_colaboradores");
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