<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("tickets_model");
        $this->load->model("seguimientos_model");
        $this->load->model("colaboradores_model");
    }

    public function index()
    {
        $usuario = $this->session->userdata("auth");

        $tickets = $this->tickets_model->obtenerPorEmisor($usuario["id"]);

        $datosTickets = [];

        foreach ($tickets as $ticket) {
            $receptor = $this->colaboradores_model->obtenerPorId($ticket["receptor_id"]);
            $seguimiento = $this->tickets_model->obtenerEstatusTicket($ticket["id"]);

            $fechaTicket = new DateTime($ticket["fecha"]);

            $datosTickets[] = [
                "id" => $ticket["id"],
                "pregunta" => $ticket["pregunta"],
                "receptor" => $receptor["nombre"],
                "fecha" => $fechaTicket->format("d/m/Y H:i:s"),
                "observaciones" => $seguimiento["observaciones"],
                "estatus" => $seguimiento["estatus"]
            ];
        }

        $this->CargarVista("tickets/index", [
            "titulo" => "Mis tickets",
            "tickets" => $datosTickets
        ]);
    }

    public function ver($id) {
        $ticket = $this->tickets_model->obtenerPorId($id);
        $seguimientos = $this->seguimientos_model->obtenerPorTicket($id);

        $fechaTicket = new DateTime($ticket["fecha"]);

        $ticket["fecha"] = $fechaTicket->format("d/m/Y H:i:s");

        $datosSeguimientos = [];

        foreach ($seguimientos as $seguimiento) {
            $fechaSeguimiento = new DateTime($seguimiento["fecha"]);

            $datosSeguimientos[] = [
                "id" => $seguimiento["id"],
                "observaciones" => $seguimiento["observaciones"],
                "fecha" => $fechaSeguimiento->format("d/m/Y H:i:s"),
                "estatus" => $seguimiento["estatus"]
            ];
        }

        $this->CargarVista("tickets/ver", [
            "titulo" => "Ver ticket",
            "ticket" => $ticket,
            "seguimientos" => $datosSeguimientos
        ]);
    }
}