<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ValidarSesion()) {
            redirect("login/index");
        }
    }

    public function index()
    {
        $datos = [
            "titulo" => "Inicio"
        ];

        $this->CargarVista("inicio/index", $datos);
    }
}