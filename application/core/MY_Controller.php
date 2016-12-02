<?php

abstract class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("acciones_model");
    }

    final protected function CargarVista($nombreVista, $datos = null)
    {
        $mensajeFlash = $this->getMensajeFlash();

        if ($mensajeFlash != null) {
            $datos["mensajeFlash"] = $mensajeFlash;
            $this->unsetMensajeFlash();
        }

        if ($nombreVista == "login/index") {
            $this->load->view($nombreVista, $datos);
            return;
        }

        $datos["auth"] = $this->session->userdata("auth");

        $this->load->library("rightbarmenu");

        $menu = $this->rightbarmenu->ObtenerMenu($nombreVista, $datos["auth"]["perfil"]);

        $datos["menu"] = $menu;

        $this->load->view("compartido/header", $datos);
        $this->load->view($nombreVista);
        $this->load->view("compartido/footer");
    }

    final protected function ValidarSesion()
    {
        return $this->session->userdata("auth") ? true : false;
    }

    final protected function setMensajeFlash($titulo, $mensaje, $tipo) {
        $mensajeFlash = [
            "title" => $titulo,
            "text" => $mensaje,
            "history" => false,
            "type" => $tipo
        ];

        $this->session->set_userdata(["mensajeFlash" => $mensajeFlash]);
    }

    final protected function getMensajeFlash()
    {
        return $this->session->userdata("mensajeFlash");
    }

    final protected function unsetMensajeFlash()
    {
        $this->session->unset_userdata("mensajeFlash");
    }

    final protected function registrarAccion($accion, $idUsuario) {
        $datos = [
            "accion" => $accion,
            "colaboradores_id" => $idUsuario
        ];

        $this->acciones_model->crear($datos);
    }
}