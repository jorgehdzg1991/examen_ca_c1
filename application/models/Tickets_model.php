<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("opr_tickets");
    }

    public function obtenerPorEmisor($idColaborador) {
        $query = $this->db->get_where($this->nombre_tabla, ["emisor_id" => $idColaborador]);
        return $query->result_array();
    }

    public function obtenerPorReceptor($idColaborador) {
        $query = $this->db->get_where($this->nombre_tabla, ["receptor_id" => $idColaborador]);
        return $query->result_array();
    }

    public function obtenerEstatusTicket($id) {
        $sql = "
        SELECT
            segui.observaciones AS observaciones,
            estat.id AS idEstatus,
            estat.nombre AS estatus
        FROM
            opr_seguimientos AS segui
        INNER JOIN cat_estatus AS estat ON estat.id = segui.estatus_id
        WHERE
            segui.tickets_id = $id
        ORDER BY
            segui.fecha DESC
        LIMIT 1";

        $query = $this->db->query($sql);

        return $query->row_array();
    }
}