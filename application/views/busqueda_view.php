<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Busqueda..</title>
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>
	.ui-widget {
		font-size: 12pt;
	}
	.ui-dialog {
		position: relative;
		margin: auto;
	}

	.search_form input[type="text"] {
    	background: url(search-white.png) no-repeat 10px 6px #fcfcfc;
    	border: 1px solid #d1d1d1;
    	font: bold 40px 'Segoe';
    	width: 350px;
    	height: 50px;
    	padding: 6px 15px 6px 35px;
    	-webkit-border-radius: 15px;
    	-moz-border-radius: 15px;
    	border-radius: 15px;
    	text-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
    	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    }

	</style>
	<script>

    $(document).ready(function()
    {
        
        $(".fila_ocupada").click(function()
        { 
            var id = $(this).attr("id");
            if ($("#detalles_"+id).is(":hidden")) {
                $('[id^="detalles_"]').slideUp("slow"); 
                $("#detalles_"+id).slideDown("slow");
                
                //$("#detalles_*").;
            } 
            else {
                $("#detalles_"+id).slideUp("slow");
            }       
        });
    });


    function borrar(url,data) {
        $( "#borrar_turno" ).dialog({
            autoOpen: true,
            resizable: false,
            width: 300,
            height: 80,
            modal: true,
            buttons: {
                "Si": function() {
                    var x = url+"/borrar_turno/"+data;
                    location.href = x;
                },
                "No": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
   };

    function chequear(url,data) {
        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 800,
            height:240,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+"/cambiar_turno/"+data;
					location.href = x;
                },
				"No": function() {
                    $( this ).dialog( "close" );
				},
                Anular: function() {
					var x = url+"/anular_cambio_turno/"+data;
                    location.href = x;
                }
            }
        });
   };
		
	</script>	
</head>
<body> 
<div id="borrar_turno" title="¿Borrar turno?"></div>  
<div id = "menu">
    <div id = "dia_anterior">
        <div style = "float: left">
        <?php 
            echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d')).'">';
                echo '<img src = "'.base_url('css/images/arrow_left_24x24.png').'"/>';
            echo '</a>';
         ?>
        </div>
         <div id = "calendario_titulo" style = "font-size: 25px; float: left; font-weigth: bold; color: white; margin-left: 30px; font-family: Oswald">
            Volver a Turnos..
        </div>  
    </div>
</div>
<div id = "busqueda">
    <form class="form_busqueda" action="<?php echo base_url('index.php/main/busqueda')?>" method="post" name="search_form" id="search_form">
        <input type="text" name="busqueda_texto" id = "busqueda_texto" autocomplete="off" placeholder="Busqueda de turnos..." required/>
        <button type="submit"> Buscar </button>
    </form> 
</div>
<div id = "resultado_busqueda">
 <?php
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    if ($busqueda <> 0) {
    
        foreach ($busqueda as $fila) 
        { 
            $hora_completa = date('H:i', strtotime($fila->hora));

                echo '<div id = "titulo_superior2">';
                    
                        $ind_mes = (int) date("m", strtotime($fila->fecha));
                        $ind_dia = (int) date("w", strtotime($fila->fecha));
                        $ind_num = (int) date("d", strtotime($fila->fecha));
                        $ind_anio = (int) date("Y", strtotime($fila->fecha));

                        echo '<div style = "margin-left: 10px">'.$dias[$ind_dia].' '.$ind_num.', '.$meses[$ind_mes - 1].' '.$ind_anio.'</div>';
                    
                echo '</div>';

            echo '<div class = "fila_ocupada" id = "'.$fila->id.'" style="cursor: pointer;">';
                    echo '<div class = "fila_superior">';

                        echo '<div class = "hora_ocupada">';
                            echo '<a name="'.$hora_completa.'">'.$hora_completa.'</a>';
                        echo '</div>';

                        echo '<div class = "nombre_apellido">';     
                            echo $fila->nombre.' '.$fila->apellido;
                        echo '</div>';

                        echo '<div class = "medico">';
                            $auxi = explode(' - ', $fila->medico);
                            $med = $auxi[0];
                            if ($med == "Otro") {
                                echo $auxi[1];
                            }
                            else {
                                echo $fila->medico; 
                            }
                        echo '</div>';

                        echo '<div class = "tipo_turno">';
                            echo $fila->tipo;
                        echo '</div>';
                        
                        echo '<div class = "valor_ficha">';
                            if ($fila->ficha == -1) {       
                                echo anchor('main/nuevo_paciente', 'Nuevo Paciente');   
                            }   
                            else if ($fila->ficha == -2) {  
                                echo anchor('main/buscar_paciente', 'Buscar..');
                            }
                            else {
                                echo anchor('main/buscar_ficha/'.$fila->ficha, $fila->ficha);
                            }       
                        echo '</div>';

                        echo '<div id = "estado">';    

                        $hora = date('H', strtotime($fila->hora));
                        $minutos = date('i', strtotime($fila->hora));
                        $fecha = $ind_anio.'-'.$ind_mes.'-'.$ind_num; 
                        $data = $fecha.'/'.$hora.'/'.$minutos;

                        if ($fila->estado == "")
                        { 
                                echo '<img src = "'.base_url('css/images/check_16x13.png').'"/>'; 
                        }
                        else    
                        {  
                                echo '<img src = "'.base_url('css/images/check_alt_24x24.png').'"/>'; 
                        }       
                        echo '</div>';

                    echo '</div>';
                    
                echo '</div>';
                echo '<div id = "detalles_'.$fila->id.'" class="detalles" style = "display:none;">';
                    echo '<div id = "detalle_tel1">';
                        echo "<b>Teléfono :</b>  ".$fila->tel1;
                    echo '</div>';
                    echo '<div id = "detalle_tel2">';
                        if ($fila->tel2 <> "") {
                            echo "<b>Teléfono 2 :</b>  ".$fila->tel2; 
                        }                   
                    echo '</div>';
                    echo '<div id = "detalle_nota">';
                        if ($fila->notas == "") {
                            echo "<b>Notas :  </b> <i>No hay notas para mostrar</i>"; 
                        }
                        else {
                            echo "<b>Notas: </b>".$fila->notas;
                        }
                    echo '</div>';
                    echo '<div id = "botones">';
                        echo '<a href="'.base_url('index.php/main/editar_turno/'.$fila->id).'">';
                            echo '<img src = "'.base_url('css/images/pencil_icon&16.png').'"/>';  
                        echo '</a>';
                        echo '<a style="cursor: pointer;" onclick = "return borrar(\''.base_url("/index.php/main/").'\', \''.$fila->id.'\');">'; 
                            echo '<img src = "'.base_url('css/images/delete_icon&16.png').'"/>';  
                        echo '</a>';
                        echo '<a href="'.base_url('index.php/main/show_calendar/'.$ind_anio.'/'.$ind_mes.'/'.$fila->id).'">';
                            echo '<img src = "'.base_url('css/images/refresh_icon&16.png').'"/>';  
                        echo '</a>';
                    echo '</div>';  
                echo '</div>';
            }
    }           
    else 
    {
    ?>    
    <div style = "font-size: 30px; text-align: center; margin-top: 100px">
        <?php echo "<i>No hay coincidencias..</i>"; ?>
    </div>    
    <?php 
}
?>
</div>
</body>
</html>
