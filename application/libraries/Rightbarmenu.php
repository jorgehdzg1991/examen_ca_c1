<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rightbarmenu
{
    public function ObtenerMenu($moduloActual, $perfilUsuario)
    {
        $menu = [
            "Inicio" => [
                "link" => "inicio/index",
                "icono" => "fa fa-home",
                "activo" => false
            ],
            "Nuevo ticket" => [
                "link" => "nuevo/index",
                "icono" => "fa fa-file-o",
                "activo" => false
            ],
            "Mis tickets" => [
                "link" => "tickets/index",
                "icono" => "fa fa-ticket",
                "activo" => false
            ],
            "Contestar tickets" => [
                "link" => "contestar/index",
                "icono" => "fa fa-comment-o",
                "activo" => false
            ],
            'Bitácora de acciones' => [
                'link' => 'bitacora/index',
                'icono' => 'fa fa-list-ol',
                'activo' => false
            ]
        ];

        foreach ($menu as $elemento => $propiedades) {
            if (isset($propiedades["nodos"])) {
                foreach ($propiedades["nodos"] as $subelemento => $propiedadesSubelemento) {
                    $controlador = explode("/", $propiedadesSubelemento["link"])[0];
                    $controladorActual = explode("/", $moduloActual)[0];

                    if ($controlador == $controladorActual) {
                        $menu[$elemento]["activo"] = true;
                        $menu[$elemento]["nodos"][$subelemento]["activo"] = true;
                    }
                }
            } else {
                if ($propiedades["link"] == $moduloActual) {
                    $menu[$elemento]["activo"] = true;
                }
            }
        }

        return $menu;
    }
}