<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("colaboradores_model");
    }

    public function index()
    {
        $this->CargarVista("login/index");
    }

    public function start()
    {
        $login = $_POST["login"];
        $password = $_POST["password"];

        $usuario = $this->colaboradores_model->obtenerPorCredenciales($login, $password);

        if ($usuario != false) {
            $this->session->set_userdata(["auth" => [
                "id" => $usuario["id"],
                "nombre" => $usuario["nombre"],
                "login" => $usuario["login"],
                "correo" => $usuario["correo"],
                "perfil" => $usuario["perfil"],
                "area" => $usuario["areas_id"],
                "departamento" => $usuario["departamentos_id"]
            ]]);

            $nombreUsuario = explode(" ", $usuario["nombre"])[0];

            $this->setMensajeFlash(
                "¡Bienvenido $nombreUsuario!",
                "Has iniciado sesión a las " . date("H:i:s"),
                "info"
            );

            $usuario = $this->session->userdata("auth");

            $this->registrarAccion(
                "El usuario " . $usuario["nombre"] . " inició sesión",
                $usuario["id"]
            );

            redirect("inicio/index");
        } else {
            $this->setMensajeFlash(
                "Error de inicio de sesión",
                "No se ha encontrado una combinación de usuario y contraseña válidos",
                "error"
            );
            redirect("login/index");
        }
    }

    public function end()
    {
        $usuario = $this->session->userdata("auth");

        $this->registrarAccion(
            "El usuario " . $usuario["nombre"] . " cerró su sesión",
            $usuario["id"]
        );

        $this->session->unset_userdata("auth");

        $this->setMensajeFlash("¡Hasta pronto!", "", "info");

        redirect("login/index");
    }
}