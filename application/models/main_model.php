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
		else if ($medico == "Otro")
			$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$dia' AND medico LIKE '%Otro%' ORDER BY hora");
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
		$objetoFicha = new stdClass;

		//$text = '"SELECT nroficha FROM pacientes WHERE nombre = "'.$nombre.'" AND apellido = "'.$apellido.'"';
		$query = $this->db->query("SELECT nroficha, id FROM pacientes WHERE nombre = '$nombre' AND apellido = '$apellido'");
		
		if ($query->num_rows()>1)
		{	
			$objetoFicha->nroficha = -2;
			$objetoFicha->id_paciente = -2;
			//return $objetoFicha; //Busqueda manual
		}
		else if ($query->num_rows() == 1)
		{
			//$row = 	$query->row();
			//return $row->nroficha;
			$objetoFicha->nroficha = $query->row()->nroficha;
			$objetoFicha->id_paciente = $query->row()->id;
			//return $objetoFicha;
			//return $query->row();

		}
		else if ($query->num_rows() == 0)
		{
			$query = $this->db->query("SELECT nroficha, id FROM pacientes WHERE apellido LIKE '%".$apellido."%'");

			if ($query->num_rows()>0) {
				$objetoFicha->nroficha = -2;
				$objetoFicha->id_paciente = -2;
				//return $objetoFicha; //Busqueda manual
			}
			else {
				$objetoFicha->nroficha = -1;
				$objetoFicha->id_paciente = -1;
				//return $objetoFicha; //Nuevo Paciente
			}	
		}

		return $objetoFicha;

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
	/*
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
	*/
	function get_localidades() {
		$query = $this->db->query("SELECT * FROM localidades ORDER by id ASC");
		
		foreach ($query->result() as $resultado)
		{
			$data[] = $resultado;
		}
		return $data;	
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
		$query = $this->db->query("SELECT nombre FROM medicos WHERE id_medico = '$id'");
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
			$result = $this->get_ficha($data['nombre'], $data['apellido']);
			$data['ficha'] = $result->nroficha;
			$data['id_paciente'] = $result->id_paciente;
		}
		else {
			$data['ficha'] = $array['ficha'];
			$data['id_paciente'] = $array['id_paciente'];
			//$data['id_paciente'] = $array['id'];	
		}		
				
		if ( ($array['medico'] == "Otro") & ($array['otro'] <> "")) {

			$medico_1 = ucwords($array['otro']);
			$medico_1 = ucwords(strtolower($medico_1));

			//if ( strpos($medico_1, 'Dr.') === false ) {
			//	$medico_1 = 'Dr. '.$medico_1;
			//}		

			$data['medico'] = $array['medico'].' - '.$medico_1;
		}
		else {
			$data['medico'] = $array['medico'];
		}

		if (!isset($array['sel_estado']))
			$data['estado'] = "";
		else
			$data['estado'] = $array['sel_estado'];
				
		$data['notas'] = $array['notas'];
		$data['usuario'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');
		$str = $this->db->insert_string('turnos', $data);
		$this->db->query($str);

		return $this->obtener_ultimo_idturno();
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

		$data['ficha'] = $this->get_ficha($nombre_1, $apellido_1)->nroficha;
		$data['id_paciente'] = $this->get_ficha($nombre_1, $apellido_1)->id_paciente;

			

		if ( ($array['medico'] == "Otro") & ($array['otro'] <> "")) {
			$medico_1 = ucwords($array['otro']);
			$medico_1 = ucwords(strtolower($medico_1));

			//if ( strpos($medico_1, 'Dr.') === false ) {
			//	$medico_1 = 'Dr. '.$medico_1;
			//}		

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

		$this->db->delete('facturacion', array('id_turno' => $array['id']));
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
		$this->db->delete('facturacion', array('id_turno' => $id));
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

	function cantidad_turnos_man($fecha,$medico_seleccionado) 
	{
		//$medico_seleccionado = $this->session->userdata('medico_seleccionado');
		$medico = $this->main_model->get_medico_by_id($medico_seleccionado);

		if ($medico == null)
			$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND hora <= '14:00:00' ORDER BY hora");
		else {
			//$medico = $this->main_model->get_medico_by_id($medico_seleccionado);
			$query = $this->db->query("SELECT * FROM turnos WHERE medico = '$medico' AND fecha = '$fecha' AND hora <= '14:00:00' ORDER BY hora");
		}	
		return $query->num_rows();
	}

	function cantidad_turnos_tarde($fecha, $medico_seleccionado) 
	{
		//$medico_seleccionado = $this->session->userdata('medico_seleccionado');
		$medico = $this->main_model->get_medico_by_id($medico_seleccionado);

		if ($medico == null)
			$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND hora > '14:00:00' ORDER BY hora");	
		else {
			//$medico = $this->main_model->get_medico_by_id($medico_seleccionado);
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

		return $this->obtener_ultimo_idpaciente();
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

	function obtener_ultimo_idturno() {

		$query = $this->db->query("SELECT id FROM turnos ORDER by id DESC LIMIT 1");
		return $query->row();
		//$resultado = $query->result();
		//return $resultado[0];
	}

	function obtener_ultimo_idpaciente() {

		$query = $this->db->query("SELECT id, nroficha FROM pacientes ORDER by id DESC LIMIT 1");
		return $query->row();
		//$resultado = $query->result();
		//return $resultado[0];
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


	function asignar_ficha($id_turno, $ficha, $id_paciente) {

		$data['ficha'] = $ficha;
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

		$query = $this->db->query("SELECT * FROM estudios where id_paciente = $id ORDER BY tipo");
		
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

	function get_estudio($id) {

		$query = $this->db->query("SELECT ruta FROM estudios where id = $id");
		return $query->row();

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

	function borrar_estudio($id){
		$this->db->query("DELETE FROM estudios WHERE id = '$id'");	
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

   			$medico_seleccionado = $this->session->userdata('medico_seleccionado');

   			$cant_turnos_manana = $this->cantidad_turnos_man($fecha, $medico_seleccionado);
   			$cant_turnos_tarde = $this->cantidad_turnos_tarde($fecha, $medico_seleccionado);
   			$doble_jornada = 0;

   			$medico_seleccionado = $this->session->userdata('medico_seleccionado');

   			if ( date("l", strtotime($fecha)) == "Tuesday" )
   			{
   				$doble_jornada = 1;	
   			}
   			
   			//if ($doble_jornada == 1)
   			//{
   				if ($this->is_bloqueado($fecha,$medico_seleccionado) != null)
   					$cal_data[$dia] = '<div class = "celda bloqueada" onclick = "parent.location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				else {

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

/*
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
*/
	function get_config_medico($medico) {
		$query = $this->db->query("SELECT config FROM medicos WHERE nombre = '$medico'");
		 return $query->row();
	}

	function get_historia($id) {

		$key = $this->config->item('encryption_key');
		$query = $this->db->query("SELECT 
									CONVERT(AES_DECRYPT(data, '$key') USING 'utf8') data,
									CONVERT(AES_DECRYPT(medico, '$key') USING 'utf8')  medico,
									CONVERT(AES_DECRYPT(fecha, '$key') USING 'utf8') fecha					
									FROM historia_clinica WHERE AES_DECRYPT(id_paciente, '$key') = '$id' ORDER BY last_update DESC");

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

		//$query = $this->db->query("SELECT * FROM antecedentes WHERE id_paciente = '$id' ORDER BY last_update DESC");

		$key = $this->config->item('encryption_key');
		$query = $this->db->query("SELECT 
									CONVERT(AES_DECRYPT(data, '$key') USING 'utf8') data,
									CONVERT(AES_DECRYPT(medico, '$key') USING 'utf8')  medico,
									CONVERT(AES_DECRYPT(fecha, '$key') USING 'utf8') fecha					
									FROM antecedentes WHERE AES_DECRYPT(id_paciente, '$key') = '$id' ORDER BY last_update DESC");
		
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

		$key = $this->config->item('encryption_key');
		$query = $this->db->query("SELECT 
									CONVERT(AES_DECRYPT(data, '$key') USING 'utf8') data					
									FROM borradores WHERE AES_DECRYPT(id_paciente, '$key') = '$id'
									AND AES_DECRYPT(tipo, '$key') = '$tipo'");

		return $query->row();
	}

	function insert_record($data) {

		$key = $this->config->item('encryption_key');
		$texto = $data['text'];
		$medico = $data['medico'];
		$fecha = $data['fecha'];
		$id = $data['id_paciente'];

		if ($data['tipo'] == "registro")
			$tabla = "historia_clinica";
		else
			$tabla = "antecedentes";

			$this->db->query("INSERT INTO ".$tabla." (id_paciente,data,medico,fecha) VALUES (
								AES_ENCRYPT('$id','$key'),
								AES_ENCRYPT('$texto','$key'),
								AES_ENCRYPT('$medico','$key'),
								AES_ENCRYPT('$fecha','$key')
							)");
		//SELECT CAST(AES_DECRYPT(data_mc, '$key') AS CHAR(50)) data_mc_decrypt FROM historia_clinica WHERE AES_DECRYPT(data_mc, '$key') LIKE '%Hola%'
	}

	function save_borrador($data) {

		$key = $this->config->item('encryption_key');
		$id = $data['id_paciente'];
		$tipo = $data['tipo'];
		$texto = $data['text'];

		if (sizeof($this->get_borrador($id,$tipo)) == 0) {

			$str = "INSERT INTO borradores (id_paciente,data,tipo) VALUES (
								AES_ENCRYPT('$id','$key'),
								AES_ENCRYPT('$texto','$key'),
								AES_ENCRYPT('$tipo','$key')
							)";
		}
		else {

			$str = "UPDATE borradores SET data = AES_ENCRYPT('$texto','$key')
									WHERE AES_DECRYPT(id_paciente, '$key') = '$id' 
									AND AES_DECRYPT(tipo, '$key') = '$tipo'";
		}

		$this->db->query($str);
	}

	function delete_borrador($data) {

		$key = $this->config->item('encryption_key');
		$id = $data['id_paciente'];
		$tipo = $data['tipo'];
		$this->db->query("DELETE FROM borradores WHERE AES_DECRYPT(id_paciente, '$key') = '$id' AND AES_DECRYPT(tipo, '$key') = '$tipo'");
	}

	function get_pacientes_admitidos($fecha, $medico_seleccionado) {

		$tipo_user = $this->session->userdata('funciones');

		if (strpos($tipo_user, "Estudios") !== false )
			$estado = "(estado = 'estudios' OR estado = 'estudios_ok')";
		else if (strpos($tipo_user, "Medico") !== false )
			$estado = "estado != ''";

			/*$tipo = " AND (	tipo LIKE '%CVC%' or 
							tipo LIKE '%IOL%' or 
							tipo LIKE '%OCT%' or 
							tipo LIKE '%RFG%' or 
							tipo LIKE '%RFG Color%' or 
							tipo LIKE '%ME%' or 
							tipo LIKE '%TOPO%'
						)";*/

		if ($medico_seleccionado == null)
			$medico = '%%';
			//$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND ".$estado." ORDER BY last_update ASC");
			//$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND estado = '$estado'".$tipo);
		else if ($medico_seleccionado == "Otro")
			$medico = 'Otro%';
			//$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND medico LIKE 'Otro%' AND (estado = '$estado' OR estado ='ok') ORDER BY last_update ASC");
			//$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND medico LIKE 'Otro%' AND estado = '$estado'".$tipo);
		else
			$medico = $medico_seleccionado;
			//$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND medico = '$medico_seleccionado' AND (estado = '$estado' OR estado ='ok') ORDER BY last_update ASC");
			//$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND medico = '$medico_seleccionado' AND estado = '$estado'".$tipo);
		//$string = "SELECT * FROM turnos WHERE fecha = '$fecha' AND ".$estado." AND medico LIKE '$medico' ORDER BY last_update ASC";
		$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND ".$estado. " AND medico LIKE '$medico' ORDER BY last_update ASC");

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
			return null;
		}
		
	}

	function update_estado_turno($array) {

		$id = $array['id_turno'];
		$estado = $array['sel_estado'];
		$medico = $array['sel_medico'];
		//$facturado = $array['facturado'];

		$usuario = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');

		//if ($facturado == 1)
		//	$this->db->query("UPDATE turnos SET ya_facturado = 1 WHERE id = '$id'");
		//else
			$this->db->query("UPDATE turnos SET usuario = '$usuario', medico = '$medico', estado = '$estado', ya_facturado = 0 WHERE id = '$id'");
	}

	function update_tipo_turno($tipo_turno, $array) {

		//print_r($tipo_turno);
		$id = $array['id_turno'];
		//$medico = $array['sel_medico'];
/*
		if (strpos($array['sel_medico'], 'Otro') === false)
			$medico = $this->main_model->get_medico_by_id($array['sel_medico']);
		else
			$medico = $array['sel_medico'];
*/
		//$medico = $this->get_medico_by_id($array['sel_medico']);

		$estado = $array['sel_estado'];
		$facturado = $array['facturado'];

		$usuario = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');

		if ($facturado == 1)
			$this->db->query("UPDATE turnos SET usuario = '$usuario', ya_facturado = 1 WHERE id = '$id'");
		else
			$this->db->query("UPDATE turnos SET usuario = '$usuario', tipo = '$tipo_turno', estado = '$estado', ya_facturado = 0 WHERE id = '$id'");
	}

	function update_facturacion($array, $data, $ordenes) {

		$usuario = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');

		$id = $array['id_turno'];
		$paciente = $array['paciente'];
		$ficha = $array['ficha'];
		$fecha = $array['fecha'];
		$estado = $array['estado'];
		$medico = $array['medico'];
		$fact_localidad = $array['fact_localidad'];
		$at_localidad = $array['at_localidad'];
		$obra_turno = $array['obra_turno'];

		$query = $this->db->query("SELECT id FROM facturacion WHERE id_turno = '$id'");

		if ($query->num_rows>0)
			$this->db->query("UPDATE facturacion SET usuario = '$usuario', datos = '$data', ordenes_pendientes = '$ordenes', estado = '$estado', facturacion_localidad = '$fact_localidad', atendido_localidad = '$at_localidad', obra_turno = '$obra_turno' WHERE id_turno = '$id'");
		else
			$this->db->query("INSERT INTO facturacion (id_turno,paciente,ficha,datos,ordenes_pendientes,medico,usuario,fecha,estado,facturacion_localidad,atendido_localidad,obra_turno) VALUES ('$id','$paciente','$ficha','$data','$ordenes','$medico','$usuario','$fecha','$estado','$fact_localidad','$at_localidad','$obra_turno') ");
		/*
		if ($query->num_rows>0)
			$this->db->query("UPDATE facturacion SET usuario = '$usuario', medico = '$medico', datos = '$data', ordenes_pendientes = '$ordenes', estado = '$estado', localidad = '$localidad', obra_turno = '$obra_turno' WHERE id_turno = '$id'");
		else
			$this->db->query("INSERT INTO facturacion (id_turno,paciente,ficha,datos,ordenes_pendientes,medico,usuario,fecha,estado,localidad,obra_turno) VALUES ('$id','$paciente','$ficha','$data','$ordenes','$medico','$usuario','$fecha','$estado','$localidad','$obra_turno') ");
		*/
	}

	function borrar_facturacion($id) {
		$this->db->query("DELETE FROM facturacion WHERE id_turno = '$id'");
	}

	function buscar_facturacion ($array) {

		$obra = $array['sel_obra'];
		$medico = $array['sel_medico'];
		$fact_localidad = $array['sel_facturacion_barra'];
		$at_localidad = $array['sel_atendido_barra'];
		$date_from = $array['fecha_desde'];
		$date_to = $array['fecha_hasta'];

		$medico = $this->get_medico_by_id($medico);
	
		if ( $obra == "todos")
			$obra = "";
		if ( $medico == "")
			$medico = "%%";
		else if ($medico == "Otro")
			$medico = "Otro%";

		if ( $fact_localidad == "Todas")
			$fact_localidad = "%%";

		if ( $at_localidad == "Todas")
			$at_localidad = "%%";

		$string = "SELECT id_turno, paciente, ficha, medico, datos, ordenes_pendientes, fecha FROM facturacion WHERE datos LIKE '%$obra%' AND medico LIKE '$medico' AND facturacion_localidad LIKE '$fact_localidad' AND atendido_localidad LIKE '$at_localidad' AND (fecha BETWEEN '$date_from' AND '$date_to') ORDER BY fecha DESC";
		
		$query = $this->db->query($string);

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

	function bloquear_dia($array) {

		$data['usuario'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');
		$data['motivo'] = $array['motivo'];
		$data['fecha'] = $array['fecha'];

		$medicos = $this->get_medicos();
		//echo $medicos[0]->id_medico;
		if ($array['medico'] == "todos") {
			foreach ($medicos as $key => $value) {
				if ($this->is_bloqueado($data['fecha'], $value->id_medico) == null) {
					$data['medico'] = $value->id_medico;
					$str = $this->db->insert_string('bloqueado', $data);
					$this->db->query($str);	
				}
			}
		}	
		else {
			$data['medico'] = $array['medico'];
			$str = $this->db->insert_string('bloqueado', $data);
			$this->db->query($str);		
		}
	}

	function desbloquear_dia($array) {
		//echo $fecha;
		$fecha = $array['fecha'];

		$medicos = $this->get_medicos();
		//echo $medicos[0]->id_medico;
		if ($array['medico'] == "todos") {
			foreach ($medicos as $key => $value) {
				$medico = $value->id_medico;
				$this->db->delete('bloqueado', array('fecha' => $fecha, 'medico' => $medico));
			}
		}	
		else {
			$medico = $array['medico'];
			$this->db->delete('bloqueado', array('fecha' => $fecha, 'medico' => $medico));
		}

		//$this->db->query($str);
	}

	function is_bloqueado($fecha, $medico) {

		$medicos = $this->get_medicos();
		$count = 1;

		if ($medico == "todos")
			foreach ($medicos as $key => $value) {
				$medico = $value->id_medico;
				$query = $this->db->get_where('bloqueado', array('fecha' => $fecha, 'medico' => $medico));
				$count *= $query->num_rows();
			}			
		else {
			$query = $this->db->get_where('bloqueado', array('fecha' => $fecha, 'medico' => $medico));
			$count *= $query->num_rows();
		}	

		if ($count>0)
			return $query->row();

		return null;
	}

	function insert_datos_coord($data) {

		$key = $this->config->item('encryption_key');

		$ficha= $data['ficha'];
		$paciente = $data['paciente'];
		$obra = $data['obra'];
		$nro_obra = $data['nro_obra'];
		$practica_od = $data['practica_od'];
		$detalle_od = $data['detalle_od'];
		$practica_os = $data['practica_os'];
		$detalle_os = $data['detalle_os'];
		$obs = $data['obs'];
		$medico = $data['medico'];
		$fecha = date('Y-m-d');
		$cirujano = $data['cirujano'];

		$str = "INSERT INTO cirugias (id_paciente,paciente,obra,id_obra,practica_od,detalle_od,practica_os,detalle_os,obs,medico,cirujano,confirmado,debe_orden,fecha_prop) VALUES (
								AES_ENCRYPT('$ficha','$key'),
								AES_ENCRYPT('$paciente','$key'),
								AES_ENCRYPT('$obra','$key'),
								AES_ENCRYPT('$nro_obra','$key'),
								AES_ENCRYPT('$practica_od','$key'),
								AES_ENCRYPT('$detalle_od','$key'),
								AES_ENCRYPT('$practica_os','$key'),
								AES_ENCRYPT('$detalle_os','$key'),
								AES_ENCRYPT('$obs','$key'),
								AES_ENCRYPT('$medico','$key'),
								AES_ENCRYPT('$cirujano','$key'),
								AES_ENCRYPT('No','$key'),
								AES_ENCRYPT('No','$key'),
								'$fecha'
							)";
		
		$this->db->query($str);
	}

	function get_tipo_cirugias() {

		$string = "SELECT * FROM tipo_cirugia ORDER BY id ASC";
		
		$query = $this->db->query($string);

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


	function get_anestesias() {

		$string = "SELECT * FROM anestesias ORDER BY id ASC";
		
		$query = $this->db->query($string);

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

	function get_cirugias($array) {

		$key = $this->config->item('encryption_key');

		$obra = $array['sel_obra_'];
		$practica = $array['sel_practica_'];
		$medico = $this->get_medico_by_id($array['sel_medico_']);
		//$cirujano = $this->get_medico_by_id($_POST['sel_cirujano']);

		$date_from = $array['fecha_desde'];
		$date_to = $array['fecha_hasta'];

		if ( $obra == "todos")
			$obra = "%%";
		if ( $medico == "")
			$medico = "%%";
		if ( $practica == "todas")
			$practica = "%%";

		if (isset($array['check_orden']))
			$debe_orden = "Si";
		else
			$debe_orden = "%%";

		if (isset($array['check_conf']))
			$confirmado = "Si";
		else
			$confirmado = "%%";

		if (isset($array['check_deuda']))
			$deuda = "AND CAST(AES_DECRYPT(plus_paciente, '$key') AS UNSIGNED) > CAST(AES_DECRYPT(pagado_paciente, '$key') AS UNSIGNED)";
		else
			$deuda = "";

		$string = "SELECT
						id,
						CONVERT(AES_DECRYPT(id_paciente, '$key') USING 'utf8') id_paciente,
						CONVERT(AES_DECRYPT(paciente, '$key') USING 'utf8') paciente,
						CONVERT(AES_DECRYPT(obra, '$key') USING 'utf8') obra,
						CONVERT(AES_DECRYPT(id_obra, '$key') USING 'utf8') id_obra,
						CONVERT(AES_DECRYPT(practica_od, '$key') USING 'utf8') practica_od,
						CONVERT(AES_DECRYPT(practica_os, '$key') USING 'utf8') practica_os,
						CONVERT(AES_DECRYPT(anestesia_od, '$key') USING 'utf8') anestesia_od,
						CONVERT(AES_DECRYPT(anestesia_os, '$key') USING 'utf8') anestesia_os,
						CONVERT(AES_DECRYPT(detalle_od, '$key') USING 'utf8') detalle_od,
						CONVERT(AES_DECRYPT(detalle_os, '$key') USING 'utf8') detalle_os,
						CONVERT(AES_DECRYPT(medico, '$key') USING 'utf8') medico,
						CONVERT(AES_DECRYPT(cirujano, '$key') USING 'utf8') cirujano,
						CONVERT(AES_DECRYPT(presupuesto, '$key') USING 'utf8') presupuesto,
						CONVERT(AES_DECRYPT(plus_paciente, '$key') USING 'utf8') plus_paciente,
						CONVERT(AES_DECRYPT(pagado_paciente, '$key') USING 'utf8') pagado_paciente,
						CONVERT(AES_DECRYPT(paga_obra, '$key') USING 'utf8') paga_obra,
						CONVERT(AES_DECRYPT(coseguro_paciente, '$key') USING 'utf8') coseguro_paciente,
						CONVERT(AES_DECRYPT(debe_orden, '$key') USING 'utf8') debe_orden,
						CONVERT(AES_DECRYPT(confirmado, '$key') USING 'utf8') confirmado,
						CONVERT(AES_DECRYPT(obs, '$key') USING 'utf8') obs,
						fecha_prop
						FROM cirugias WHERE AES_DECRYPT(obra, '$key') LIKE '$obra'
						AND AES_DECRYPT(medico, '$key') LIKE '$medico'
						AND (AES_DECRYPT(practica_od, '$key') LIKE '$practica'
						OR AES_DECRYPT(practica_od, '$key') LIKE '$practica')
						AND AES_DECRYPT(debe_orden, '$key') LIKE '$debe_orden'
						AND AES_DECRYPT(confirmado, '$key') LIKE '$confirmado' ".$deuda. " AND (fecha_prop BETWEEN '$date_from' AND '$date_to')";

		$query = $this->db->query($string);
		
		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
			return 0;			

	}

	function update_cirugia($array) {

		$key = $this->config->item('encryption_key');

		$obra = $array['sel_obra'];
		$nro_obra = $array['nro_afiliado'];
		$practica_od = $array['sel_practica_od'];
		$practica_os = $array['sel_practica_os'];
		$anestesia_od = $array['sel_anestesia_od'];
		$anestesia_os = $array['sel_anestesia_os'];
		$detalle_od = $array['detalle_od'];
		$detalle_os = $array['detalle_os'];
		$obs = $array['obs'];
		$fecha = $array['fecha'];
		$cirujano = $array['sel_cirujano'];
		$medico = $array['sel_medico'];

		if (isset($array['orden']))
			$debe_orden = "Si";
		else
			$debe_orden = "No";

		if (isset($array['confirmado']))
			$confirmado = "Si";
		else
			$confirmado = "No";

		$presupuesto = $array['presupuesto'];
		$plus_paciente = $array['plus_paciente'];
		$pagado_paciente = $array['pagado_paciente'];
		$paga_obra = $array['paga_obra'];
		$coseguro_paciente = $array['coseguro_paciente'];
		

		$id = $array['id'];
	
		$string = "UPDATE cirugias SET
								obra = AES_ENCRYPT('$obra','$key'),
								id_obra = AES_ENCRYPT('$nro_obra','$key'),
								practica_od = AES_ENCRYPT('$practica_od','$key'),
								practica_os = AES_ENCRYPT('$practica_os','$key'),
								anestesia_od = AES_ENCRYPT('$anestesia_od','$key'),
								anestesia_os = AES_ENCRYPT('$anestesia_os','$key'),
								detalle_od = AES_ENCRYPT('$detalle_od','$key'),
								detalle_os = AES_ENCRYPT('$detalle_os','$key'),
								practica_od = AES_ENCRYPT('$practica_od','$key'),
								practica_os = AES_ENCRYPT('$practica_os','$key'),
								obs = AES_ENCRYPT('$obs','$key'),
								fecha_prop = '$fecha',
								cirujano = AES_ENCRYPT('$cirujano','$key'),
								medico = AES_ENCRYPT('$medico','$key'),
								debe_orden = AES_ENCRYPT('$debe_orden','$key'),
								confirmado = AES_ENCRYPT('$confirmado','$key'),
								presupuesto = AES_ENCRYPT('$presupuesto','$key'),
								plus_paciente = AES_ENCRYPT('$plus_paciente','$key'),
								pagado_paciente = AES_ENCRYPT('$pagado_paciente','$key'),
								paga_obra = AES_ENCRYPT('$paga_obra','$key'),
								coseguro_paciente = AES_ENCRYPT('$coseguro_paciente','$key')
						WHERE id = '$id'";
				
		$this->db->query($string);				
	}

	function reset_usuario($array) {

		$key = $this->config->item('encryption_key');
		
		$password = $array['user'];
		$iduser = $array['iduser'];


		$query = $this->db->query("SELECT * FROM usuarios WHERE id_user = '$iduser'");

		if ($query->num_rows()>0) {

			$str = "UPDATE usuarios SET 
									password = AES_ENCRYPT('$password','$key'),
									last_login = NULL
							WHERE id_user = '$iduser'";

			$this->db->query($str);				
		}	
	}

	function crear_usuario($array) {

		$key = $this->config->item('encryption_key');


		$user = $array['user'];
		$password = $array['user'];
		$nombre = $array['nombre'];
		$apellido = $array['apellido'];
		$grupo = $array['funciones'];
		$iduser = $array['iduser'];
		$funciones = implode(",",$array['funciones']);


		$query = $this->db->query("SELECT * FROM usuarios WHERE id_user = '$iduser'");

		if ($query->num_rows()>0) {

			$str = "UPDATE usuarios SET 
									user = AES_ENCRYPT('$user','$key'),
									nombre = AES_ENCRYPT('$nombre','$key'),
									apellido = AES_ENCRYPT('$apellido','$key'),
									funciones = AES_ENCRYPT('$funciones','$key')
							WHERE id_user = '$iduser'";
		}
		else {

			$str = "INSERT INTO usuarios (user,password,nombre,apellido,funciones,id_user) VALUES (
									AES_ENCRYPT('$user','$key'),
									AES_ENCRYPT('$password','$key'),
									AES_ENCRYPT('$nombre','$key'),
									AES_ENCRYPT('$apellido','$key'),
									AES_ENCRYPT('$funciones','$key'),
									'$iduser'
								)";
		}

		$this->db->query($str);

	}

	function get_usuarios() {

		$key = $this->config->item('encryption_key');

		//$string2 = "SELECT * FROM usuarios";

		$string = 	"SELECT 
						CONVERT(AES_DECRYPT(user, '$key') USING 'utf8')  user,
						CONVERT(AES_DECRYPT(nombre, '$key') USING 'utf8')  nombre,
						CONVERT(AES_DECRYPT(apellido, '$key') USING 'utf8')  apellido,
						CONVERT(AES_DECRYPT(funciones, '$key') USING 'utf8')  funciones,
						id_user
						FROM usuarios";
	

		$query = $this->db->query($string);

		if ($query->num_rows()>0) {
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}	
		else
			return null;

	}

	function add_medico($array) {

		$nombre_apellido = $array['apellido'].", ".$array['nombre'][0];
		$idmedico = $array['iduser'];

		if (!isset($array["especialidad"]))
			$especialidad = "";
		else
			$especialidad = $array["especialidad"];

		if (!isset($array["cirujano"]))
			$cirujano = "";
		else
			$cirujano = $array["cirujano"];

		if (!isset($array["config"]))
			$config = "#FFD9B5";
		else
			$config = $array["config"];


		$query = $this->db->query("SELECT * FROM medicos WHERE id_medico = '$idmedico'");

		if ($query->num_rows()>0) {

			$str = "UPDATE medicos SET 
									nombre = '$nombre_apellido',
									config = '$config',
									especialidad = '$especialidad',
									cirujano = '$cirujano'
							WHERE id_medico = '$idmedico'";
		}
		else {

			$str = "INSERT INTO medicos (nombre,config,especialidad,cirujano,id_medico) VALUES (
									'$nombre_apellido',
									'$config',
									'$especialidad',
									'$cirujano',
									'$idmedico'
								)";
		}

		$this->db->query($str);

	}
}

?>