<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contestar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->CargarVista("contestar/index", [
            "titulo" => "Contestar tickets"
        ]);
    }

}