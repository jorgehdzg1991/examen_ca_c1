<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contestar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets_model');
        $this->load->model('colaboradores_model');
        $this->load->model('seguimientos_model');
        $this->load->model('estatus_model');
    }

    public function index()
    {
        $usuario = $this->session->userdata('auth');

        $tickets = $this->tickets_model->obtenerPorReceptor($usuario['id']);

        $datosTickets = [];

        foreach ($tickets as $ticket) {
            $emisor = $this->colaboradores_model->obtenerPorId($ticket['emisor_id']);
            $seguimiento = $this->tickets_model->obtenerEstatusTicket($ticket["id"]);

            $fechaTicket = new DateTime($ticket["fecha"]);

            $datosTickets[] = [
                "id" => $ticket["id"],
                "pregunta" => $ticket["pregunta"],
                "emisor" => $emisor["nombre"],
                "fecha" => $fechaTicket->format("d/m/Y H:i:s"),
                "observaciones" => $seguimiento["observaciones"],
                "estatus" => $seguimiento["estatus"],
                'idEstatus' => $seguimiento['idEstatus']
            ];
        }

        $this->CargarVista('contestar/index', [
            'titulo' => 'Contestar tickets',
            "tickets" => $datosTickets
        ]);
    }

    public function seguimiento($idTicket)
    {
        $ticket = $this->tickets_model->obtenerPorId($idTicket);
        $seguimiento = $this->tickets_model->obtenerEstatusTicket($ticket["id"]);

        if ($seguimiento['idEstatus'] == 1) {
            $receptor = $this->session->userdata('auth');

            $mensaje = $receptor['nombre'] . ' ha abierto el ticket';

            $result = $this->seguimientos_model->crear([
                'observaciones' => $mensaje,
                'tickets_id' => $ticket['id'],
                'estatus_id' => 2
            ]);

            if ($result) {
                $seguimiento['idEstatus'] = 2;
                $this->registrarAccion($mensaje, $receptor['id']);
                $this->setMensajeFlash('Info', 'Se ha abierto el ticket', 'info');
            } else {
                $this->setMensajeFlash('Error', 'Ha ocurrido un error al abrir el ticket', 'error');
            }
        }

        $catEstatus = $this->estatus_model->obtenerTodos();

        $datosEstatus = [];

        foreach ($catEstatus as $estatus) {
            if (intval($estatus['id']) > intval($seguimiento['idEstatus'])) {
                $datosEstatus[] = $estatus;
            }
        }

        $this->CargarVista('contestar/seguimiento', [
            'titulo' => 'Seguimiento de tickets',
            'ticket' => $ticket,
            'seguimiento' => $seguimiento,
            'catEstatus' => $datosEstatus
        ]);
    }

    public function guardar($idTicket)
    {
        $ticket = $this->tickets_model->obtenerPorId($idTicket);

        $estatus = $_POST['estatus'];
        $observaciones = $_POST['observaciones'];

        $result = $this->seguimientos_model->crear([
            'observaciones' => $observaciones,
            'tickets_id' => $idTicket,
            'estatus_id' => $estatus
        ]);

        if ($result) {
            $seguimiento = $this->tickets_model->obtenerEstatusTicket($ticket["id"]);
            $emisor = $this->colaboradores_model->obtenerPorId($ticket['emisor_id']);
            $receptor = $this->session->userdata('auth');

            $this->enviarCorreo($emisor, $receptor, $ticket, $seguimiento);

            $this->setMensajeFlash('¡Éxito', 'Se ha guardado el seguimiento del ticket', 'success');
            redirect('contestar/index');
        } else {
            $this->setMensajeFlash('Error', 'No se ha podido guardar el seguimiento. Intente nuevamente.', 'error');
            redirect('contestar/seguimiento/' . $idTicket);
        }
    }

    private function enviarCorreo($emisor, $receptor, $ticket, $seguimiento) {
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

        $mail->Subject = utf8_decode($emisor["nombre"] . " ha actualizado un ticket");
        $mail->Body = '
        <h1>Se ha actualizado tu ticket :)</h1>
        <p>
            <strong>Creado por</strong>: ' . $emisor["nombre"] . '<br>
            <strong>Fecha</strong>: ' .  $fechaTicket->format('d/m-Y H:i:s') . '<br>
            <strong>Pregunta</strong>: ' . $ticket["pregunta"] . '<br>
            <strong>Nuevo estatus</strong>: ' . $seguimiento['estatus'] . '<br>
            <strong>Observaciones</strong>: ' . $seguimiento['observaciones'] . '
        </p>';

        return $mail->send();
    }

}