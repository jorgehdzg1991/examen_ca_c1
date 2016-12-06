<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url("inicio/index") ?>">Inicio</a></li>
        <li><a href="<?php echo site_url("contestar/index") ?>">Contestar tickets</a></li>
        <li>Seguimiento de tickets</li>
    </ol>

    <h1>Seguimiento de tickets</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <?php echo form_open('contestar/guardar/' . $ticket['id'], ['class' => 'form-horizontal']) ?>
                <div class="panel-heading">
                    <h4>Dar seguimiento al ticket</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="cmbEstatus" class="control-label col-sm-3">Estatus</label>
                        <div class="col-sm-6">
                            <select name="estatus" id="cmbEstatus" class="select2-element" style="width: 100%;">
                                <?php
                                foreach ($catEstatus as $estatus) {
                                    echo '<option value="' . $estatus['id'] . '">' . $estatus['nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtObservaciones" class="control-label col-sm-3">Observaciones</label>
                        <div class="col-sm-6">
                            <textarea name="observaciones"
                                      id="txtObservaciones"
                                      class="form-control"
                                      cols="30"
                                      rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="btn-toolbar">
                                <button class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>