<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("opr_tickets");
    }

    public function obtenerPorEmisor($idColaborador) {
        $query = $this->db->get_where($this->nombre_tabla, ["emisor_id", $idColaborador]);
        return $query->result_array();
    }

    public function obtenerPorResceptor($idColaborador) {
        $query = $this->db->get_where($this->nombre_tabla, ["receptor_id", $idColaborador]);
        return $query->result_array();
    }
}