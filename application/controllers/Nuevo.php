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
        $this->load->model("seguimientos_model");
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
            "titulo" => "Nuevo ticket",
            "colaboradores" => $datosColaboradores,
            "departamentos" => $departamentos,
            "areas" => $areas
        ]);
    }

    public function crear()
    {
        $colaborador = $_POST["colaborador"];
        $pregunta = $_POST["pregunta"];

        $emisor = $this->session->userdata("auth");
        $receptor = $this->colaboradores_model->obtenerPorId($colaborador);

        $datos = [
            "pregunta" => $pregunta,
            "emisor_id" => $emisor["id"],
            "receptor_id" => $receptor["id"]
        ];

        $result = $this->tickets_model->crear($datos);

        if ($result != false) {
            $ticket = $this->tickets_model->obtenerPorId($result);

            $this->seguimientos_model->crear([
                "observaciones" => "Se ha creado el ticket",
                "tickets_id" => $ticket["id"]
            ]);

            if ($this->enviarCorreo($emisor, $receptor, $ticket)) {
                $this->setMensajeFlash("Éxito", "Ticket creado correctamente", "success");
            } else {
                $this->setMensajeFlash(
                    "Algo salió mal",
                    "El ticket se ha creado correctamente pero no pudo notificarse por correo",
                    "info"
                );
            }

            $accion = $emisor["nombre"] . " ha creado un nuevo ticket";
            $this->registrarAccion($accion, $emisor["id"]);
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

    private function enviarCorreo($emisor, $receptor, $ticket) {
        $fechaTicket = new DateTime($ticket["fecha"]);

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "mtwydm2016@gmail.com";
        $mail->Password = "lasalle2016";

        $mail->setFrom("sistema@mtwydm.com", "Sistema de tickets");

        $mail->addAddress($receptor["correo"]);
        $mail->addCC($emisor["correo"]);

        $mail->isHTML(true);

        $mail->Subject = utf8_decode($emisor["nombre"] . " ha creado un nuevo ticket");
        $mail->Body = '
        <h1>Se ha creado un nuevo ticket :)</h1>
        <p>
            <strong>Creado por</strong>: ' . $emisor["nombre"] . '<br>
            <strong>Fecha</strong>: ' .  $fechaTicket->format('d/m-Y H:i:s') . '<br>
            <strong>Pregunta</strong>: ' . $ticket["pregunta"] . '
        </p>';

        return $mail->send();
    }
}