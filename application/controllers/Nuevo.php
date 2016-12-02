<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nuevo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("tickets_model");
        $this->load->model("colaboradores_model");
    }

    public function index()
    {
        $colaboradores = $this->colaboradores_model->obtenerTodos();
    }
}