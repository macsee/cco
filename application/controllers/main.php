<?php

/**
* 
*/
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('main_model');
		$this->load->library('encrypt');
		$this->is_logged_in();
	}
	
	
	function index()
	{	
		session_start();
		$_SESSION = array();

		$this->load->view('home');
		//$this->load->view('login_view');
		//$this->cambiar_dia(date("Y-m-d"));
	}
	
	function is_logged_in() {

		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != true)
			redirect('login/index');
		
	}

	function translate($fecha) 
	{
		$day    = date("l", strtotime($fecha));
		$daynum = date("j", strtotime($fecha));
		$month  = date("F", strtotime($fecha));
		$year   = date("Y", strtotime($fecha));

		switch($day)
		{
		        case "Monday":  $day = "Lunes";  break;
		        case "Tuesday":   $day = "Martes"; break;
		        case "Wednesday": $day = "Miércoles";  break;
		        case "Thursday":  $day = "Jueves"; break;
		        case "Friday":  $day = "Viernes";  break;
		        case "Saturday":  $day = "Sábado";  break;
		        case "Sunday":  $day = "Domingo";  break;
		        default:                  $day = "Unknown"; break;
		}

		switch($month)
		{
		        case "January":   $month = "Enero";    break;
		        case "February":  $month = "Febrero";   break;
		        case "March":    $month = "Marzo";       break;
		        case "April":    $month = "Abril";       break;
		        case "May":        $month = "Mayo";         break;
		        case "June":      $month = "Junio";        break;
		        case "July":      $month = "Julio";        break;
		        case "August":  $month = "Agosto";      break;
		        case "September": $month = "Setiembre"; break;
		        case "October":   $month = "Octubre";   break;
		        case "November":  $month = "Noviembre";  break;
		        case "December":  $month = "Diciembre";  break;
		        default:                  $month = "Unknown";   break;
		}
		$data['day'] = $day;
		$data['daynum'] = $daynum;
		$data['month'] = $month;
		$data['year'] = $year;
		return $data;
	}
	
	function cambiar_dia($dia) {

		error_reporting(E_ALL); ini_set('display_errors', 1);
		//$calendar_anio = $this->uri->segment(4);
		//$calendar_mes = $this->uri->segment(5);
		$medico_seleccionado = $this->session->userdata('medico_seleccionado');

		/*
		if (!isset($medico_seleccionado)) {
			$this->session->set_userdata('medico_seleccionado', 0);
			$medico_seleccionado = 0;
		}	
		*/

		$med = $this->main_model->get_medico_by_id($medico_seleccionado);

		if ($med != null)
			$medico = $this->main_model->get_medico_by_id($medico_seleccionado)->nombre;
		else
			$medico = "";

		//$medico = $this->main_model->get_medico_by_id($this->main_model->getSelectedMedico()->valor);
		$aux = explode('-',$dia);
		$calendar_anio = $aux[0];
		$calendar_mes = $aux[1];
		$data['fecha'] = $dia;
		$data['filas'] = $this->main_model->turnos_del_dia($dia,$medico_seleccionado);
		//$data['datos_paciente'] = $this->get_datos_pacientes($data['filas']);
		
		//$data['filas'] = $this->main_model->get_turnos($dia,$medico);
		$data['horario'] = $this->main_model->get_horarios();
		$data['notas'] = $this->main_model->get_notas($dia);

		$array = $this->translate($dia);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];

		$data['id_turno'] = $this->get('id');
		$data['nuevo_turno'] = $this->get('nuevo_turno');
		$data['nombre_turno'] = $this->get('nombre');
		$data['apellido_turno'] = $this->get('apellido');

		//$data['calendario'] = $this->main_model->create_calendar(date('Y',strtotime($dia)), date('m',strtotime($dia)));

		$data['medicos'] = $this->main_model->get_medicos();
		$data['obras'] = $this->main_model->get_obras();
		$data['bloqueado'] = $this->main_model->is_bloqueado($dia,$medico_seleccionado);
		$data['localidades'] = $this->main_model->get_localidades();
		
		$data['medico_selected'] = $medico_seleccionado;
		$data['medico_selected_name'] = $medico; //$this->main_model->get_medico_by_id($medico_seleccionado)->nombre;
		
		//$this->load->view('main_view', $data);
		$array['title']="Turnos";
		$this->load->view('header',$array);
			$this->load->view('bootstrap_view', $data);
			$this->load->view('modal_editar', $data);
		$this->load->view('footer');
	}

	function get_datos_pacientes($id) {

		echo json_encode($this->main_model->buscar_id_paciente($id));

		// $pacientes = [];

		// if ($array != null)
		// 	foreach ($array as $key) {
		// 		//foreach ($key as $value) {
		// 			if ($key->id_paciente > 0)
		// 				$pacientes[$key->id_paciente] = $this->main_model->buscar_id_paciente($key->id_paciente);
		// 		//}	
		// 	}

		// return $pacientes;
	}
	
	function nuevo_paciente()
	{
		$resultado = $this->main_model->obtener_ultima_ficha();
		$data['ficha'] = ($resultado->nroficha) + 1;
		$data['nombre'] = $_POST['nombre'];
		$data['apellido'] = $_POST['apellido'];
		$data['obra'] = $_POST['obra'];
		$data['fecha'] = $_POST['fecha_turno'];
		$data['id_turno'] = $_POST['id_turno'];
		$data['obras'] = $this->main_model->get_obras();

		$aux_tel = explode ('-',$_POST['tel1']);
		$data['tel1_1'] = $aux_tel[0]; 
		$data['tel1_2'] = $aux_tel[1];

		if ($_POST['tel2'] <> "") {
			$aux_tel = explode ('-',$_POST['tel2']);
			$data['tel2_1'] = $aux_tel[0]; 
			$data['tel2_2'] = $aux_tel[1];		
		}

		$this->load->view('pacientes_home', $data);
		//echo "Crear nuevo paciente";
	}

	function nuevo_paciente_($id) {

		$filas = $this->main_model->get_turno_by($id);

		$resultado = $this->main_model->obtener_ultima_ficha();
		$data['ficha'] = ($resultado->nroficha) + 1;
		$data['nombre'] = $filas->nombre;
		$data['fecha'] = $filas->fecha;
		$data['apellido'] = $filas->apellido;
		$data['obra'] = $filas->obra_social;
		$data['obras'] = $this->main_model->get_obras();
		$data['id_turno'] = $id;

		$aux_tel = explode ('-',$filas->tel1);
		$data['tel1_1'] = $aux_tel[0]; 
		$data['tel1_2'] = $aux_tel[1];

		if ($filas->tel2 <> "") {
			$aux_tel = explode ('-',$filas->tel2);
			$data['tel2_1'] = $aux_tel[0]; 
			$data['tel2_2'] = $aux_tel[1];		
		}

		$this->load->view('pacientes_home', $data);

	}

	function editar_paciente ($id)
	{
		$resultado = $this->main_model->buscar_id_paciente($id);
		
		$data['id'] = $id;
		$data['ficha'] = $resultado[0]->nroficha;
		$data['nombre'] = $resultado[0]->nombre;
		$data['apellido'] = $resultado[0]->apellido;
		$data['obra'] = $resultado[0]->obra_social;
		$data['nro_obra'] = $resultado[0]->nro_obra;
		$data['fecha_nac'] = $resultado[0]->fecha_nacimiento;
		$data['fecha_ing'] = $resultado[0]->fecha_ingreso;
		$data['dni'] = $resultado[0]->dni;
		$data['direccion'] = $resultado[0]->direccion;
		$data['localidad'] = $resultado[0]->localidad;
		$data['obs'] = $resultado[0]->observaciones;
		if (!isset($_POST['fecha_turno']))
			$fecha_turno = "";
		else
			$fecha_turno = $_POST['fecha_turno'];

		$data['fecha'] = $fecha_turno;
		$data['obras'] = $this->main_model->get_obras();
		
		$repetidos = $this->main_model->check_ficha($data['ficha']); // NUEVO! Para saber si una ficha esta repetida al actualizar los datos de un paciente

		$data['repetidos'] = $repetidos;

		if ($resultado[0]->tel1 <> "") {

			if (strpos($resultado[0]->tel1, " ")) {
				$aux_tel = explode (" ",$resultado[0]->tel1);
				$data['tel1_1'] = $aux_tel[0];
				$data['tel1_2'] = $aux_tel[1];
			}

			else if (strpos($resultado[0]->tel1, "-")) {
				$aux_tel = explode ('-',$resultado[0]->tel1);
				$data['tel1_1'] = $aux_tel[0];
				$data['tel1_2'] = $aux_tel[1];
			}
			else {
				$data['tel1_2'] = $resultado[0]->tel1;
			}

		}

		if ($resultado[0]->tel2 <> "") {

			if (strpos($resultado[0]->tel2, " ")) {
				$aux_tel = explode (" ",$resultado[0]->tel2);
				$data['tel2_1'] = $aux_tel[0];
				$data['tel2_2'] = $aux_tel[1];
			}

			else if (strpos($resultado[0]->tel1, "-")) {
				$aux_tel = explode ('-',$resultado[0]->tel2);
				$data['tel2_1'] = $aux_tel[0];
				$data['tel2_2'] = $aux_tel[1];
			}
			else {
				$data['tel2_2'] = $resultado[0]->tel2;
			}

		}

		$this->load->view('pacientes_home', $data);
		
	}
		
	function buscar_paciente()
	{	

		$apellido =  rawurldecode ($this->uri->segment(3));
		$data['nombre'] = rawurldecode ($this->uri->segment(4));

		$data['id_turno'] = $this->uri->segment(5);

		if (is_numeric($apellido)) {
			$data['resultado'] = $this->main_model->buscar_id_paciente($apellido);	
		}
		else {
			$data['resultado'] = $this->main_model->buscar_paciente($apellido);		
		}

		$this->load->view('busqueda_paciente', $data);
	}

	function buscar_id_paciente($id)
	{	
		//$id = $this->uri->segment(3);
		$data['medicos'] = $this->main_model->get_medicos();
		$data['localidades'] = $this->main_model->get_localidades();
		$data['resultado'] = $this->main_model->buscar_id_paciente($id);
		$this->load->view('pacientes', $data);
	}

	function borrar_paciente($id)
	{
		$this->main_model->delete_paciente($id);
		echo "<script> parent.location.href = '".base_url('index.php/main/buscar_paciente/')."'; </script>";
		//redirect('main/buscar_paciente/', 'refresh');
	}
	
	function add_notas($fecha)
	{	$data['fecha'] = $fecha;
		$array = $this->translate($fecha);
		$data['dia'] = $array['day'];
		$data['nombre_dia'] = $array['daynum'];
		$data['mes'] = $array['month'];
		$data['ano'] = $array['year'];
		$this->load->view('nota_view', $data);
	}
	
	function pro_add_notas()
	{
		$this->main_model->guardar_notas($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha'], 'location');
	}
	
	function edit_notas($id)
	{
		$resultado = $this->main_model->get_notas_by_id($id);
		$data['notas'] = $resultado[0]->nota;
		$data['id'] = $resultado[0]->id;
		$data['fecha'] = $resultado[0]->fecha;
		$array = $this->translate($data['fecha']);
		$data['dia'] = $array['day'];
		$data['nombre_dia'] = $array['daynum'];
		$data['mes'] = $array['month'];
		$data['ano'] = $array['year'];
		$this->load->view('edit_nota', $data);
	}
	
	function pro_edit_notas()
	{
		$this->main_model->actualizar_notas($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha'], 'location');
	}
	
	function eliminar_nota($fecha,$id)
	{
		$this->main_model->eliminar_nota($id);
		$this->cambiar_dia($fecha);
	}
	
	function nuevo_turno($fecha,$hora,$minutos)
	{
		$horario = $hora.':'.$minutos;
		$data['fecha'] = $fecha; //$this->uri->segment(3);
		$data['horario'] = $horario;
		//$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['medico_seleccionado'] = $this->main_model->get_medico_by_id($this->session->userdata('medico_seleccionado'))['nombre'];
		$array = $this->translate($fecha);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];

		$this->load->view('nuevo_turno', $data);
	}
	
	function asignar_turno ($fecha,$hora,$minutos) {


		$horario = $hora.':'.$minutos;
		$data['fecha'] = $fecha; //$this->uri->segment(3);
		$data['horario'] = $horario;
		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();

		$id = $this->get('id');
		$data['filas'] = $this->main_model->get_turno_by($id);

		$array = $this->translate($fecha);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];
		$this->main_model->anular_cambio();	
		$this->load->view('nuevo_turno', $data);

	}

	function pro_nuevo_turno()
	{	
		//print_r($_POST);
		$this->main_model->guardar_turno($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha'], 'location');
		//redirect('main/cambiar_dia/'.$_POST['fecha'].'#'.$_POST['hora'].':'.$_POST['minutos'], 'location');
		//$this->load->view('nuevo_turno_exito');
	}
	
	function editar_turno($id)
	{

		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['filas'] = $this->main_model->get_turno_by($id);
		
		$aux = $data['filas']->fecha;
		$aux2 = $data['filas']->hora;
				
		$fecha = date('d-m-Y', strtotime($aux));
		$hora = date('H:i', strtotime($aux2));
		
		$array = $this->translate($fecha);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];
		$data['hora'] = $hora;
		$data['id'] = $id;

		$this->load->view('editar_turno', $data);
	}

	function pro_edit_turno()
	{
		$this->main_model->actualizar_turno($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha'], 'location');
		//redirect('main/cambiar_dia/'.$_POST['fecha'].'#'.$_POST['hora'], 'location');
		//$this->load->view('nuevo_turno_exito');
	}
	
	function borrar_turno($id)
	{
		$data = $this->main_model->get_turno_by($id);
		$hora = date('H:i', strtotime($data->hora));
		$this->main_model->delete_turno($id);
		redirect('main/cambiar_dia/'.$data->fecha, 'location');
		//redirect('main/cambiar_dia/'.$data[0]->fecha.'#'.$hora, 'location');
	}

	function cambiar_turno()
	{
		$data['fecha'] = $_POST['form_fecha'];
		$data['hora'] = $_POST['form_hora'].':'.$_POST['form_minutos'];
		$data['citado'] = $_POST['cita_hora'].':'.$_POST['cita_minutos'];
	
		$data['id'] = $this->get('id');
		$data['nombre_turno'] = $this->get('nombre');
		$data['apellido_turno'] = $this->get('apellido');
		$this->main_model->cambiar_turno($data);
		redirect('main/cambiar_dia/'.$data['fecha'], 'location');
		//redirect('main/cambiar_dia/'.$fecha.'#'.$data['hora'], 'location');
	}

	function set($var,$valor)
	{
		$this->main_model->setear($var, $valor);
	}

	function get($var)
	{
		return $this->main_model->obtener($var);

	}

	function facturar($id)
	{
		$data['filas'] = $this->main_model->get_turno_by($id);
		$this->load->view('edit_factura',$data);
	}

	function pro_facturacion()
	{
		$this->main_model->facturar($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha'], 'location');
		//$this->cambiar_dia($_POST['fecha']);
	}
	
	function vista_turno($id)
	{
		$data['result'] = $this->main_model->get_turno_by($id);
		$this->load->view('turno_view', $data);
	}
	
	function anular_cambio_turno($fecha, $hora, $minuto)
	{
		$this->main_model->anular_cambio();
		//redirect('main/cambiar_dia/'.$fecha.'#'.$hora.':'.$minuto, 'location');
		redirect('main/cambiar_dia/'.$fecha, 'location');
	}
	
	function set_cambio($fecha, $id, $nombre, $apellido)
	{
		$this->set('id',$id);
		$this->set('nombre',$nombre);
		$this->set('apellido',$apellido);
		redirect('main/cambiar_dia/'.$fecha, 'location');
	}

	function set_turno($fecha, $id)
	{	
		$this->set('nuevo_turno',1);
		$this->set('id',$id);
		redirect('main/cambiar_dia/'.$fecha, 'location');
	}	

	function show_calendar()
	{
		$ano = $this->uri->segment(3);
		$mes = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$data['calendario'] = $this->main_model->create_calendar($ano, $mes);
		if ($id <> "") 
		{
			$this->set('id',$id);
		}
		
		$this->load->view('calendario_view', $data);
	}
	
	function cambiar_estado($var,$id,$fecha,$hora,$minuto)
	{	
		$this->main_model->cambiar_estado($var,$id);
		redirect('main/cambiar_dia/'.$fecha, 'location');
		//redirect('main/cambiar_dia/'.$fecha.'#'.$hora.':'.$minuto, 'location');
	}
	
	function busqueda()
	{
		$array['busqueda'] = $this->main_model->buscar($_POST['busqueda_texto']);
		$this->load->view('busqueda_view', $array);
	}


/******************************************** Agendas *************************************************/

function agendas()
{	
	
	$data['agendas'] = $this->main_model->get_agendas();
	$this->load->view('agendas', $data);
}

function pro_nueva_agenda()
{
	$data['fecha'] = $_POST['fecha'];
	$data['tipo'] = $_POST['tipo'];
	$this->main_model->crear_agenda($data);
	redirect('main/agendas/', 'location');
}

function ver_agenda($dia, $mes, $anio, $tipo)
{
	$fecha = date('Y-m-d', strtotime($dia.'-'.$mes.'-'.$anio));
	$data['resultado'] = $this->main_model->ver_agenda($fecha, $tipo);
	$this->load->view('vista_agenda', $data);
}

/******************************************** Pacientes ***********************************************/

	function pacientes()
	{
		$resultado = $this->main_model->obtener_ultima_ficha();
		$data['ultima_ficha'] = ($resultado->nroficha) + 1;
		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['localidades'] = $this->main_model->get_localidades();


		$this->load->view('pacientes_home', $data);
	}


	function pro_ingresar_paciente() {

		$ultimo = $this->main_model->ingresar_paciente($_POST);
		$_POST['id_paciente'] = $ultimo->id; // guardo el id paciente para que lo tome sin_turno

		if ($_POST['tipo'] == "sin_turno") {
			$this->sin_turno($_POST);
			redirect('main/historia_clinica/'.$ultimo->id, 'location');
		}	

		if (isset($_POST['id_turno']) && $_POST['id_turno'] != "") {
				$this->main_model->asignar_ficha($_POST['id_turno'],$_POST['ficha'], $ultimo->id); // para asignar la nueva ficha al paciente en el turno.
				redirect('main/cambiar_dia/'.$_POST['fecha_turno'], 'location');
		}
		else	
			redirect('main/pacientes/', 'location');
		
		//redirect('main/pacientes/', 'location');
	}

	function pro_nuevo_paciente() {	

		$data = $_POST;
		$data['ficha'] = $this->main_model->check_ficha($_POST['ficha']);
		$data['nroficha'] = $_POST['ficha'];
		$data['paciente'] = $this->main_model->check_nombre_apellido($_POST['nombre'], $_POST['apellido']);

		if ($data['paciente'] == 0) {
			if ($data['ficha'] == 0	) {
				
				$ultimo = $this->main_model->ingresar_paciente($_POST);

				if ($_POST['id_turno'] != "") {
					$this->main_model->asignar_ficha($_POST['id_turno'],$_POST['ficha'], $ultimo->id); // para asignar la nueva ficha al paciente en el turno.
					redirect('main/cambiar_dia/'.$_POST['fecha_turno'], 'location');
				}
				else	
					redirect('main/pacientes/', 'location');

			}
			else {
				$data['value'] = 'error ficha';
				$data['tipo'] = 'con_turno';
				$this->load->view('paciente_error',$data);
			}
		}
		else {
			$data['value'] = 'error paciente';
			$data['tipo'] = 'con_turno';
			$this->load->view('paciente_error',$data);
		}
		//$this->load->view('nuevo_turno_exito');
	}

	function nuevo_paciente_sinturno() {


		$data = $_POST;

		$data['ficha'] = $this->main_model->check_ficha($_POST['ficha']);
		$data['nroficha'] = $_POST['ficha'];
		$data['paciente'] = $this->main_model->check_nombre_apellido($_POST['nombre'], $_POST['apellido']);
		//$tipo = array("Consulta");

		//$array = $_POST;

		if ($data['paciente'] == 0) {
			if ($data['ficha'] == 0	) {
				
				$ultimo = $this->main_model->ingresar_paciente($_POST);

				$data['ficha'] = $ultimo->nroficha;
				$data['id_paciente'] = $ultimo->id;

				$this->sin_turno($data);

				redirect('main/historia_clinica/'.$ultimo->id, 'location');
				
			}
			else {
				$data['value'] = 'error ficha';
				$data['tipo'] = 'sin_turno';
				$this->load->view('paciente_error',$data);
			}
		}
		else {
			$data['value'] = 'error paciente';
			$data['tipo'] = 'sin_turno';
			$this->load->view('paciente_error',$data);
		}

	}

	function paciente_sinturno() {

		$this->sin_turno($_POST);
		
	}

	function sin_turno($post) {

		$tipo = array("Consulta");

		$array = $post;

		$array['tipo'] = $tipo;
		$array['fecha'] = date('Y-m-d');
		$array['hora'] = date('H');
		$array['minutos'] = date('i');
		$array['hora_citado'] = date('H');
		$array['minutos_citado'] = date('i');
		$array['notas'] = "";
		$array['otro'] = "";
		$array['medico'] = $this->main_model->get_medico_by_id($post['sel_medico'])->nombre;
		//$array['sel_localidad'] = $_POST['sel_localidad'];
		$array['sel_estado'] = "medico";
		$array['obra_turno'] = $post['obra'];

		$array['id_turno'] = $this->main_model->guardar_turno($array)->id;
		$this->facturar_sinturno($array);

	}

	function facturar_sinturno($post) {

		$array = $post;

		$tipo = array("Consulta");
		$array['chk_turno'] = $tipo;
		$array['coseguro_consulta'] = "";
		$array['id_turno'] = $post['id_turno'];

		$array['sel_consulta'] = $post['obra'];
		//$array['sel_medico'] = $post['sel_medico'];
		$array['ficha_fact'] = $post['ficha'];
		$array['sel_estado'] = "medico";
		$array['fecha_fact'] = $post['fecha'];;
		$array['sel_atendido'] = $post['sel_atendido'];
		$array['sel_facturacion'] = $post['sel_atendido'];
		$array['apellido_fact'] = $post['apellido'];
		$array['nombre_fact'] = $post['nombre'];	

		$this->edit_facturacion($array);

	}

	function pro_edit_paciente() {

		//print_r($_SERVER);
		$this->main_model->actualizar_paciente($_POST);
		
		//$url = str_replace('_id', '', $_SERVER['HTTP_REFERER']);
		//$url = $_POST['callback_url'];
		
		if ($_POST['fecha_turno'] != "")
			redirect('main/cambiar_dia/'.$_POST['fecha_turno'], 'location');
		else	
			redirect('main/buscar_paciente/'.$_POST['id_paciente'], 'location');
	}

	function asignar_ficha($id_turno, $ficha, $id, $nombre, $apellido){

		$this->main_model->asignar_ficha($id_turno, $ficha, $id, $nombre, $apellido);
		$resultado = $this->main_model->obtener_fecha_turno($id_turno);
		redirect('main/cambiar_dia/'.$resultado->fecha, 'location');
	}

	function my_encode($var) {
		$key = $this->config->item('encryption_key');
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND); //genero el "salt"

		return base64_encode($iv.mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $var, MCRYPT_MODE_CBC, $iv));//codifico y paso el "salt"
	}

	function my_decode($var) {
		$key = $this->config->item('encryption_key');
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);

		$text = base64_decode($var);

		$iv = substr($text, 0, $iv_size); //obtengo el "salt"
		$toDecode = substr($text, $iv_size); //obtengo lo que quiero decodificar

		return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $toDecode, MCRYPT_MODE_CBC, $iv); //decodificar
	}
