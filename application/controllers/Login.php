<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->CargarVista("login/index");
    }

    public function start()
    {
        $this->load->model("usuarios_model");

        $username = $_POST["login"];
        $password = $_POST["password"];

        $usuario = $this->usuarios_model->obtenerPorCredenciales($username, $password);

        if ($usuario != false) {
            $this->session->set_userdata(["auth" => [
                "id" => $usuario["id"],
                "nombre" => $usuario["nombre"],
                "login" => $usuario["login"],
                "perfil" => $usuario["perfil"]
            ]]);

            $nombreUsuario = explode(" ", $usuario["nombre"])[0];

            $this->setMensajeFlash(
                "¡Bienvenido $nombreUsuario!",
                "Has iniciado sesión a las " . date("H:i:s"),
                "info"
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
        $this->session->unset_userdata("auth");
        $this->setMensajeFlash("¡Hasta pronto!", "", "info");
        redirect("login/index");
    }
}