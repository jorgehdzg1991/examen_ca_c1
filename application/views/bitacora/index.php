<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url("inicio/index") ?>">Inicio</a></li>
        <li>Bitácora de acciones</li>
    </ol>

    <h1>Bitácora de acciones</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Mi historial de acciones</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatables" id="tblAcciones">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Acción</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($acciones as $accion) {
                                echo '
                                    <tr>
                                        <td>' . $accion["id"] . '</td>
                                        <td>' . $accion["accion"] . '</td>
                                        <td>' . $accion["fecha"] . '</td>
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