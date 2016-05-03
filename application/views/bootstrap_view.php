
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
        }

        .nuevo_turno {
            cursor:pointer;
        }

        .icono_estado {
            font-size: 20px;
        } 

        .label {
            font-weight: 400;
        }

        .glyphicon {
            margin-right: 10px;
        }

        .cabecera_tabla {
            font-weight: 400;
            font-size: 15px;
            background-color: #454545;
            color: white;
            //display: inline-block;
        }

        .page-header {
            margin-top: 0px;
        }

        .control-label {
            text-align:left!important;
            /*font-size: 12px!important;*/
        }

        .modal-body {
            //overflow: auto;
        }

        .contenido {
            height: 150px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .practica {
            padding:10px;
            background-color:#f5f5f5;
            margin-bottom: 10px;
        }
        
        .count {
            font-weight: 700;
        }

        .open>.dropdown-menu {
            display: block;
            margin-left: -50px;
        }

        .modal-xl {
            width:90%;
        }    
    </style>
<!-- </head>

<body> -->
    <?php
        function tipo_turno($data) {

            $count_estudio = 0;
            $count_consulta = 0;
            $data = json_decode($data);

            foreach ($data as $key => $value) {
                if (stripos($value->nombre_practica,"consulta") === false)
                    $count_estudio++;
                else
                    $count_consulta++;
            }

            if ($count_estudio != 0)
                echo '<span class="label label-danger">Estudios</span><span class="label label-warning" style = "font-weight:700">'.$count_estudio.'</span><br>';
            if ($count_consulta != 0)
                echo '<span class="label label-success">Consulta</span>';
        }
    ?>
    <!-- Navigation -->
    <!-- <nav class="navbar navbar-inverse navbar-static-top"> -->

    <div class="container-fluid">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Buscar turnos...">
                    </form> 
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#"><span class = "glyphicon glyphicon-list-alt"></span> Turnos</a></li>
                        <li><a href="#"><span class = "glyphicon glyphicon-user"></span> Pacientes</a></li>
                        <li><a href="#"><span class = "glyphicon glyphicon-flag"></span> Facturación</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Opciones<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="#"><span class = "glyphicon glyphicon-lock"></span> Bloquear Agenda</a></li>
                              <li><a href="#"><span class = "glyphicon glyphicon-log-out"></span> Salir</a></li>
                              <!-- <li role="separator" class="divider"></li>
                              <li class="dropdown-header">Nav header</li> -->
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>

        <div class="row">
            <div class="col-md-9 main">
                <div class="row page-header">
                    <div class="col-md-6">
                        <?php

                            $dia_siguiente = strtotime("+1 day", strtotime($fecha));
                            $dia_anterior = strtotime("-1 day", strtotime($fecha));

                            echo '<div class="col-md-7 col-xs-7" style = "font-size:18px;margin-top:5px;text-align:center">'
                                .$day." ".$daynum.', '.$month." ".$year.
                            '</div>
                            <div class="col-md-5 col-xs-5">
                                <div class="btn-group" role="group">
                                    <a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_anterior)).'" class="btn btn-default"><span style = "margin-right:0px" class = "glyphicon glyphicon-chevron-left"></span></a>
                                    <a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d')).'" class="btn btn-default"><span style = "margin-right:0px" class = "glyphicon glyphicon-calendar"></span></a>
                                    <a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_siguiente)).'" class="btn btn-default"><span style = "margin-right:0px" class = "glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>';

                        ?>    
                    </div>    
                    <div class="col-md-6" style = "text-align:center">
                        <div class="col-md-4 col-xs-6" style = "font-size:18px;margin-top:5px;text-align:center">
                            Profesional
                        </div>    
                        <div class="col-md-8 col-xs-6">
                            <select class="form-control" id = "seleccion_medico" name="seleccion_medico">
                                <?php
                                    echo '<option value = "todos" selected>TODOS</option>';
                                    foreach ($medicos as $med) {    
                                        if ($medico_selected == $med->id_medico)
                                            if ($med->nombre == "Otro")
                                                echo '<option value ='.$med->id_medico.' selected>'.$med->nombre.'</option>';
                                            else
                                                echo '<option value ='.$med->id_medico.' selected>Dr. '.$med->nombre.'</option>';
                                        else
                                            if ($med->nombre == "Otro")
                                                echo '<option value ='.$med->id_medico.'>'.$med->nombre.'</option>';
                                            else
                                                echo '<option value ='.$med->id_medico.'>Dr. '.$med->nombre.'</option>';
                                    }
                                ?>
                            </select>
                        </div>   
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table">
                        <thead class = "cabecera_tabla">
                            <tr>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Profesional</th>
                                <th>Ficha</th>
                                <th>Detalle</th>
                                <th>Acciones</th>
                                <th style = "text-align:right">Estado</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                
                                // foreach($filas as $key => $item)
                                // {
                                //    !isset($arr[$item->hora]) ? $arr[$item->hora] = array($item) : array_push($arr[$item->hora],$item);
                                // }

                                // $array = array();
                         
                                foreach ($horario as $key => $value) {

                                    if (isset($filas[$value->hora])) {
                                        foreach ($filas[$value->hora] as $turno_key => $turno_val) {

                                            $config = $this->main_model->get_config_medico($turno_val->medico);
                                            if (empty($config))
                                                $color = "#FFD9B5";//#FFCDCD";
                                            else
                                                $color = $config->config;

                                            // $array[$turno_val->id] = $turno_val->tipo;

                                            echo '<tr style = "background-color:'.$color.'">';
                                                echo '<td>';
                                                    echo date('H:i',strtotime($turno_val->hora)).'<br>';
                                                    if ($turno_val->citado != $turno_val->hora)
                                                        echo '<strong>'.date('H:i',strtotime($turno_val->citado)).'</strong>';
                                                echo '</td>';
                                                echo '<td>'.$turno_val->apellido.', '.$turno_val->nombre.'</td>';
                                                echo '<td>'.$turno_val->medico_nombre.'</td>';
                                                echo '<td>'.$turno_val->ficha.'</td>';

                                                echo '<td>';
                                                    tipo_turno($turno_val->tipo);
                                                echo '</td>';

                                                echo '<td>';
                                                    echo '<div class="dropdown">';
                                                        echo '<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button"><i class = "glyphicon glyphicon-th-list"></i><span class="caret"></span></button>';
                                                        echo '<ul class="dropdown-menu">';
                                                          echo '<li><a href="#" onclick = "return editar_turno('.$turno_val->id.')" data-toggle="modal">Editar Turno</a></li>';
                                                          echo '<li><a href="#" onclick = "return borrar_turno('.$turno_val->id.')" data-toggle="modal">Eliminar Turno</a></li>';
                                                          echo '<li><a href="#cambiar_fecha" data-toggle="modal">Cambiar Fecha Turno</a></li>';
                                                          echo '<li><a href="#proximo_turno" data-toggle="modal">Nuevo Turno</a></li>';
                                                        echo '</ul>';
                                                    echo '</div>';
                                                echo '</td>';
                                                echo '<td style = "text-align:right">';
                                                    echo '<div class="dropdown">';
                                                        echo '<button class="btn btn-default dropdown-toggle disabled" data-toggle="dropdown" role="button"><span id = "estado_'.$turno_val->id.'" class = "glyphicon glyphicon-unchecked" style ="margin-right:0px"></span></button>';
                                                        echo '<ul class="dropdown-menu" style = "min-width:72px">';
                                                          echo '<li><a href="#" onclick = "return actualizar_estado('.$turno_val->id.',\'glyphicon glyphicon-unchecked\')" data-toggle="modal"><span class = "glyphicon glyphicon-unchecked"></span>Ausente</a></li>';
                                                          echo '<li><a href="#" onclick = "return actualizar_estado('.$turno_val->id.',\'glyphicon glyphicon-hand-right\')" data-toggle="modal"><span class = "glyphicon glyphicon-hand-right"></span>Estudios</a></li>';
                                                          echo '<li><a href="#" onclick = "return actualizar_estado('.$turno_val->id.',\'glyphicon glyphicon-thumbs-up\')" data-toggle="modal"><span class = "glyphicon glyphicon-thumbs-up"></span>Estudios OK</a></li>';
                                                          echo '<li><a href="#" onclick = "return actualizar_estado('.$turno_val->id.',\'glyphicon glyphicon-eye-open\')" data-toggle="modal"><span class = "glyphicon glyphicon-eye-open"></span>Dilatando</a></li>';
                                                          echo '<li><a href="#" onclick = "return actualizar_estado('.$turno_val->id.',\'glyphicon glyphicon-flag\')" data-toggle="modal"><span class = "glyphicon glyphicon-flag"></span>Medico</a></li>';
                                                        echo '</ul>';
                                                    echo '</div>';
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                                    }    
                                    else {
                                        $time = explode(":",$value->hora);

                                        echo '<tr style = "cursor:pointer" onclick = "return nuevo_turno(\''.$fecha.'\',\''.$time[0].'\',\''.$time[1].'\')">';
                                            echo '<td>'.date('H:i',strtotime($value->hora)).'</td>';
                                            echo '<td></td>';
                                            echo '<td></td>';
                                            echo '<td></td>';
                                            echo '<td></td>';
                                            echo '<td></td>';
                                            echo '<td></td>';
                                        echo '</tr>';
                                    }    
                                    
                                }
                            ?>
                        </tbody>
                    </table>
                </div> 
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class = "panel-heading">
                        <i class="glyphicon glyphicon-bell"></i>
                        <strong>Notas del día</strong>
                    </div>
                    <div class="panel-body">
                        <ul style = "margin-left:-25px">
                            <?php
                                if ($notas <> null) {
                                    foreach ($notas as $nota) {
                                        echo '<li style = "min-height:40px;margin-bottom:5px">';
                                            echo '<a>'.$nota->nota.'</a>';
                                            //echo anchor('main/edit_notas/'.$nota->id, $nota->nota);
                                            echo '<span class = "pull-right text-muted small" style = "width:100%"><i>'.date('d-m-Y@H:i', strtotime($nota->last_update)).' - '.$nota->usuario.'</i></span>';
                                        echo '</li>';       
                                    }
                                }
                                else {
                                    echo "<i> No hay notas para este día </i>";
                                }   
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class = "panel-heading">
                        <i class = "glyphicon glyphicon-calendar"></i>
                        <strong>Agenda</strong>
                    </div>
                    <div class="panel-body">
                        <?php
                            $algo = explode('-',$fecha);
                            $algo_anio = $algo[0];
                            $algo_mes = $algo[1];
                            echo '<iframe style = "height:295px;width:100%;border-style:none" src="'.base_url('index.php/main/show_calendar/'.$algo_anio.'/'.$algo_mes).'"></iframe>';
                        ?>
                    </div>    
                </div>

            </div>
        </div>
    </div>

    <div id="borrar_turno" class="modal fade in" role="dialog" tabindex="-1">;                                                                          
        <div class="modal-dialog" style = "width:250px">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">¿Borrar Turno?</h4>
                </div>

                <div class="modal-footer">
                    <a id = "aceptar" href="#" type="button" class="btn btn-default">Aceptar</a>
                    <button id = "cancelar" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>
  
    <script>

    

    </script>
