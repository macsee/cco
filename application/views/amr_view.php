
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('bootstrap/font-awesome/css/font-awesome.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <style>
    </style>
  </head>

  <body>

    <div class="container-fluid">
        
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#datos_facturacion">Datos Turno</a></li>
            <li><a data-toggle="tab" href="#datos_paciente">Datos Paciente</a></li>
        </ul>
        <div class="tab-content" style = "margin-top:20px">

            <div id="datos_facturacion" class="tab-pane fade in active">
                <form class="form" role="form" method = "post" action = "<?php echo base_url('index.php/main/process')?>">
                    <input name="turno_id" type="hidden">
                    <input name="turno_id_paciente" type="hidden">
                    <input name="turno_fecha" type="hidden">
                    <div class = "row">
                        <div class="col-md-3">
                            <label>Hora</label>
                            <input class="form-control" id = "turno_hora" name="turno_hora" type="time" required>
                        </div>
                        <div class="col-md-3">
                            <label>Citado</label>
                            <input class="form-control" id = "turno_citado" name="turno_citado" type="time" required>
                        </div>
                        <div class="col-md-3">
                            <label>Medico Solicitante</label>
                            <select class="form-control" id = "turno_medico" name="turno_medico" required>
                                <?php
                                    foreach ($medicos as $med) {    
                                        echo '<option value = "'.$med->id_medico.'">'.$med->nombre.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Localidad</label>
                            <select class="form-control" id = "turno_localidad" name="turno_localidad" required>
                                <?php 
                                    foreach ($localidades as $loc) {    
                                        echo '<option value = "'.$loc->id_localidad.'">'.$loc->departamento.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class = "row" style = "margin-top:10px">
                        <div class="col-md-3">
                            <label>Apellido</label>
                            <input style = "text-transform: capitalize" class="form-control" id = "turno_apellido" name="turno_apellido" type="text" required>
                        </div>
                        <div class="col-md-3">
                            <label>Nombre</label>
                            <input style = "text-transform: capitalize" class="form-control" id = "turno_nombre" name="turno_nombre" type="text" required>
                        </div>
                        <div class="col-md-3">
                            <label>Teléfono</label>
                            <div class="col-md-12" style = "padding-left:0px">
                                <input style = "width:37%;display:inline" class="form-control" id = "turno_tel11" name="turno_tel11" type="tel" maxlength="5">
                                <input style = "width:60%;display:inline" class="form-control" id = "turno_tel12" name="turno_tel12" type="tel" maxlength="10">
                            </div>    
                        </div>
                        <div class="col-md-3">
                            <label>Celular</label>
                            <div class="col-md-12" style = "padding-left:0px">
                                <input style = "width:37%;display:inline" class="form-control" id = "turno_tel21" name="turno_tel21" type="tel" maxlength="5">
                                <input style = "width:60%;display:inline" class="form-control" id = "turno_tel22" name="turno_tel22" type="tel" maxlength="10">
                            </div>    
                        </div>
                    </div>
                    <div class = "row" style = "margin-top:10px">
                        <div class = "col-md-12">
                            <button class="btn btn-primary btn-sm add">
                                Agregar Práctca <span class = "glyphicon glyphicon-plus"></span>
                            </button>
                        </div>        
                    </div>

                    <hr style = "margin-top:10px;margin-bottom:10px">

                    <div class = "contenido">

                    </div>   

                    <hr style = "margin-top:10px;margin-bottom:10px">

                    <div class = "row" style = "margin-top:20px">
                        <div class="col-md-4">
                            <label>Nro. Factura</label>
                            <input class="form-control" id = "turno_nro_factura" name = "turno_nro_factura" type="text">
                        </div>
                        <div class="col-md-1">
                            <label>Tipo</label>
                            <select class="form-control" id = "turno_tipo_factura" name = "turno_tipo_factura">
                                <option>A</option>
                                <option>B</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Importe</label>
                            <input class="form-control" id = "turno_importe_factura" id = "turno_importe_factura" type="text">
                        </div>
                    </div>

                    <div class = "col-xs-12" style = "margin-top:20px">
                        <div class="modal-footer">
                            <button id = "aceptar" type="submit" class="btn btn-default">Actualizar</button>
                            <button id = "cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="datos_paciente" class="tab-pane fade in">
                <form class="form-horizontal" role="form">
                    <div class = "col-md-6">
                        <div class="form-group">
                            <label  class="col-md-5 control-label">Nombre</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="paciente_nombre" placeholder="Nombre"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Apellido</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="paciente_apellido" placeholder="Apellido"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Fecha de Nacimiento</label>
                            <div class="col-md-7">
                                <input type="date" class="form-control" name="paciente_fecha" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">DNI</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="paciente_dni" placeholder="Sin Puntos"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Localidad</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="paciente_localidad" placeholder="Localidad"/>
                            </div>
                        </div>
                    </div>
                    <div class = "col-md-6">
                        <div class="form-group">
                            <label class="col-md-5 control-label">Teléfono</label>  
                            <div class="col-md-7">
                                <input style = "width:37%;display:inline" class="form-control" name="turno_tel11" type="tel" maxlength="5">
                                <input style = "width:60%;display:inline" class="form-control" name="turno_tel12" type="tel" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Celular</label>
                            <div class="col-md-7">
                                <input style = "width:37%;display:inline" class="form-control" name="turno_tel11" type="tel" maxlength="5">
                                <input style = "width:60%;display:inline" class="form-control" name="turno_tel12" type="tel" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Obra Social</label>
                            <div class="col-md-7">
                                <select class="form-control" name="paciente_obra"/>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Nro. Afiliado</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="paciente_afiliado" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Observaciones</label>
                            <div class="col-md-7">
                                <textarea class="form-control" name="paciente_obs" placeholder=""/></textarea>
                            </div>
                        </div>
                    </div>
                    <div class = "col-md-12">
                        <div class="modal-footer">
                            <button id = "aceptar" type="submit" class="btn btn-default">Actualizar</button>
                            <button id = "cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>        
                </form>
            </div>
        </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?php echo base_url('js/jquery/jquery-2.2.0.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>
  </body>
</html>
