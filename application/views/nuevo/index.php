<div id="page-heading">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url("inicio/index") ?>">Inicio</a></li>
        <li>Nuevo ticket</li>
    </ol>

    <h1>Inicio</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <?php echo form_open("nuevo/crear", ["id" => "frmCrear" ,"class" => "form-horizontal"]) ?>
                <div class="panel-heading">
                    <h4>Crear un nuevo ticket</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="cmbArea" class="control-label col-sm-3">Area</label>
                        <div class="col-sm-6">
                            <select id="cmbArea" class="select2-element" style="width: 100%;">
                                <option value="0">Todas las areas</option>
                                <?php
                                foreach ($areas as $area) {
                                    echo '<option value="' . $area["id"] . '">' . $area["nombre"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cmbDepartamento" class="control-label col-sm-3">Departamento</label>
                        <div class="col-sm-6">
                            <select id="cmbDepartamento" class="select2-element" style="width: 100%;">
                                <option value="0">Todos los departamentos</option>
                                <?php
                                foreach ($departamentos as $departamento) {
                                    echo '<option value="' . $departamento["id"] . '">' . $departamento["nombre"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cmbColaborador" class="control-label col-sm-3">Colaborador</label>
                        <div class="col-sm-6">
                            <select name="colaborador" id="cmbColaborador" class="select2-element" style="width: 100%;">
                                <option value="0">Seleccione un colaborador</option>
                                <?php
                                foreach ($colaboradores as $colaborador) {
                                    echo '<option value="' . $colaborador["id"] . '">' . $colaborador["nombre"] . ' (' . $colaborador["departamento"] . ')</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtPregunta" class="control-label col-sm-3">Pregunta</label>
                        <div class="col-sm-6">
                            <textarea name="pregunta" id="txtPregunta" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="btn-toolbar">
                                <button class="btn btn-primary">Generar ticket</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
    function actualizarDepartamentos(datos) {
        $('#cmbDepartamento').html('<option value="0">Todos los departamentos</option>');
        for (var i = 0; i < datos.length; i++) {
            $('#cmbDepartamento').append('<option value="' + datos[i]['id'] + '">' + datos[i]['nombre'] + '</option>');
        }
        $('#cmbDepartamento').select2();
    }

    function actualizarColaboradores(datos) {
        $('#cmbColaborador').html('');
        for (var i = 0; i < datos.length; i++) {
            $('#cmbColaborador').append('<option value="' + datos[i]['id'] + '">' + datos[i]['nombre'] + ' (' + datos[i]['departamento'] + ')</option>');
        }
        $('#cmbColaborador').select2();
    }

    $(document).ready(function () {
        $("#cmbArea").change(function () {
            var idArea = $("#cmbArea").val();
            $.ajax({
                url: 'http://localhost:8000/nuevo/obtenerDepartamentosArea/' + idArea,
                method: 'GET',
                dataType: 'json',
                success: function(datos) {
                    actualizarDepartamentos(datos);

                    $.ajax({
                        url: 'http://localhost:8000/nuevo/obtenerColaboradoresArea/' + idArea,
                        method: 'GET',
                        dataType: 'json',
                        success: function(datos) {
                            actualizarColaboradores(datos);
                        }
                    });
                }
            });
        });

        $("#cmbDepartamento").change(function () {
            var idDepartamento = $("#cmbDepartamento").val();
            $.ajax({
                url: 'http://localhost:8000/nuevo/obtenerColaboradoresDepartamento/' + idDepartamento,
                method: 'GET',
                dataType: 'json',
                success: function(datos) {
                    actualizarColaboradores(datos);
                }
            });
        });
    });
</script>