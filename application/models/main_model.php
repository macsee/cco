<?php

class Main_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	
	function turnos_del_dia($dia, $medico)
	{
		if ($medico == null)
			$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$dia' ORDER BY hora");
		else
			$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$dia' AND medico = '$medico' ORDER BY hora");

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}
	
	
	function get_horarios()
	{
		$query = $this->db->query("SELECT * FROM horarios");
		
		foreach ($query->result() as $fila)
		{
			$data[] = $fila;
		}
		return $data;
	}
	
	function get_ficha($nombre, $apellido)
	{
		//$text = '"SELECT nroficha FROM pacientes WHERE nombre = "'.$nombre.'" AND apellido = "'.$apellido.'"';
		$query = $this->db->query("SELECT nroficha FROM pacientes WHERE nombre = '$nombre' AND apellido = '$apellido'");
		
		if ($query->num_rows()>1)
		{
			return -2; //Busqueda manual
		}
		else if ($query->num_rows() == 1)
		{
			$row = 	$query->row();
			return $row->nroficha;

		}
		else if ($query->num_rows() == 0)
		{
			$query = $this->db->query("SELECT nroficha FROM pacientes WHERE apellido LIKE '%".$apellido."%'");

			if ($query->num_rows()>0) {
				return -2; //Busqueda manual
			}
			else {
				return -1; //Nuevo Paciente
			}	
		}
	}
	
	function get_id_paciente($nombre, $apellido, $nroficha) {
			$query = $this->db->query("SELECT id FROM pacientes WHERE nroficha = '$nroficha' AND nombre = '$nombre' AND apellido = '$apellido'");
			
			if ($query->num_rows()>1)
			{
				return -2; //Busqueda manual
			}
			else if ($query->num_rows() == 1)
			{
				$row = $query->row();
				return $row->id;
			}
			else if ($query->num_rows() == 0)
			{
				return -1; //Nuevo Paciente
			}	
	} 
	
	function get_turnos($dia,$medico)
	{
		$turnos = $this->turnos_del_dia($dia ,$medico);
		
		if ($turnos <> 0)
		{
			foreach ($turnos as $turno)
			{	
				if ( $turno->ficha == 0) {
					$ficha = $this->get_ficha($turno->nombre, $turno->apellido);
					$id_paciente = $this->get_id_paciente($turno->nombre, $turno->apellido, $ficha);
					$this->db->query("UPDATE turnos SET ficha = '$ficha', id_paciente = '$id_paciente' WHERE id = '$turno->id'");
				}								
			}
			return $this->turnos_del_dia($dia, $medico);
		}
		else
		{
			return 0;
		}
		
	}
	
	
	function get_obras()
	{
		$query = $this->db->query("SELECT * FROM obras_sociales");
		
		foreach ($query->result() as $resultado)
		{
			$data[] = $resultado;
		}
		return $data;
	}
	
	
	function get_medicos()
	{
		$query = $this->db->query("SELECT * FROM medicos ORDER BY id");
		
		foreach ($query->result() as $resultado)
		{
			$data[] = $resultado;
		}
		return $data;
	}

	function get_medico_by_id($id) {
		$query = $this->db->query("SELECT nombre FROM medicos WHERE id = '$id'");
		if ($query->num_rows > 0 )
			return $query->row()->nombre;
		else
			return NULL;
	}
	
	function guardar_turno($array)
	{	
		
		$data['tel1'] = $array['tel1_1'].'-'.$array['tel1_2'];
		
		if ($array['tel2_1'] == "") 
		{
			$data['tel2'] = "";   	
		}
		else 
		{
			$data['tel2'] = $array['tel2_1'].'-'.$array['tel2_2'];
		}
		$cadena = "";
		$tipo = $array['tipo'];
		for ($i=0; $i < sizeof($tipo); $i++) {
			$cadena = $tipo[$i].','.' '.$cadena;
		}
		$cadena = substr($cadena, 0, -2);


		$nombre_1 = ucwords($array['nombre']);
		$nombre_1 = ucwords(strtolower($nombre_1));

		$apellido_1 = ucwords($array['apellido']);
		$apellido_1 = ucwords(strtolower($apellido_1));

		$data['nombre'] = $nombre_1;
		$data['apellido'] = $apellido_1;
		$data['obra_social'] = $array['obra'];
		$data['fecha'] = $array['fecha'];
		$data['hora'] = $array['hora'].':'.$array['minutos'];
		$data['citado'] = $array['hora_citado'].':'.$array['minutos_citado'];
		$data['tipo'] = $cadena;
		//if ($data['ficha'] == "") {
		if ($array['ficha'] == "") {
			$data['ficha'] = 0;
		}
		else {
			$data['ficha'] = $array['ficha'];
			$data['id_paciente'] = $array['id_paciente'];
			//$data['id_paciente'] = $array['id'];	
		}		
				
		if ( ($array['medico'] == "Otro") & ($array['otro'] <> "")) {

			$medico_1 = ucwords($array['otro']);
			$medico_1 = ucwords(strtolower($medico_1));

			if ( strpos($medico_1, 'Dr.') === false ) {
				$medico_1 = 'Dr. '.$medico_1;
			}		

			$data['medico'] = $array['medico'].' - '.$medico_1;
		}
		else {
			$data['medico'] = $array['medico'];
		}
		$data['notas'] = $array['notas'];
		$data['usuario'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');
		$str = $this->db->insert_string('turnos', $data);
		$this->db->query($str);
	}
	
	function guardar_notas($array)
	{
		$data['fecha'] = $array['fecha'];
		$data['nota'] = $array['notas'];
		$data['usuario'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');
		$str = $this->db->insert_string('notas', $data);
		$this->db->query($str);
	}

	function get_notas($dia)
	{
		$query = $this->db->query("SELECT * FROM notas WHERE fecha = '$dia'");
			if ($query->num_rows()>0)
			{
				foreach ($query->result() as $fila)
				{
					$data[] = $fila;
				}
				return $data;
			}
			else
			{
				return 0;
			}
	}
	
	function get_notas_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM notas WHERE id = '$id'");
			if ($query->num_rows()>0)
			{
				foreach ($query->result() as $fila)
				{
					$data[] = $fila;
				}
				return $data;
			}
			else
			{
				return 0;
			}
	}
	
	function actualizar_notas($array)
	{
		$data['nota'] = $array['notas'];
		$data['usuario'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');
		$where = "id = '".$array['id']."'";
		$str = $this->db->update_string('notas', $data, $where);
		$this->db->query($str);
	}
	
	function eliminar_nota($id)
	{
		$this->db->delete('notas', array('id' => $id)); 
	}

	function set_ficha($nombre, $apellido, $valor) {
		$this->db->query("UPDATE turnos SET ficha = '$valor' WHERE nombre = '$nombre' AND apellido = '$apellido'");
	}

	function actualizar_turno($array)
	{
		$data['tel1'] = $array['tel1_1'].'-'.$array['tel1_2'];
		
		if ($array['tel2_1'] == "") 
		{
			$data['tel2'] = "";   	
		}
		else 
		{
			$data['tel2'] = $array['tel2_1'].'-'.$array['tel2_2'];
		}
		$cadena = "";
		$tipo = $array['tipo'];
		for ($i=0; $i < sizeof($tipo); $i++) {
			$cadena = $tipo[$i].','.' '.$cadena;
		}
		$cadena = substr($cadena, 0, -2);
			
		$nombre_1 = ucwords($array['nombre']);
		$nombre_1 = ucwords(strtolower($nombre_1));

		$apellido_1 = ucwords($array['apellido']);
		$apellido_1 = ucwords(strtolower($apellido_1));

		$data['nombre'] = $nombre_1;
		$data['apellido'] = $apellido_1;
		$data['obra_social'] = $array['obra'];
		$data['fecha'] = $array['fecha'];
		$data['hora'] = $array['hora'];
		$data['citado'] = $array['hora_citado'].':'.$array['minutos_citado'];
		$data['tipo'] = $cadena;
		$data['ficha'] = 0;
		
		if ( ($array['medico'] == "Otro") & ($array['otro'] <> "")) {
			$medico_1 = ucwords($array['otro']);
			$medico_1 = ucwords(strtolower($medico_1));

			if ( strpos($medico_1, 'Dr.') === false ) {
				$medico_1 = 'Dr. '.$medico_1;
			}		

			$data['medico'] = $array['medico'].' - '.$medico_1;
		}
		else {
			$data['medico'] = $array['medico'];
		}
		
		$data['notas'] = $array['notas'];
		$data['usuario'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');
		$where = "id = '".$array['id']."'";
		$str = $this->db->update_string('turnos', $data, $where);
		$this->db->query($str);
	}

	function get_turno_by($id) 
	{
		$query = $this->db->query("SELECT * FROM turnos WHERE id = '$id'");
		
		foreach ($query->result() as $resultado)
		{
			$data[] = $resultado;
		}
		return $data;
	}

	function delete_turno($id)
	{
		$this->db->delete('turnos', array('id' => $id)); 
	}

	function cambiar_estado($var, $id)
	{
		$where = "id = '".$id."'";
		
		if ($var == 0)
		{	
			$data['estado'] = "";
			
		}
		else
		{
			$data['estado'] = "presente";
		}
		
		$str = $this->db->update_string('turnos', $data, $where);
		$this->db->query($str);
	}

	function turnos_del_mes($mes, $ano) 
	{
		$query = $this->db->query("SELECT fecha FROM turnos WHERE MONTH(fecha) = '$mes' AND YEAR(fecha) = '$ano'");

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}

	function cantidad_turnos_man($fecha) 
	{
		$medico_seleccionado = $this->session->userdata('medico_seleccionado');

		if ($medico_seleccionado == 0)
			$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND hora <= '14:00:00' ORDER BY hora");
		else {
			$medico = $this->main_model->get_medico_by_id($medico_seleccionado);
			$query = $this->db->query("SELECT * FROM turnos WHERE medico = '$medico' AND fecha = '$fecha' AND hora <= '14:00:00' ORDER BY hora");
		}	
		return $query->num_rows();
	}

	function cantidad_turnos_tarde($fecha) 
	{
		$medico_seleccionado = $this->session->userdata('medico_seleccionado');

		if ($medico_seleccionado == 0)
			$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND hora > '14:00:00' ORDER BY hora");	
		else {
			$medico = $this->main_model->get_medico_by_id($medico_seleccionado);
			$query = $this->db->query("SELECT * FROM turnos WHERE medico = '$medico' AND fecha = '$fecha' AND hora > '14:00:00' ORDER BY hora");
		}
		return $query->num_rows();
	}

	function cambiar_turno($array)
	{
		$data['fecha'] = $array['fecha'];
		$data['hora'] = $array['hora'];
		$data['citado'] = $array['hora'];
		$where = "id = '".$array['id']."'";
		$this->setear('nombre',"");
		$this->setear('apellido',"");
		$this->setear('id',"");
		$str = $this->db->update_string('turnos', $data, $where);
		$this->db->query($str);
	}

	function anular_cambio()
	{
		$this->setear('id',"");
		$this->setear('nombre',"");
		$this->setear('apellido',"");
		$this->setear('nuevo_turno',"");
	}
	
	function setear($var, $valor)
	{
		$this->db->query("UPDATE variables SET valor = '$valor' WHERE nombre = '$var'");
	}
	
	function obtener($var)
	{
		$query = $this->db->query("SELECT valor FROM variables WHERE nombre = '$var'");	

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				return $fila->valor;
			}
		}
		else
		{
			return 0;
		}
	}

	function buscar($text) 
	{
		$query = $this->db->query("SELECT * FROM turnos WHERE apellido LIKE '".$text."%' ORDER BY fecha DESC");

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	
	}

	
	function check_ficha ($ficha) {

		$query = $this->db->query("SELECT nombre, apellido, nroficha FROM pacientes WHERE nroficha LIKE '$ficha'");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	

	}

	function check_nombre_apellido ($nombre, $apellido) {

		$query = $this->db->query("SELECT nombre, apellido, nroficha FROM pacientes WHERE nombre LIKE '$nombre' AND apellido LIKE '$apellido'");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	

	}

	function delete_paciente($id)
	{
		$this->db->delete('pacientes', array('id' => $id)); 
	}

	function ingresar_paciente($array) {
	
		if ($array['tel1_2'] == "") 
		{
			$data['tel1'] = "";   	
		}
		else 
		{

			$data['tel1'] = $array['tel1_1'].'-'.$array['tel1_2'];
		}
		
		if ($array['tel2_1'] == "") 
		{
			$data['tel2'] = "";   	
		}
		else 
		{
			$data['tel2'] = $array['tel2_1'].'-'.$array['tel2_2'];
		}
		
		$nombre_1 = ucwords($array['nombre']);
		$nombre_1 = ucwords(strtolower($nombre_1));
		$data['nombre'] = $nombre_1;

		$apellido_1 = ucwords($array['apellido']);
		$apellido_1 = ucwords(strtolower($apellido_1));
		$data['apellido'] = $apellido_1;

		$data['dni'] = $array['dni'];

		$localidad_1 = ucwords($array['localidad']);
		$localidad_1 = ucwords(strtolower($localidad_1));
		$data['localidad'] = $localidad_1;

		$direccion_1 = ucwords($array['direccion']);
		$direccion_1 = ucwords(strtolower($direccion_1));
		$data['direccion'] = $direccion_1;

		$data['fecha_ingreso'] = date('Y-m-d');
		$data['fecha_nacimiento'] = $array['fecha'];
		
		$data['nroficha'] = $array['ficha'];
		$data['obra_social'] = $array['obra'];
		$data['nro_obra'] = $array['nro_afiliado'];
		
		$data['observaciones'] = $array['obs'];
		$this->set_ficha($data['nombre'], $data['apellido'], $data['nroficha']);
		$str = $this->db->insert_string('pacientes', $data);
		$this->db->query($str);
	}

	function facturar($array)
	{

		$data['obra_social'] = $array['obra'];
		$data['fecha'] = $array['fecha'];
		$data['medico'] = $array['medico'];
		$data['id_turno'] = $array['id'];
		$tipo = $array['tipo'];

		for ($i=0; $i < sizeof($tipo); $i++) 
		{
			switch($tipo[$i])
			{
		        case "CVC":  $data['cvc'] = 1;  break;
		        case "TOPO":  $data['topo'] = 1;  break;
		        case "IOL":  $data['iol'] = 1;  break;
		        case "ME":  $data['me'] = 1;  break;
		        case "RFG":  $data['rfg'] = 1;  break;
		        case "RFG-Color":  $data['rfg-color'] = 1;  break;
		        case "OCT":  $data['oct'] = 1;  break;
		        case "PAQUI":  $data['paqui'] = 1;  break;
		        case "OBI":  $data['obi'] = 1;  break;
		        case "YAG":  $data['yag'] = 1;  break;
		        case "LASER":  $data['laser'] = 1;  break;
		        case "CONSULTA":  $data['consulta'] = 1;  break;
				case "HRT":  $data['hrt'] = 1;  break;
			}

		}
				
		$str = $this->db->insert_string('facturacion', $data);
		$this->db->query($str);
	}


	function obtener_ultima_ficha() {

		$query = $this->db->query("SELECT nroficha FROM pacientes ORDER by nroficha DESC");
		$resultado = $query->result();
		return $resultado[0];
	}

	function buscar_paciente($apellido) {

		if ($apellido == "") {

			return 0;
		}
		else {

			$query = $this->db->query("SELECT * FROM pacientes WHERE apellido LIKE '%".$apellido."%'");
		}	

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	

	}


	function asignar_ficha($id_turno, $ficha, $id_paciente, $mynombre, $myapellido) {

		$nombre = urldecode($mynombre);
		$nombre = ucwords($nombre);
		$nombre = ucwords(strtolower($nombre));
		
		$apellido = urldecode($myapellido);
		$apellido = ucwords($apellido);
		$apellido = ucwords(strtolower($apellido));
			

		$data['ficha'] = $ficha;
		$data['nombre'] = $nombre;
		$data['apellido'] = $apellido;
		$data['id_paciente'] = $id_paciente;

		$where = "id = '".$id_turno."'";
		$str = $this->db->update_string('turnos', $data, $where);
		$this->db->query($str);
	}

	function obtener_fecha_turno($id_turno) {
		$query = $this->db->query("SELECT fecha FROM turnos WHERE id LIKE '$id_turno'");
		$resultado = $query->result();
		return $resultado[0];
	}

	function buscar_id_paciente($id) {

		$query = $this->db->query("SELECT * FROM pacientes WHERE id LIKE '$id'");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	

	}

	function actualizar_paciente($array) {

		if ($array['tel1_2'] == "") 
		{
			$data['tel1'] = "";   	
		}
		else 
		{

			$data['tel1'] = $array['tel1_1'].'-'.$array['tel1_2'];
		}
		
		if ($array['tel2_1'] == "") 
		{
			$data['tel2'] = "";   	
		}
		else 
		{
			$data['tel2'] = $array['tel2_1'].'-'.$array['tel2_2'];
		}
		
		$nombre_1 = ucwords($array['nombre']);
		$nombre_1 = ucwords(strtolower($nombre_1));
		$data['nombre'] = $nombre_1;

		$apellido_1 = ucwords($array['apellido']);
		$apellido_1 = ucwords(strtolower($apellido_1));
		$data['apellido'] = $apellido_1;

		$data['dni'] = $array['dni'];


		$localidad_1 = ucwords($array['localidad']);
		$localidad_1 = ucwords(strtolower($localidad_1));
		$data['localidad'] = $localidad_1;

		$direccion_1 = ucwords($array['direccion']);
		$direccion_1 = ucwords(strtolower($direccion_1));
		$data['direccion'] = $direccion_1;

		$data['fecha_nacimiento'] = $array['fecha'];
		
		$data['nroficha'] = $array['ficha'];
		$data['obra_social'] = $array['obra'];
		$data['nro_obra'] = $array['nro_afiliado'];
		
		$data['observaciones'] = $array['obs'];
	
		$where = "id = '".$array['id_paciente']."'";
		$str = $this->db->update_string('pacientes', $data, $where);
		$this->db->query($str);
	}


	function get_fechas_estudios($id) {

		$query = $this->db->query("SELECT * FROM estudios where id_paciente = $id ORDER BY imagen");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	

	}

	function existe_estudio($id, $imagen) {

		$query = $this->db->query("SELECT * FROM estudios where id_paciente = $id AND imagen = '$imagen'");
		
		if ($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}	

	}

	function ingresar_estudios($data) {

		$str = $this->db->insert_string('estudios', $data);
		$this->db->query($str);

	} 

	function get_agendas() 
	{
		$query = $this->db->query("SELECT * FROM agendas");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	

	}

	function crear_agenda($data) {

		$str = $this->db->insert_string('agendas', $data);
		$this->db->query($str);
	}

	function ver_agenda($fecha, $tipo) {

		$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND tipo LIKE '%".$tipo."%'");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	

	}

	function create_calendar($ano = null, $mes = null)
	{
		$algo = $this->uri->segment(4);
		$conf = array (
			'show_next_prev' => true,
			'next_prev_url' => base_url().'index.php/main/show_calendar'
		);
		
		$conf['template'] = '

   		{table_open}<table border="0" cellpadding="0" cellspacing="0" class = "calendar">{/table_open}

   		{heading_row_start}<tr class = "cabecera">{/heading_row_start}

   		{heading_previous_cell}<th class = "previous"><a href="{previous_url}"><img src = "'.base_url().'css/images/arrow_left_16x16.png"/></a></th>{/heading_previous_cell}
   		{heading_title_cell}<th  colspan="{colspan}">{heading}</th>{/heading_title_cell}
   		{heading_next_cell}<th class = "next"><a href="{next_url}"><img src = "'.base_url().'css/images/arrow_right_16x16.png"/></a></th>{/heading_next_cell}

		{heading_row_end}</tr>{/heading_row_end}

 		{week_row_start}<tr class = "semana">{/week_row_start}
   		{week_day_cell}<td class = "dia_semana">{week_day}</td>{/week_day_cell}
   		{week_row_end}</tr>{/week_row_end}

   		{cal_row_start}<tr class ="days">{/cal_row_start}
   		{cal_cell_start}<td>{/cal_cell_start}

   		{cal_cell_content}{content}{/cal_cell_content}
   		{cal_cell_content_today}<div class="highlight">{content}</div>{/cal_cell_content_today}

   		{cal_cell_no_content}<a href="{day}">{day}</a>{/cal_cell_no_content}
   		{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

		{cal_cell_blank}&nbsp;{/cal_cell_blank}

	   	{cal_cell_end}</div></td>{/cal_cell_end}
   		{cal_row_end}</tr>{/cal_row_end}

   		{table_close}</table>{/table_close}';

   		if ($mes == null) { $mes = date('m');}

   		if ($ano == null) { $ano = date('Y');}

   		$id = $this->obtener('id');  		

   		$mesano = $ano.'-'.$mes;

   		for ($dia=1; $dia <= 31; $dia++) 
   		{

   			$fecha = $mesano.'-'.$dia;
   			$cant_turnos_manana = $this->cantidad_turnos_man($fecha);
   			$cant_turnos_tarde = $this->cantidad_turnos_tarde($fecha);
   			$doble_jornada = 0;	

   			if ( date("l", strtotime($fecha)) == "Tuesday" )
   			{
   				$doble_jornada = 1;	
   			}
   			
   			//if ($doble_jornada == 1)
   			//{

   				if ( (($cant_turnos_manana > 0) & ($cant_turnos_manana < 7)) | (($cant_turnos_tarde > 0) & ($cant_turnos_tarde < 7)) )
   				{
   					$cal_data[$dia] = '<div class = "celda vacia" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				if ( ( ($cant_turnos_manana > 6) & ($cant_turnos_manana < 12) ) | ( ($cant_turnos_tarde > 6) & ($cant_turnos_tarde < 12) ) )
   				{
   					$cal_data[$dia] = '<div class = "celda media" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				if ( ($cant_turnos_manana > 11) | ($cant_turnos_tarde > 11) )
   				{
   					$cal_data[$dia] = '<div class = "celda llena" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				if ( ($cant_turnos_manana == 0) & ($cant_turnos_tarde == 0) )
   				{
   					$cal_data[$dia] = '<div class = "celda" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   			//}
   		/*	else
   			{
   				if ( ($cant_turnos_manana > 0) & ($cant_turnos_manana < 6) )
   				{
   					
   					$cal_data[$dia] = '<div class = "celda vacia" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana > 5) & ($cant_turnos_manana < 9) )
   				{
   					$cal_data[$dia] = '<div class = "celda media" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana > 8) )
   				{
   					$cal_data[$dia] = '<div class = "celda llena" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana == 0) )
   				{
   					$cal_data[$dia] = '<div class = "celda" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}

   			}	
		*/   		
   		}
			$this->load->library('calendar', $conf);
		
			return $this->calendar->generate($ano, $mes, $cal_data);
	}

	function setSelectedMedico($medico) {
		if ($medico == 'TODOS')
			$this->db->query("UPDATE variables SET valor = NULL WHERE nombre = 'medico_seleccionado'");
		else	
			$this->db->query("UPDATE variables SET valor = '$medico' WHERE nombre = 'medico_seleccionado'");
	}

	function  getSelectedMedico() {

		 $query = $this->db->query("SELECT valor FROM variables WHERE nombre = 'medico_seleccionado'");
		 return $query->row();
	}

	function get_config_medico($medico) {
		$query = $this->db->query("SELECT config FROM medicos WHERE nombre = '$medico'");
		 return $query->row();
	}

	function get_historia($id) {

		$query = $this->db->query("SELECT * FROM historia_clinica WHERE id_paciente = '$id' ORDER BY last_update DESC");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}

	function get_antecedentes($id) {

		$query = $this->db->query("SELECT * FROM antecedentes WHERE id_paciente = '$id' ORDER BY last_update DESC");
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}

	function  get_borrador($id, $tipo) {

		 $query = $this->db->query("SELECT * FROM borradores WHERE id_paciente = '$id' and tipo = '$tipo'");
		 return $query->row();
		 //if ( $query->num_rows() >0 )
		 //else
		 //	return (object) ["text" => ""];
	}

	function insert_registro($data) {

		$str = $this->db->insert_string('historia_clinica', $data);
		$this->db->query($str);
	}

	function insert_antecedente($data) {

		$str = $this->db->insert_string('antecedentes', $data);
		$this->db->query($str);
	}

	function save_borrador($data) {

		$id_paciente = $data['id_paciente'];
		$tipo = $data['tipo'];

		if (sizeof($this->get_borrador($id_paciente,$tipo)) == 0) {

			$str = $this->db->insert_string('borradores', $data);
			$this->db->query($str);
		}
		else {	
			$data = array('text' => $data['text']);
			$where = "id_paciente = '$id_paciente' and tipo = '$tipo'";
			$str = $this->db->update_string('borradores', $data, $where);
			$this->db->query($str);
		}
	}

	function delete_borrador($data) {
		$id = $data['id_paciente'];
		$tipo = $data['tipo'];
		$this->db->query("DELETE FROM borradores WHERE id_paciente = '$id' and tipo = '$tipo'");
	}

}

?>