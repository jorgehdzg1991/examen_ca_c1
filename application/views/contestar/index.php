<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url("inicio/index") ?>">Inicio</a></li>
        <li>Contestar tickets</li>
    </ol>

    <h1>Contestar tickets</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Contestar tickets</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatables" id="tblTickets">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pregunta</th>
                                <th>Emisor</th>
                                <th>Fecha</th>
                                <th>Observaciones</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($tickets as $ticket) {
                                $disabled = $ticket['idEstatus'] == '5' ? ' disabled="disabled"' : '';

                                echo '
                                    <tr>
                                        <td>' . $ticket["id"] . '</td>
                                        <td>' . $ticket["pregunta"] . '</td>
                                        <td>' . $ticket["emisor"] . '</td>
                                        <td>' . $ticket["fecha"] . '</td>
                                        <td>' . $ticket["observaciones"] . '</td>
                                        <td>' . $ticket["estatus"] . '</td>
                                        <td>
                                            <a href="' . site_url("contestar/seguimiento/" . $ticket["id"]) . '" 
                                               class="btn btn-default btn-sm"
                                               ' . $disabled . '>
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
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