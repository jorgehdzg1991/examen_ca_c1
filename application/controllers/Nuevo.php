<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nuevo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("tickets_model");
        $this->load->model("colaboradores_model");
        $this->load->model("departamentos_model");
        $this->load->model("areas_model");
    }

    public function index()
    {
        $colaboradores = $this->colaboradores_model->obtenerTodos();
        $departamentos = $this->departamentos_model->obtenerTodos();
        $areas = $this->areas_model->obtenerTodos();

        $datosColaboradores = [];

        foreach ($colaboradores as $colaborador) {
            if ($colaborador["estatus"] == "0") {
                continue;
            }

            $departamento = $this->departamentos_model->obtenerPorId($colaborador["departamentos_id"]);
            $area = $this->areas_model->obtenerPorId($departamento["areas_id"]);

            $datosColaboradores[] = [
                "id" => $colaborador["id"],
                "nombre" => $colaborador["nombre"],
                "departamento" => $departamento["nombre"],
                "area" => $area["nombre"]
            ];
        }

        $this->CargarVista("nuevo/index", [
            "colaboradores" => $datosColaboradores,
            "departamentos" => $departamentos,
            "areas" => $areas
        ]);
    }

    public function crear()
    {
        $colaborador = $_POST["colaborador"];
        $pregunta = $_POST["pregunta"];

        $usuario = $this->session->userdata("auth");

        $datos = [
            "pregunta" => $pregunta,
            "emisor_id" => $usuario["id"],
            "receptor_id" => $colaborador
        ];

        $result = $this->tickets_model->crear($datos);

        if ($result) {
            $accion = $usuario["nombre"] . " ha creado un nuevo ticket";
            $this->registrarAccion($accion, $usuario["id"]);
            $this->setMensajeFlash("Éxito", "Ticket creado correctamente", "success");
            redirect("inicio/index");
        } else {
            $this->setMensajeFlash("Error", "No se pudo generar el ticket", "error");
            redirect("nuevo/index");
        }
    }

    public function obtenerDepartamentosArea($idArea) {
        echo json_encode($this->departamentos_model->obtenerPorArea($idArea));
    }

    public function obtenerColaboradoresArea($idArea) {
        echo json_encode($this->colaboradores_model->obtenerPorArea($idArea));
    }

    public function obtenerColaboradoresDepartamento($idDepartamento) {
        echo json_encode($this->colaboradores_model->obtenerPorDepartamento($idDepartamento));
    }
}