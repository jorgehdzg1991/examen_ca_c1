<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("ctl_departamentos");
    }

    public function obtenerPorArea($idArea) {
        $sql = "
            SELECT
                depar.id AS id,
                depar.nombre AS nombre
            FROM
                ctl_departamentos AS depar";

        if ($idArea != "0") {
            $sql .= "
            WHERE
                depar.areas_id = $idArea";
        }

        $query = $this->db->query($sql);

        return $query->result_array();
    }
}