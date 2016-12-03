<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url("inicio/index") ?>">Inicio</a></li>
        <li><a href="<?php echo site_url("tickets/index") ?>">Mis tickets</a></li>
        <li>Ver ticket</li>
    </ol>

    <h1>Ticket</h1>

    <div class="options">
        <div class="btn-toolbar">
            <a href="<?php echo site_url("tickets/index") ?>" class="btn btn-default">
                <i class="fa fa-arrow-left"></i> Regresar
            </a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Seguimiento de ticket</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatables" id="tblSeguimientos">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Observaciones</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($seguimientos as $seguimiento) {
                                echo '
                                    <tr>
                                        <td>' . $seguimiento["id"] . '</td>
                                        <td>' . $seguimiento["observaciones"] . '</td>
                                        <td>' . $seguimiento["fecha"] . '</td>
                                        <td>' . $seguimiento["estatus"] . '</td>
                                    </tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>