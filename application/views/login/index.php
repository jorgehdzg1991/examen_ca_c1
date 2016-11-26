<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Proyecto final | Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Proyecto final de primer cuatrimestre de MTWDM">
    <meta name="author" content="Equipo #1">

    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all"> -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/styles.min.css?=113") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/plugins/pines-notify/jquery.pnotify.default.css") ?>">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

    <script type='text/javascript' src='<?php echo base_url("assets/js/jquery-1.10.2.min.js") ?>'></script>

    <!-- <script type="text/javascript" src="assets/js/less.js"></script> -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/themes/default.css") ?>">
</head>
<body class="focusedform" style="background-color: #8c9998 !important;">
<input type="hidden" id="mensajeFlash" value='<?php echo isset($mensajeFlash) ? json_encode($mensajeFlash) : '' ?>'>
<div class="verticalcenter">
    <a href="https://www.matatenamx.com/"><img src="<?php echo base_url("assets/img/logo-big.png") ?>" alt="Logo" class="brand" /></a>
    <div class="panel panel-primary">
        <?php echo form_open("login/start", ["style" => "margin-bottom: 0px !important;"]) ?>
            <div class="panel-body">
                <h4 class="text-center" style="margin-bottom: 25px;">¡Bienvenido!</h4>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="txtLogin" name="login" placeholder="Nombre de usuario">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="txtPassword" name="password" placeholder="Contraseña">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
            </div>
        <?php echo form_close() ?>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url("assets/plugins/pines-notify/jquery.pnotify.min.js") ?>"></script>
<script>
    if ($("#mensajeFlash").val() !== "") {
        $.pnotify(JSON.parse($("#mensajeFlash").val()));
    }
</script>
</body>
</html>