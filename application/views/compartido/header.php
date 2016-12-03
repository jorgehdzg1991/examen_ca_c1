<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Examen cuatrimestral | <?php echo $titulo ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto final de primer cuatrimestre de MTWDM">
    <meta name="author" content="Equipo #1">

    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all">  -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styles.min.css?=113") ?>">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

    <link href='<?php echo base_url("assets/demo/variations/sidebar-steel.css") ?>' rel='stylesheet' type='text/css' media='all' id='styleswitcher'>
    <link href='<?php echo base_url("assets/demo/variations/default.css") ?>' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

    <!-- The following CSS are included as plugins and can be removed if unused-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/plugins/form-select2/select2.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/plugins/datatables/dataTables.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/plugins/pines-notify/jquery.pnotify.default.css") ?>">
    <link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/plugins/codeprettifier/prettify.css") ?>' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url("assets/plugins/form-toggle/toggles.css") ?>' />

    <!-- <script type="text/javascript" src="assets/js/less.js"></script> -->

    <script type='text/javascript' src='<?php echo base_url("assets/js/jquery-1.10.2.min.js") ?>'></script>
</head>

<body class="">

<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>

    <div class="navbar-header pull-left">
        <a class="navbar-brand" href="<?php echo site_url("home/index") ?>"></a>
    </div>

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                <span><?php echo $auth["nombre"] ?> <i class="fa fa-caret-down"></i></span>
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="<?php echo site_url("perfil/index") ?>">
                        <div class="pull-left">
                            <h5>¡Hola <?php echo explode(" ", $auth["nombre"])[0] ?>!</h5>
                            <small>Iniciaste sesión como <span><?php echo $auth["login"] ?></span></small>
                        </div>
                    </a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url("perfil/index") ?>">Ver Perfil <i class="pull-right fa fa-user" aria-hidden="true"></i></a></li>
                        <li><a href="<?php echo site_url("perfil/editar") ?>">Editar perfil <i class="pull-right fa fa-pencil"></i></a></li>
                        <li><a href="<?php echo site_url("configuracion/index") ?>">Configuración <i class="pull-right fa fa-cog"></i></a></li>
                        <li><a href="#">Ayuda <i class="pull-right fa fa-question-circle"></i></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url("login/end") ?>" class="text-right">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</header>

<div id="page-container">
    <!-- BEGIN SIDEBAR -->
    <nav id="page-leftbar" role="navigation">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="acc-menu" id="sidebar">
            <?php
            foreach ($menu as $nombreModulo => $datosModulo) {
                $elemento = '
                    <li' . ($datosModulo["activo"] ? ' class="open active" id="elementoActivo"' : '') . '>
                        <a href="' . (!isset($datosModulo["nodos"]) ? site_url($datosModulo["link"]) : 'javascript:;') . '">
                            <i class="' . $datosModulo["icono"] . '"></i> <span>' . $nombreModulo . '</span>
                        </a>';

                if (isset($datosModulo["nodos"])) {
                    $elemento .= '<ul class="acc-menu">';

                    foreach ($datosModulo["nodos"] as $nombreNodo => $propiedades) {
                        $elemento .= '
                            <li' . ($propiedades["activo"] ? ' class="active"' : '') . '>
                                <a href="' . site_url($propiedades["link"]) . '">
                                    ' . $nombreNodo . '
                                </a>
                            </li>';
                    }

                    $elemento .= '</ul>';
                }

                $elemento .= '</li>';

                echo $elemento;
            }
            ?>

        </ul>
        <!-- END SIDEBAR MENU -->
    </nav>

    <div id="page-content">
        <div id='wrap'>
            <input type="hidden" id="mensajeFlash" value='<?php echo isset($mensajeFlash) ? json_encode($mensajeFlash) : '' ?>'>