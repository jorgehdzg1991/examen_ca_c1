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

    public function obtenerTodos() {

    }

    public function obtenerPorId($id) {

    }

    public function crear() {

    }

    public function editar() {

    }

    public function eliminar() {
        
    }
}