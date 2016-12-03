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

    public function obtenerPorArea($idArea) {
        $sql = "
            SELECT
                colab.id AS id,
                colab.nombre AS nombre,
                depar.nombre AS departamento
            FROM
                ctl_colaboradores AS colab
            INNER JOIN ctl_departamentos AS depar ON colab.departamentos_id = depar.id";

        if ($idArea != "0") {
            $sql .= "
            WHERE
                depar.areas_id = $idArea";
        }

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function obtenerPorDepartamento($idDepartamento) {
        $sql = "
            SELECT
                colab.id AS id,
                colab.nombre AS nombre,
                depar.nombre AS departamento
            FROM
                ctl_colaboradores AS colab
            INNER JOIN ctl_departamentos AS depar ON colab.departamentos_id = depar.id
            WHERE
                depar.id = $idDepartamento";

        if ($idDepartamento != "0") {
            $sql .= "
            WHERE
                depar.areas_id = $idArea";
        }

        $query = $this->db->query($sql);

        return $query->result_array();
    }
}