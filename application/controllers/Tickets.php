<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("tickets_model");
    }

    public function index()
    {
        $usuario = $this->session->userdata("auth");

        $tickets = $this->tickets_model->obtenerPorEmisor($usuario["id"]);
    }
}