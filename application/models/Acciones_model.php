<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acciones_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("bit_acciones");
    }

    public function obtenerPorColaborador($idColaborador) {
        $sql = "
        SELECT
            accio.id AS id,
            accio.accion AS accion,
            accio.fecha AS fecha
        FROM
            bit_acciones AS accio
        WHERE
            accio.colaboradores_id = $idColaborador
        ORDER BY
            fecha DESC";

        $query = $this->db->query($sql);

        return $query->result_array();
    }
}