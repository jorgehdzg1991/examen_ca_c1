<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acciones_model extends CI_Model
{
    private $nombre_tabla;

    public function __construct()
    {
        parent::__construct();

        $this->nombre_tabla = "bit_acciones";
    }

    public function crear($data)
    {
        return $this->db->insert($this->nombre_tabla, $data) ? true : false;
    }
}