/******************************************** Historia Clinica ***********************************************/

	function upload($paciente) {

		$data['paciente'] = $paciente;
		$this->load->view('upload_view', $data);
	}

	function do_upload() {
		
		$fecha_sql =  date('d-m-Y');
		$fecha =  date('dmY');

		if ($_POST['fecha'] != "") {
			$fecha_sql = date('d-m-Y', strtotime($_POST['fecha']));
			$fecha = date('dmY', strtotime($_POST['fecha']));
		}	
			
		$tipo = $_POST['tipo'];
		$id_paciente = $_POST['paciente'];

			
		$dir = $this->config->item('upload_dir').$id_paciente.'/'.$tipo;

		if (!is_dir($dir)) {
			mkdir($dir,0777,true);
		}

		$count = 0;

		foreach ($_FILES['userfile']['name'] as $fieldName => $file) {

			$contador_archivo = 0;

			$extension = explode('.', $file);
			$extension = ".".$extension[sizeof($extension)-1];

			$name = $tipo.'_'.$id_paciente.'_'.$fecha;
			$exist = $name;

			foreach (glob($dir.'/'.$exist."*") as $filename) {
				//$exist = $name.'_'.$contador_archivo;
				$contador_archivo++;

			}

			$exist = $name.'_'.$contador_archivo;

			$name_extension = $exist.$extension;

			if($contador_archivo > 0)
				$imagen = $contador_archivo.'_'.$fecha_sql;
			else
				$imagen = $fecha_sql;

    		move_uploaded_file($_FILES['userfile']['tmp_name'][$count], "$dir/$name_extension");
    		$count++;

    		$array['id_paciente'] = $id_paciente;
			$array['tipo'] = $tipo;
			$array['fecha'] = date('Y-m-d', strtotime($fecha_sql));
			$array['imagen'] = $imagen;
			$array['ruta'] = $id_paciente.'/'.$tipo.'/'.$name_extension;
			$this->main_model->ingresar_estudios($array);

		}

		//$data['url'] = base_url('index.php/main/historia_clinica/'.$id_paciente);
		//$this->load->view('upload_msg', $data);

		redirect('main/historia_clinica/'.$id_paciente);
		//redirect('main/cambiar_dia/'.$resultado->fecha, 'location');
		//header('Refresh: 1; url='.base_url('index.php/main/historia_clinica/'.$_POST['paciente']));

	}

	function borrar_estudio($id, $id_paciente) {


		$result = $this->main_model->get_estudio($id);
		$url = explode('/', $result->ruta);
		$path_to_file = $url[0].'/'.$url[1].'/'.$url[2];
		
		if (unlink($this->config->item('upload_dir').$path_to_file)) {
			$this->main_model->borrar_estudio($id);
			redirect('main/historia_clinica/'.$id_paciente);
		}	
		else
			echo "Error al borrar estudio";
	}

	function formatear($file, $tipo, $id) {

		
		$fecha =  date('dmY');
		

		$nombre_archivo = "";

		if (stripos($file, "comp")) {

			$nombre_archivo = "COMPARACION-";		
		}
		if (stripos($file, "od")) {
			
				$nombre_archivo = $tipo.'-'.$id.'-'.$fecha.'-'.$nombre_archivo.'OD';
		}
		elseif (stripos($file, "oi") || stripos($file, "os")) {
			
				$nombre_archivo = $tipo.'-'.$id.'-'.$fecha.'-'.$nombre_archivo.'OS';
		}
		else {
			$nombre_archivo =  $tipo.'-'.$id.'-'.$fecha;
		}

		return $nombre_archivo;	

	}

	function cambiar_medico($medico,$fecha,$url) {
		//$this->main_model->setSelectedMedico($medico);

		$this->session->set_userdata('medico_seleccionado', $medico);
		if ($url == "admision")
			redirect('main/pacientes_admitidos/'.$fecha);
		else
			redirect('main/cambiar_dia/'.$fecha);
	}

	function historia_clinica($id) {

		$data['estudios'] = $this->main_model->get_fechas_estudios($id);
		$data['datos_paciente'] = $this->main_model->buscar_id_paciente($id);

		$data['historia'] = $this->main_model->get_historia($id);
		$data['antecedentes'] = $this->main_model->get_antecedentes($id);

		$borrador_antecedente = $this->main_model->get_borrador($id,"antecedente");
	
		if (empty($borrador_antecedente))
			$data['borrador_antecedente'] = "";
		else
			$data['borrador_antecedente'] = $this->unfixjson_ant(json_decode($borrador_antecedente->data)->antecedente);
		
		$data['paciente_id'] = $id;
		$this->load->view('view_historia', $data);
	}

	function load_hc_form($id) {
		$data['paciente'] = $id;

		$borrador_registro = $this->main_model->get_borrador($id,"registro");

		if (empty($borrador_registro))
			$data['borrador_registro'] = "";
		else
			$data['borrador_registro'] = $this->unfixjson_reg($borrador_registro->data);

		//$data['diagnosticos'] = $this->main_model->get_diagnosticos();
		$this->load->view('form_hc',$data);
	}

	function fixjson($value) {
		$escapers = array('\\', '/', '\n', '\r', '\t', '\x08', '\x0c', '\'');
    	$replacements = array('\\\\', '\\/', '<br>', '\\r', '\\t', '\\f', '\\b', "''");
		$result = str_replace($escapers, $replacements, $value);
   		return $result;
	}

	function unfixjson_reg($value) {
		$escapers = array('\\', '\\/', '<br>', '\\r', '\\t', '\\f', '\\b', "''");
		$replacements = array('\\', '/', '\n', '\r', '\t', '\x08', '\x0c', '\'');
		$result = str_replace($escapers, $replacements, $value);
   		return $result;
	}

	function unfixjson_ant($value) {
		$escapers = array('\\\\', '\\/', '<br>', '\\r', '\\t', '\\f', '\\b', "''");
		$replacements = array("\\", "/", "\n", "\r", "\t", "\x08", "\x0c", "\'");
		$result = str_replace($escapers, $replacements, $value);
   		return $result;
	}		

	function submit_data($tipo) {
		 
		$data['fecha'] = date('Y-m-d H:i:s',time());

		if ($tipo == "registro") {
			$test = str_replace(array('"',']','['),"", $_POST['txt_diag']);
			$test = str_replace(',', ', ', $test);
			$_POST['txt_diag'] = $test;
		}

		$data['text'] = $this->fixjson(json_encode($_POST,JSON_UNESCAPED_UNICODE));

		$data['tipo'] = $tipo;
		$data['id_paciente'] = $_POST['paciente'];
		$data['medico'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');

		$this->main_model->insert_record($data);

		$this->main_model->delete_borrador($data);

		redirect('main/historia_clinica/'.$_POST['paciente']);
	}
	
	function guardar_borrador($tipo) {

		//$data['fecha'] = date('Y-m-d H:i:s',time());
		if ($tipo == "registro") {
			$test = str_replace(array('"',']','['),"", $_POST['txt_diag']);
			$test = str_replace(',', ', ', $test);
			$_POST['txt_diag'] = $test;
		}

		$data['text'] = $this->fixjson(json_encode($_POST,JSON_UNESCAPED_UNICODE));

		$data['tipo'] = $tipo;
		$data['id_paciente'] = $_POST['paciente'];
		$data['medico'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');

		$this->main_model->save_borrador($data);

		redirect('main/historia_clinica/'.$_POST['paciente']);

	}

	function eliminar_borrador($tipo) {

		$data['id_paciente'] = $_POST['paciente'];
		$data['tipo'] = $tipo;
		$this->main_model->delete_borrador($data);
		redirect('main/historia_clinica/'.$_POST['paciente']);
	}
	

	function pacientes_admitidos($fecha) {

		//$fecha = date('Y-m-d',time());
		//$fecha = date('Y-m-d',strtotime('2014-12-16'));
		$data['fecha'] = date('Y-m-d',strtotime($fecha));
		$data['medicos'] = $this->main_model->get_medicos();

		$medico_selected = $this->session->userdata('medico_seleccionado');

		$data['tipo_user'] = $this->session->userdata('funciones');
		$data['medico_selected'] = $medico_selected;

		$medico = $this->main_model->get_medico_by_id($medico_selected)->nombre;
		$data['filas'] = $this->main_model->get_pacientes_admitidos($fecha,$medico);

		$array = $this->translate($fecha);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];
		
		$this->load->view('pacientes_ok',$data);
	}

	function edit_facturacion($array) {

		$array_info['id_turno'] = $array['id_turno'];
		$array_info['sel_medico'] = $array['sel_medico'];		
		$array_info['ficha'] = $array['ficha_fact'];
		$array_info['estado'] = $array['sel_estado'];
		$array_info['fecha'] = $array['fecha_fact'];
		$array_info['fact_localidad'] = $array['sel_facturacion'];
		$array_info['at_localidad'] = $array['sel_atendido'];
		$array_info['obra_turno'] = $array['obra_turno'];

		//$this->session->set_flashdata('obra_selected',$array['obra_sel']);

		$nombre_1 = ucwords($array['nombre_fact']);
		$nombre_1 = ucwords(strtolower($nombre_1));

		$apellido_1 = ucwords($array['apellido_fact']);
		$apellido_1 = ucwords(strtolower($apellido_1));



		$array_info['paciente'] = $apellido_1.', '.$nombre_1;

		// Esto lo hago para obtener la obra social por defecto del turno. Cuando ya fue facturado al menos una vez, pierdo la referencia a la obra social del turno.
		//$obra_social = $this->main_model->get_turno_by($array_info['id_turno'])[0]->obra_social;

		$array_fact = null;
		$array_ordenes = null;

		$checks = ["cvc", "iol", "topo", "me", "oct", "rfgc", "rfg", "hrt", "obi", "paqui", "consulta", "laser", "yag"];

		if (isset($array['chk_turno'])) {

			// Recordar que los elementos no estan seteados cuando estan deshabilitados

			foreach ($checks as $key) {

				$array_['sel_'.$key] = $array_info['obra_turno'];

				if (isset($array['sel_'.$key]))
					if ($array['sel_'.$key] != "")
						$array_['sel_'.$key] = $array['sel_'.$key];
				
			}

			//print_r($array['chk_turno']);

			$array_fact['cvc'] 		= in_array("CVC", $array['chk_turno']) 		? $array_['sel_cvc'] : "";
			$array_fact['iol'] 		= in_array("IOL", $array['chk_turno']) 		? $array_['sel_iol'] : "";
			$array_fact['me'] 		= in_array("ME", $array['chk_turno']) 		? $array_['sel_me'] : "";
			$array_fact['oct'] 		= in_array("OCT", $array['chk_turno']) 		? $array_['sel_oct'] : "";
			$array_fact['topo'] 	= in_array("TOPO", $array['chk_turno']) 	? $array_['sel_topo'] : "";
			$array_fact['rfgc'] 	= in_array("RFG Color", $array['chk_turno']) 	? $array_['sel_rfgc'] : "";
			$array_fact['rfg'] 		= in_array("RFG", $array['chk_turno']) 		? $array_['sel_rfg'] : "";
			$array_fact['yag'] 		= in_array("YAG", $array['chk_turno']) 		? $array_['sel_yag'] : "";
			$array_fact['laser'] 	= in_array("Laser", $array['chk_turno']) 	? $array_['sel_laser'] : "";
			$array_fact['obi'] 		= in_array("OBI", $array['chk_turno']) 		? $array_['sel_obi'] : "";
			$array_fact['paqui'] 	= in_array("PAQUI", $array['chk_turno']) 	? $array_['sel_paqui'] : "";
			$array_fact['hrt'] 		= in_array("HRT", $array['chk_turno']) 		? $array_['sel_hrt'] : "";
			$array_fact['consulta'] = in_array("Consulta", $array['chk_turno']) ? $array_['sel_consulta'] : "";
			$array_fact['sin_cargo'] = in_array("S/Cargo", $array['chk_turno']) ? "S/Cargo" : "";

			$array_fact['cvc_coseguro'] 		= in_array("CVC", $array['chk_turno']) 		? $array['coseguro_cvc'] : "";
			$array_fact['iol_coseguro'] 		= in_array("IOL", $array['chk_turno']) 		? $array['coseguro_iol'] : "";
			$array_fact['me_coseguro'] 			= in_array("ME", $array['chk_turno']) 		? $array['coseguro_me'] : "";
			$array_fact['oct_coseguro'] 		= in_array("OCT", $array['chk_turno']) 		? $array['coseguro_oct'] : "";
			$array_fact['topo_coseguro'] 		= in_array("TOPO", $array['chk_turno']) 	? $array['coseguro_topo'] : "";
			$array_fact['rfgc_coseguro'] 		= in_array("RFG Color", $array['chk_turno']) 	? $array['coseguro_rfgc'] : "";
			$array_fact['rfg_coseguro'] 		= in_array("RFG", $array['chk_turno']) 		? $array['coseguro_rfg'] : "";
			$array_fact['yag_coseguro'] 		= in_array("YAG", $array['chk_turno']) 		? $array['coseguro_yag'] : "";
			$array_fact['laser_coseguro'] 		= in_array("Laser", $array['chk_turno']) 	? $array['coseguro_laser'] : "";
			$array_fact['obi_coseguro'] 		= in_array("OBI", $array['chk_turno']) 		? $array['coseguro_obi'] : "";
			$array_fact['paqui_coseguro'] 		= in_array("PAQUI", $array['chk_turno']) 	? $array['coseguro_paqui'] : "";
			$array_fact['hrt_coseguro'] 		= in_array("HRT", $array['chk_turno']) 		? $array['coseguro_hrt'] : "";
			$array_fact['consulta_coseguro'] 	= in_array("Consulta", $array['chk_turno']) ? $array['coseguro_consulta'] : "";

		}

		if (isset($array['chk_ord'])) {

			$array_ordenes['cvc_orden'] 		= in_array("ord_cvc", $array['chk_ord']) 		? "SI"	: "";
			$array_ordenes['iol_orden'] 		= in_array("ord_iol", $array['chk_ord']) 		? "SI" 	: "";
			$array_ordenes['me_orden'] 			= in_array("ord_me", $array['chk_ord']) 		? "SI"	: "";
			$array_ordenes['oct_orden'] 		= in_array("ord_oct", $array['chk_ord']) 		? "SI" 	: "";
			$array_ordenes['topo_orden'] 		= in_array("ord_topo", $array['chk_ord']) 		? "SI"	: "";
			$array_ordenes['rfgc_orden'] 		= in_array("ord_rfgc", $array['chk_ord']) 		? "SI"	: "";
			$array_ordenes['rfg_orden'] 		= in_array("ord_rfg", $array['chk_ord']) 		? "SI" 	: "";
			$array_ordenes['yag_orden'] 		= in_array("ord_yag", $array['chk_ord']) 		? "SI" 	: "";
			$array_ordenes['laser_orden'] 		= in_array("ord_laser", $array['chk_ord']) 		? "SI"	: "";
			$array_ordenes['obi_orden'] 		= in_array("ord_obi", $array['chk_ord']) 		? "SI" 	: "";
			$array_ordenes['paqui_orden'] 		= in_array("ord_paqui", $array['chk_ord']) 		? "SI"	: "";
			$array_ordenes['hrt_orden'] 		= in_array("ord_hrt", $array['chk_ord']) 		? "SI" 	: "";
			$array_ordenes['consulta_orden'] 	= in_array("ord_consulta", $array['chk_ord']) 	? "SI" 	: "";
		}
			
		$this->main_model->update_facturacion($array_info, json_encode($array_fact,JSON_UNESCAPED_UNICODE), json_encode($array_ordenes,JSON_UNESCAPED_UNICODE));
	}

	function edit_turno($array, $facturado) {

		$tipo_turno = null;
		$array['facturado'] = $facturado;

		if (isset($array['chk_turno'])) {

			$array_fact['CVC'] 		= in_array("CVC", $array['chk_turno']);
			$array_fact['IOL'] 		= in_array("IOL", $array['chk_turno']);
			$array_fact['ME'] 		= in_array("ME", $array['chk_turno']);
			$array_fact['OCT'] 		= in_array("OCT", $array['chk_turno']);
			$array_fact['TOPO'] 	= in_array("TOPO", $array['chk_turno']);
			$array_fact['RFG Color'] 	= in_array("RFG Color", $array['chk_turno']);
			$array_fact['RFG'] 		= in_array("RFG", $array['chk_turno']);
			$array_fact['YAG'] 		= in_array("YAG", $array['chk_turno']);
			$array_fact['Laser'] 	= in_array("Laser", $array['chk_turno']);
			$array_fact['OBI'] 		= in_array("OBI", $array['chk_turno']);
			$array_fact['PAQUI'] 	= in_array("PAQUI", $array['chk_turno']);
			$array_fact['HRT'] 		= in_array("HRT", $array['chk_turno']);
			$array_fact['Consulta'] = in_array("Consulta", $array['chk_turno']);
			$array_fact['S/Cargo'] = in_array("S/Cargo", $array['chk_turno']);

			foreach ($array_fact as $key => $value) {
				if ($value)
					$tipo_turno .= $key.', ';
			}

			$tipo_turno = trim($tipo_turno, ', ');

		}

		$this->main_model->update_tipo_turno($tipo_turno, $array);

	}

	function update_facturacion_turno($from) {

		//$this->edit_turno($_POST,$from);
		//$fecha = date('Y-m-d', strtotime($_POST['fecha_fact']));

		if (!isset($_POST['sel_estado']))
			$_POST['sel_estado'] = "ok";

		$this->edit_turno($_POST,$from);
		$this->edit_facturacion($_POST);

		if($from == 0) {			
			//$this->main_model->update_estado_turno($_POST);	
			//$this->edit_facturacion($_POST);

			$fecha = $_POST['fecha_fact'];
			redirect('main/cambiar_dia/'.$fecha);

		}	
		else
			redirect('main/facturacion/');
	}

	function bloquear_dia() {

		$this->main_model->bloquear_dia($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha']);
	}

	function desbloquear_dia() {

		//$fecha = $_POST['fecha'];
		$this->main_model->desbloquear_dia($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha']);
	}

	function facturacion() {

		session_start();

		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['localidades'] = $this->main_model->get_localidades();

		if (sizeof($_POST) != 0) {
			$_SESSION = $_POST;
		}	

		if (sizeof($_SESSION) != 0) {	

			$data = array_merge($_SESSION,$data);
			$data['resultado'] = $this->main_model->buscar_facturacion($_SESSION);
			$data['print'] = $this->print_facturacion($data);
			
			//print_r($data);
		}

		$this->load->view('facturacion_view',$data);		
	}

	function borrar_facturacion($id) {
		$this->main_model->borrar_facturacion($id);
		redirect('main/facturacion/');
	}

	function download_facturacion() {

		$resultado = $this->main_model->buscar_facturacion($_POST);
		$filename = date('d-m-Y-Hi').'.csv';

		//header("Content-Type: application/vnd.ms-excel");
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="Facturacion_'.$filename.'";');
		
		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		$pacientesConOrdenPend = null;
		$pacientesSinOrdenPend = null;

		if ($resultado != null) {

			if ($_POST['fecha_desde'] == "" && $_POST['fecha_hasta'] == "")
				$fecha = "Histórico";
			else
				$fecha = $_POST['fecha_desde']." a ".$_POST['fecha_hasta'];

			if ($_POST['sel_medico_barra'] == "todos")
				$medico = "Todos";
			else
				$medico = "Dr. ".$this->main_model->get_medico_by_id($_POST['sel_medico_barra'])->nombre;

			if ($_POST['sel_atendido_barra'] == "Todas")
				$atendido = "Todas las Localidades";
			else
				$atendido = $_POST['sel_atendido_barra'];

			if ($_POST['sel_facturacion_barra'] == "Todas")
				$facturacion = "Todas las Localidades";
			else
				$facturacion = $_POST['sel_facturacion_barra'];

			if ($_POST['sel_obra'] == "todos")
				$obra = "Todas las Obras Sociales";
			else
				$obra = $_POST['sel_obra'];

			fputcsv($output, array('Período:', $fecha,"","","","",""),";");
			fputcsv($output, array('Medico:', $medico,"","","","",""),";");
			fputcsv($output, array('Atendido en:', $atendido,"","","","",""),";");
			fputcsv($output, array('Facturado en:', $facturacion,"","","","",""),";");
			fputcsv($output, array('Obra social:', $obra,"","","","",""),";");
			fputcsv($output, array("","","","","","",""),";");

			fputcsv($output, array('Fecha', 'Ficha', 'Paciente', 'Practica', 'Obra Social', 'Coseguro','Debe Orden'),";");


			foreach ($resultado as $value) {

				$json = json_decode($value->datos);
				$json_orden = json_decode($value->ordenes_pendientes);


				if(count(json_decode($value->datos,1))!=0) {
    				
					foreach ($json as $practica=>$valor ) {

						$obrasocial = $valor;

						if ($_POST['sel_obra'] != "todos")
							$obrasocial = $_POST['sel_obra'];

						if ($valor != "" && strpos($practica, "coseguro") === false && $valor == $obrasocial) {

							$valor_coseguro = 0;
							$coseguro = $practica."_coseguro";

							if (isset($json->$coseguro) && $json->$coseguro != "")
								$valor_coseguro = $json->$coseguro;

							if (!isset($resume[$practica]))
								$resume[$practica] = (object) array('cantidad' => 0, 'subtot' => 0);

							$resume[$practica]->cantidad++;
							$resume[$practica]->subtot += $valor_coseguro;
							
							$debe = "";
							$practica_orden = $practica."_orden";

							if(count(json_decode($value->ordenes_pendientes,1))!=0 && $json_orden->$practica_orden != "")
								$debe = "SI";
							
							/*
								echo implode("\t",	array(	date('d-m-Y',strtotime($value->fecha)),
															$value->ficha,
															$value->paciente,
															$practica,
															$valor,
															$valor_coseguro
													)
											)."\n";		

							*/
														
								fputcsv($output, 	array(	date('d-m-Y',strtotime($value->fecha)),
													$value->ficha,
													$value->paciente,
													$practica,
													$valor,
													$valor_coseguro,
													$debe
												)

										,";"
								);
								
							
						}			

					}

				}
			}	

			fputcsv($output, array("","","","","","",""),";");
			fputcsv($output, array("Resumen","","","","","",""),";");
			fputcsv($output, array("Practica","Cantidad","Subtotal","","","",""),";");

			$total = 0;

			foreach ($resume as $practica=>$valor ) {
				$total += $valor->subtot;
				fputcsv($output, array($practica,$valor->cantidad,$valor->subtot,"","","",""),";");
			}
			
			fputcsv($output, array("Total","",$total,"","","",""),";");
			fclose($output);

		}
	}

	function print_facturacion($array) {

		$sel_obra = $array['sel_obra'];


		if ($array['fecha_desde'] == "" && $array['fecha_hasta'] == "")
			$fecha = "Histórico";
		else
			$fecha = $array['fecha_desde']." a ".$array['fecha_hasta'];

		if ($array['sel_medico_barra'] == "todos")
			$medico = "Todos";
		else
			$medico = "Dr. ".$this->main_model->get_medico_by_id($array['sel_medico_barra'])->nombre;

		if ($array['sel_atendido_barra'] == "Todas")
			$atendido = "Todas las Localidades";
		else
			$atendido = $array['sel_atendido_barra'];

		if ($array['sel_facturacion_barra'] == "Todas")
			$facturacion = "Todas las Localidades";
		else
			$facturacion = $array['sel_facturacion_barra'];

		if ($array['sel_obra'] == "todos")
			$obra = "Todas las Obras Sociales";
		else
			$obra = $array['sel_obra'];

		if ($array['sel_medico_barra'] == "todos")
			$medico = "Todos";
		else
			$medico = "Dr. ".$this->main_model->get_medico_by_id($array['sel_medico_barra'])->nombre;

		$html = "
			<style>
				table {
					font-size: 15px;
					border: 2px solid;
					border-collapse: collapse;
				}

				table td {
					border: 2px solid;
					text-align: center;
				}

				table th {
					border: 2px solid;
					font-weight: bold;
					font-size: 18px;
				}

				header table {
					border: none;
				}
			</style>
			<div style = 'text-align:center;font-size:20px;font-weight:bold;margin-bottom:50px'>
				Detalle de Prácticas
			</div>
			<div style = 'margin-bottom: 20px;width:100%;float:left;border-bottom:1px solid;padding-bottom:10px;font-size:18px'>
				<div style = 'float:left;width:100%'>
					<div style = 'float:left;width:100px;font-weight:bold'>Período:</div>
					<div style = 'float:left'>".$fecha."</div>
				</div>
				<div style = 'float:left;width:100%'>
					<div style = 'float:left;width:100px;font-weight:bold'>Medico:</div>
					<div style = 'float:left'>".$medico."</div>
				</div>
				<div style = 'float:left;width:100%'>
					<div style = 'float:left;width:100px;font-weight:bold'>Localidad:</div>
					<div style = 'float:left'>".$facturacion."</div>
				</div>
			</div>
			";		

			if ($array['resultado'] != null) {

				$html .= "<div style = 'float:left'>
				<div style = 'margin-bottom:5px;font-size:18px;font-weight:bold'>
					Detalle de pacientes con órdenes:
				</div>
				<div>
				<table>
					<th style = 'width:100px'>
						Fecha
					</th>
					<th style = 'width:100px'>
						Ficha
					</th>
					<th style = 'width:175px'>
						Paciente
					</th>
					<th style = 'width:100px'>
						Practica
					</th>
					<th style = 'width:300px'>
						Obra Social
					</th>
					<th style = 'width:100px'>
						Coseguro
					</th>
					<th style = 'width:50px'>
						Debe Orden
					</th>";

				foreach ($array['resultado'] as $value) {

					$json = json_decode($value->datos);
					$json_orden = json_decode($value->ordenes_pendientes);

					$mismo_turno = 0;
					$span = 0;

					foreach ($json as $practica=>$valor ) {
						
						if (strpos($practica,"_coseguro") === false && $valor != "")
							$span++;
					}	

					if($span!=0) {

    					$html .= "<tr style = 'border-top:1px solid;border-bottom:none'>";

    					foreach ($json as $practica=>$valor ) {

							$obrasocial = $valor;

							if ($sel_obra != "todos")
								$obrasocial = $sel_obra;

							if ($valor != "" && strpos($practica, "coseguro") === false && $valor == $obrasocial) {

								$valor_coseguro = 0;
								$coseguro = $practica."_coseguro";

								if (isset($json->$coseguro) && $json->$coseguro != "")
									$valor_coseguro = $json->$coseguro;

								if (!isset($resume[$practica]))
									$resume[$practica] = (object) array('cantidad' => 0, 'subtot' => 0);

								$resume[$practica]->cantidad++;
								$resume[$practica]->subtot += $valor_coseguro;
								
								$practica_orden = $practica."_orden";

								//if(count(json_decode($value->ordenes_pendientes,1))==0) {
								
								$ficha = $value->ficha;
								$paciente = $value->paciente;
								$medico = $value->medico;
								$fecha = date('d-m-Y',strtotime($value->fecha));
								$debe = "";
							
								if ($mismo_turno == 0) {
									$mismo_turno = 1;
									$html .= "<tr>
												<td rowspan = '".$span."'>".
													date('d-m-Y',strtotime($fecha)).
												"</td>
												<td rowspan = '".$span."'>".
													$ficha.
												"</td>
												<td rowspan = '".$span."'>".
													$paciente.
												"</td>";
								}
								else
									$html .= "<tr style = 'border:none'>";

								if(count(json_decode($value->ordenes_pendientes,1))!=0 && $json_orden->$practica_orden != "")
									$debe = "SI";
								
								$html .= 	"<td>".$practica."</td>
											<td>".$valor."</td>
											<td>".$valor_coseguro."</td>
											<td>".$debe."</td>";

								//}
							}
							$html .= "</tr>";
						}
    				}
				}

				$html .= "</table>
						</div>
					</div>";
			//}

				$html .= "<div style = 'float:left;width:100%;margin-top:10px'>";
				$html .= "<div style = 'font-size:18px;font-weight:bold;margin-bottom:5px'>Resumen:</div>";
				$html .= "<div>";
				$html .= "<table>
				<th>Práctica</th>
				<th>Cantidad</th>
				<th>Subtotal Coseg.</th>";
				$suma = 0;

				foreach ($resume as $key=>$valor) {
					$html .= "<tr>".
						"<td>".$key."</td>".
						"<td>".$valor->cantidad."</td>".
						"<td>".$valor->subtot."</td>".
					"</tr>";
					$suma += $valor->subtot;
				}
				$html .= "<tr>
						<td colspan = '2'></td>
						<td style = 'font-weight:bold;font-size:18px'>Total: ".$suma."</td>
					</tr>
				";
				$html .= "</table>
					</div>";
				$html .= "</div>";

			}

		return $html;
	}	

	function coordinacion($id) {

		$data['medicos'] = $this->main_model->get_medicos();
		$data['paciente'] = $this->main_model->buscar_id_paciente($id);
		$data['medico_seleccionado'] = $this->session->userdata('medico_seleccionado');
		$data['tipo_cirugias'] = $this->main_model->get_tipo_cirugias();
		$data['anestesias'] = $this->main_model->get_anestesias();
		//print_r($this->session->userdata);
		$this->load->view('coordinar_view',$data);
	}

	function proc_coordinacion() {

		$array = $_POST;
		$data['ok'] = "OK";
		
		$this->main_model->insert_datos_coord($array);

		
		$this->load->view('coordinar_view',$data);
	}

	function agenda_cirugias() {

		session_start();

		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['tipo_cirugia'] = $this->main_model->get_tipo_cirugias();
		$data['anestesias'] = $this->main_model->get_anestesias();

		//$data['medico_selected'] = $this->main_model->get_medico_by_id($_POST['sel_medico']);

		if (sizeof($_POST) != 0) {
			$_SESSION = $_POST;
		}	

		if (sizeof($_SESSION) != 0) {	

			$data = array_merge($_SESSION,$data);

			$data['resultado'] = $this->main_model->get_cirugias($data);
			$data['print'] = $this->print_cirugias($data['resultado']);	

		}

		$this->load->view('cirugias_view',$data);
	}

	function print_cirugias($resultado) {

	if ($resultado != null) {

		$html = "
		<style>
			table {
				font-size: 15px;
				border: 2px solid;
				border-collapse: collapse;
			}

			table td {
				border: 2px solid;
				text-align: center;
			}

			table th {
				border: 2px solid;
				font-weight: bold;
				font-size: 18px;
			}
		</style>	
				<div style = 'text-align:center;font-size:20px;margin-bottom:10px'>
					Cirugías ".date('d-m-Y',strtotime($resultado[0]->fecha_prop)).
				"</div>
				<div style = 'float:left'>
					<table>
						<th style = 'width:60px'>
							Hora
						</th>
						<th style = 'width:200px'>
							Paciente
						</th>
						<th style = 'width:175px'>
							Cirujano
						</th>
						<th style = 'width:30px'>
							Ojo
						</th>
						<th style = 'width:285px'>
							Practica
						</th>
						<th style = 'width:100px'>
							Detalle
						</th>
						<th style = 'width:150px'>
							Anestesia
						</th>
						<th style = 'width:300px'>
							Observaciones
						</th>";

				foreach ($resultado as $value) {
			$html .= "<tr>
						<td rowspan = '2'></td>
						<td rowspan = '2'>".
							$value->paciente.
						"</td>
						<td rowspan = '2'>Dr. ".
							$value->cirujano.
						"</td>";

							if ($value->practica_od != "") {
							$html .= "<td>OD</td>
								<td>".
									$value->practica_od.
								"</td>
								<td>".
									$value->detalle_od.
								"</td>
								<td>".
									$value->anestesia_od.
								"</td>";
							}
							else {
							$html .= "<td>OS</td>
								<td>".
									$value->practica_os.
								"</td>
								<td>".
									$value->detalle_os.
								"</td>
								<td>".
									$value->anestesia_os.
								"</td>";
							}
						$html .= "<td rowspan = '2'>"
							.$value->obs.
						"</td>
					</tr>
					<tr>";
						if ($value->practica_os != "" && $value->practica_od != "") {
							$html .= "<td>OS</td>
							<td>".
								$value->practica_os.
							"</td>
							<td>".
								$value->detalle_os.
							"</td>
							<td>".
								$value->anestesia_os.
							"</td>";
						}
					$html .= "</tr>";
				}
			$html .= "</table>
		</div>";
		
		}
		else
			$html = "";

		return $html;
	}

	function modificar_cirugia() {

		//session_start();
		$data = $_POST;

		//$data['obras'] = $this->main_model->get_obras();
		//$data['medicos'] = $this->main_model->get_medicos();
		//$data['tipo_cirugia'] = $this->main_model->get_tipo_cirugias();

		//$data['sel_obra_'] = $_POST['sel_obra_panel'];
		//$data['sel_practica_'] = $_POST['sel_practica_panel'];
		//$data['sel_medico_'] = $_POST['sel_medico_panel'];

		/*
		$data['obra_selected'] = $_POST['sel_obra'];
		$data['medico_selected'] = $_POST['sel_medico'];
		$data['fecha_desde'] = $_POST['fecha_desde'];
		$data['fecha_hasta'] = $_POST['fecha_hasta'];
		$data['practica_selected'] = $_POST['sel_practica'];*/

		//print_r($data);
		//$this->agenda_cirugias();

		$this->main_model->update_cirugia($_POST);
		redirect('main/agenda_cirugias/');
		//$this->load->view('cirugias_view',$data);	
	}

	function admin() {

		$data['resultado'] = $this->main_model->get_usuarios();
		//print_r($data['resultado']);
		$this->load->view('usuarios',$data);

	}

	function ingresar_usuario() {
		
		$this->main_model->crear_usuario($_POST);

		$funciones = implode(",",$_POST['funciones']);

		if (strpos($funciones,"Medico") !== false)
			$this->ingresar_medico($_POST);

		redirect('main/admin');
	}

	function ingresar_medico() {

		$this->main_model->add_medico($_POST);
		redirect('main/admin');

	}

	function resetear_usuario() {
		
		$this->main_model->reset_usuario($_POST);
		redirect('main/admin');
	}

	/************************************************************************************************************************
	*																														*
	*   						Metodos para consultar la BD de la Asociación Medica de Rosario				 				*
	*																														*
	*************************************************************************************************************************/

	function amr() {

		// if (isset($_POST['id_medico']) && $_POST['id_medico'] != "")
		// 	$data['obras'] = $this->get_all_os($_POST['id_medico']);
		// else
		// 	$data['obras'] = null;

		$data['medicos'] = $this->main_model->get_medicos();
		$data['localidades'] = $this->main_model->get_localidades();

		$this->load->view('amr_view',$data);
		
	}

	function get_all_os($id_medico, $depto) {

		//$id_medico = $_POST["id_medico"];
		//$depto = $_POST['depto'];

		if ($id_medico == null) {
			$id_medico = $this->main_model->get_default(); //Uso el medico por defecto en caso de tratar con un medico externo
		}	
		else if ($this->main_model->get_medico_by_id($id_medico) == null) {
			$id_medico = $this->main_model->get_default(); //Uso el medico por defecto en caso de tratar con un medico externo
		}
		else {

			//$medico = $this->main_model->get_medico_by_id($id_medico);
			//$key = $medico->key_ros;
			//$matricula = $medico->matricula;
		
			//$url = "https://amr.org.ar/gestion/webServices/valorizador/v2/obrasSociales?key=".$key."&codigoProfesionEfector=1&matriculaEfector=".$matricula;
			//$resultado['os'] = file_get_contents($url);

			//$url = "https://amr.org.ar/gestion/webServices/valorizador/v2/nomenclador?key=".$key."&codigoProfesionEfector=1&matriculaEfector=".$matricula;
			//$resultado['pr'] = file_get_contents($url);

			$resultado['os'] = $this->main_model->get_obras_sociales_medico($id_medico,$depto);
			$resultado['pr'] = $this->main_model->get_practicas_medico($id_medico);

			echo json_encode($resultado, JSON_HEX_QUOT);

		}	

	}

	// function get_all_amr() {

	// 	//$id = $_POST['id_medico'];

	// 	$key = $_POST['key'];
	// 	$matricula = $_POST['matricula'];
		
	// 	$url = "https://amr.org.ar/gestion/webServices/valorizador/v2/obrasSociales?key=".$key."&codigoProfesionEfector=1&matriculaEfector=".$matricula;
	// 	$resultado['os'] = file_get_contents($url);

	// 	$url = "https://amr.org.ar/gestion/webServices/valorizador/v2/nomenclador?key=".$key."&codigoProfesionEfector=1&matriculaEfector=".$matricula;
	// 	$resultado['pr'] = file_get_contents($url);

	// 	echo json_encode($resultado, JSON_HEX_QUOT);

	// }

	function valorizar() {

		$id_medico = $_POST["medico"];
		$id_obra = $_POST["sel_obra"];
		$id_practica = $_POST["sel_practica"];
		$periodo = $_POST["periodo"];

		if ($id_medico != null) {
			$medico = $this->main_model->get_medico_by_id($id_medico);
			$key = $medico->key_ros;
			$matricula = $medico->matricula;

			$url = "https://amr.org.ar/gestion/webServices/valorizador/v2/valorizar?key=".$key."&codigoProfesionEfector=1&matriculaEfector=".$matricula."&codigoObraSocial=".$id_obra."&periodo=".$periodo."&codigoNN=".$id_practica;
			$json_array = file_get_contents($url);
			$data['amr_data'] = json_decode($json_array,true);
			echo $url;
		}	
		else
			$data['amr_data'] = "";

		$this->load->view('amr_view',$data);
		
	}

	function completar_tabla($id_medico) {

		if ($id_medico != null) {
			$medico = $this->main_model->get_medico_by_id($id_medico);
			$key = $medico->key_ros;
			$matricula = $medico->matricula;
		
			$url = "https://amr.org.ar/gestion/webServices/valorizador/v2/obrasSociales?key=".$key."&codigoProfesionEfector=1&matriculaEfector=".$matricula;
			$res = file_get_contents($url);

			if ($res != False)
				$resultado['os'] = $res;
			else
				echo "Error al actualizar datos de obras sociales para medico ".$id_medico;

			$url = "https://amr.org.ar/gestion/webServices/valorizador/v2/nomenclador?key=".$key."&codigoProfesionEfector=1&matriculaEfector=".$matricula;
			$res = file_get_contents($url);


			if ($res != False)
				$resultado['pr'] = $res;
			else
				echo "Error al actualizar datos de practicas para medico ".$id_medico;

			$this->main_model->fill_tabla($resultado, $id_medico);
		}	

	}

	function get_pacientes() {

		$term = trim(strip_tags($_GET['term']));
		echo json_encode($this->main_model->get_pacientes($term));

	}

	function process() {
		//CAMBIAR NOMBRES DE LOS CAMPOS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! GUARDAR TAMBIEN LOS CAMBIOS EN EL TURNO!!!!

		$size = sizeof($_POST['medico_fact']);

		for ($i=0; $i < $size; $i++) {

			$practicas[$i] = array(
				"medico_fact" => $_POST['turno_data'][$i],
				"id_practica" => $_POST['turno_practica'][$i],
				"nombre_practica" => ($this->main_model->get_practica_by($_POST['practica'][$i]) != null ? $this->main_model->get_practica_by($_POST['turno_practica'][$i])->practica : ""), //$_POST['turno_nombre_practica'][$i], 
				"id_obra" => $_POST['turno_obra'][$i],
				"nombre_obra" => ($this->main_model->get_obra_by($_POST['obra'][$i]) != null ? $this->main_model->get_obra_by($_POST['turno_obra'][$i])->obra : ""), //$_POST['turno_nombre_obra'][$i],
				"nro_afiliado" => $_POST['turno_afiliado'][$i],
				"plus" => $_POST['turno_plus'][$i],
				"debe_plus" => $_POST['turno_debe_plus'][$i],
				"debe_ord" => $_POST['turno_debe_orden'][$i],
				"factura" => $_POST['turno_factura'][$i]
			);
		}

		$turno_info = array(
			"nombre" => $_POST['turno_nombre'],
			"apellido" => $_POST['turno_apellido'],
			"hora" => $_POST['turno_hora'],
			"citado" => $_POST['turno_citado'],
			"localidad" => $_POST['turno_localidad'], //agregar localidad a la tabla turno
			"medico" => $_POST['turno_medico'],
			"tel1" => $_POST['turno_tel11'].'-'.$_POST['turno_tel12'],
			"tel2" => $_POST['turno_tel21'].'-'.$_POST['turno_tel22'],
			"notas" => $_POST['turno_notas'],
			"practicas" => json_encode($practicas)
		);

		$facturacion_info = array(
			"paciente" => $_POST['turno_apellido'].', '.$_POST['turno_nombre'],
			"id_turno" => $_POST['turno_id'],
			"fecha_fact" => date('Y-m-d'), //strtotime($_POST['fecha'])),
			"localidad" => $_POST['turno_localidad'],
			"nro_factura" => $_POST['turno_nro_factura'],
			"tipo_factura" => $_POST['turno_tipo_factura'],
			"importe_factura" => $_POST['turno_importe_factura'],
			"practicas" => json_encode($turno)
		);

		// $data = array(
		// 	"paciente" => $_POST['datos_paciente'],
		// 	"ficha" => $_POST['datos_ficha'],
		// 	"id_paciente" => $_POST['datos_id_paciente'],
		// 	"id_turno" => $_POST['datos_id_turno'],
		// 	"fecha_fact" => date('Y-m-d'), //strtotime($_POST['fecha'])),
		// 	"fecha_turno" => date('Y-m-d',strtotime($_POST['datos_fecha_turno'])),
		// 	"lugar_atencion" => $_POST['lugar_atencion'],
		// 	"lugar_facturacion" => $_POST['lugar_facturacion'],
		// 	"medico_sol" => $_POST['turno_medico'],
		// 	"nro_factura" => $_POST['nro_factura'],
		// 	"importe_factura" => $_POST['importe_factura'],
		// 	"tipo_factura" => $_POST['tipo_factura'],
		// 	"turno" => json_encode($turno)
		// );

		$this->main_model->update_turno_2($turno_info);
		$this->main_model->update_facturacion_2($facturacion_info);

		redirect('main/cambiar_dia/'.date('Y-m-d',strtotime($_POST['turno_fecha_turno'])), 'location');
		//echo json_encode($data);
		//$this->load->view('amr_view',$data);

	}

	function get_info($id) {

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		// Hay que enviar todos los campos del formulario. Si no existen en la tabla seleccionada se deben crear como vacios

		// $facturacion = $this->main_model->get_facturacion_by_turno($id);

		// if ($facturacion != null) {

		// 	//$paciente = $this->get_datos_pacientes($facturacion->id_paciente);

		// 	$array['data_paciente'] = array(
		// 								"paciente" => $facturacion->paciente,
		// 								"ficha" => $facturacion->ficha,
		// 								"id_turno" => $facturacion->id_turno,
		// 								"id_paciente" => $facturacion->id_paciente,
		// 								"fecha_turno" => $facturacion->fecha_turno,
		// 								"fecha_fact" => $facturacion->fecha_fact,
		// 								"medico" => $facturacion->medico_turno,
		// 								"lugar_facturacion" => $facturacion->facturacion_localidad,
		// 								"lugar_atencion" => $facturacion->atendido_localidad,
		// 								"nro_factura" => $facturacion->nro_factura,
		// 								"tipo_factura" => $facturacion->tipo_factura,
		// 								"importe_factura" => $facturacion->importe_factura
		// 							);

		// 	$data = array();

		// 	foreach (json_decode($facturacion->datos) as $key => $value) {

		// 		array_push($data, array(
		// 			"medico_fact" => $value->medico_fact,
		// 			"practica" => $value->id_practica,
		// 			"nombre_practica" => $value->nombre_practica,
		// 			"obra" => $value->id_obra,
		// 			"nombre_obra" => $value->nombre_obra,
		// 			"nro_afiliado" => $value->nro_afiliado,
		// 			"plus" => $value->plus,
		// 			"debe_plus" => $value->debe_plus,
		// 			"debe_ord" => $value->debe_ord,
		// 			"factura" => $value->factura
		// 			)
		// 		);

		// 	}

		// 	$array['data_turno'] = $data;
		// }
		// else {

		// $localidad = "";
		$nro_factura = "";
		$tipo_factura = "";
		$importe_factura = "";

		// $facturacion = $this->main_model->get_facturacion_by_turno($id);

		// if ($facturacion != null) {

			// $localidad = $facturacion->facturacion_localidad;
		// 	$nro_factura = $facturacion->nro_factura;
		// 	$tipo_factura = $facturacion->tipo_factura;
		// 	$importe_factura = $facturacion->importe_factura;
			
		// }

		$turno = $this->main_model->get_turno_by($id);

		$array['data_turno'] = array(
									"paciente" => $turno->apellido.", ".$turno->nombre,
									"ficha" => $turno->ficha,
									"id_turno" => $turno->id,
									"id_paciente" => $turno->id_paciente,
									"fecha_turno" => $turno->fecha,
									"medico" => $turno->medico,
									"hora" => $turno->hora,
									"citado" => $turno->citado,
									"telefono" => $turno->tel1,
									"celular" => $turno->tel2,
									"localidad" => $turno->localidad,
									"nro_factura" => $nro_factura,
									"importe_factura" => $importe_factura,
									"tipo_factura" => $tipo_factura
								);

		$data = array();

		foreach (json_decode($turno->tipo) as $key => $value) {

			array_push($data, array(
				"medico_fact" => $value->medico_fact, //Cambiado por $turno->medico
				"practica" => $value->id_practica,
				"nombre_practica" => $value->nombre_practica,
				"obra" => $value->id_obra,
				"nombre_obra" => $value->nombre_obra,
				"nro_afiliado" => "",
				"plus" => "",
				"debe_plus" => "",
				"debe_ord" => "",
				"factura" => ""
				)
			);

		}

		$array['data_practicas'] = $data;	
	//}
		echo json_encode($array);

	}

	function show_edit_dialog() {

		$data['medicos'] = $this->main_model->get_medicos();
		$data['localidades'] = $this->main_model->get_localidades();
		$this->load->view('amr_view',$data);
	}

}


?>
