<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacora extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $usuario = $this->session->userdata('auth');

        $acciones = $this->acciones_model->obtenerPorColaborador($usuario['id']);

        $datosAcciones = [];

        foreach ($acciones as $accion) {
            $fechaAccion = new DateTime($accion['fecha']);

            $datosAcciones[] = [
                'id' => $accion['id'],
                'accion' => $accion['accion'],
                'fecha' => $fechaAccion->format('d/m/Y H:i:s')
            ];
        }

        $this->CargarVista('bitacora/index', [
            'titulo' => 'Bitácora de acciones',
            'acciones' => $datosAcciones
        ]);
    }
}