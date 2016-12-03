<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seguimientos_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("opr_seguimientos");
    }

    public function obtenerPorTicket($idTicket) {
        $sql = "
        SELECT
            opr_seguimientos.id AS id,
            opr_seguimientos.observaciones AS observaciones,
            opr_seguimientos.fecha AS fecha,
            cat_estatus.nombre AS estatus
        FROM
            opr_seguimientos
        INNER JOIN cat_estatus ON opr_seguimientos.estatus_id = cat_estatus.id
        WHERE
            opr_seguimientos.tickets_id = 1";

        $query = $this->db->query($sql);

        return $query->result_array();
    }
}