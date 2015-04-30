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
		//$calendar_anio = $this->uri->segment(4);
		//$calendar_mes = $this->uri->segment(5);
		$medico_seleccionado = $this->session->userdata('medico_seleccionado');

		/*
		if (!isset($medico_seleccionado)) {
			$this->session->set_userdata('medico_seleccionado', 0);
			$medico_seleccionado = 0;
		}	
		*/

		$medico = $this->main_model->get_medico_by_id($medico_seleccionado);
		//$medico = $this->main_model->get_medico_by_id($this->main_model->getSelectedMedico()->valor);
		$aux = explode('-',$dia);
		$calendar_anio = $aux[0];
		$calendar_mes = $aux[1];
		$data['fecha'] = $dia;
		$data['filas'] = $this->main_model->get_turnos($dia,$medico);
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
		$data['calendario'] = $this->main_model->create_calendar($calendar_anio, $calendar_mes);
		$data['medicos'] = $this->main_model->get_medicos();
		$data['medico_selected'] = $medico_seleccionado;
		$data['obras'] = $this->main_model->get_obras();
		$this->load->view('main_view', $data);
	}
	
	function nuevo_paciente()
	{
		$resultado = $this->main_model->obtener_ultima_ficha();
		$data['ficha'] = ($resultado->nroficha) + 1;
		$data['nombre'] = $_POST['nombre'];
		$data['apellido'] = $_POST['apellido'];
		$data['obra'] = $_POST['obra'];
		$data['fecha'] = $_POST['fecha_turno'];

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
		$data['nombre'] = $filas[0]->nombre;
		$data['fecha'] = $filas[0]->fecha;
		$data['apellido'] = $filas[0]->apellido;
		$data['obra'] = $filas[0]->obra_social;

		$aux_tel = explode ('-',$filas[0]->tel1);
		$data['tel1_1'] = $aux_tel[0]; 
		$data['tel1_2'] = $aux_tel[1];

		if ($filas[0]->tel2 <> "") {
			$aux_tel = explode ('-',$filas[0]->tel2);
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
		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['medico_seleccionado'] = $this->main_model->get_medico_by_id($this->session->userdata('medico_seleccionado'));
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
		redirect('main/cambiar_dia/'.$_POST['fecha'].'#'.$_POST['hora'].':'.$_POST['minutos'], 'location');
		//$this->load->view('nuevo_turno_exito');
	}
	
	function editar_turno($id)
	{

		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['filas'] = $this->main_model->get_turno_by($id);
		
		$aux = $data['filas'][0]->fecha;
		$aux2 = $data['filas'][0]->hora;
				
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
		redirect('main/cambiar_dia/'.$_POST['fecha'].'#'.$_POST['hora'], 'location');
		//$this->load->view('nuevo_turno_exito');
	}
	
	function borrar_turno($id)
	{
		$data = $this->main_model->get_turno_by($id);
		$hora = date('H:i', strtotime($data[0]->hora));
		$this->main_model->delete_turno($id);
		redirect('main/cambiar_dia/'.$data[0]->fecha.'#'.$hora, 'location');
	}

	function cambiar_turno($fecha, $hora, $minuto)
	{
		$data['fecha'] = $fecha;
		$data['hora'] = $hora.':'.$minuto;
		$data['id'] = $this->get('id');
		$data['nombre_turno'] = $this->get('nombre');
		$data['apellido_turno'] = $this->get('apellido');
		$this->main_model->cambiar_turno($data);
		redirect('main/cambiar_dia/'.$fecha.'#'.$data['hora'], 'location');
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
		redirect('main/cambiar_dia/'.$fecha.'#'.$hora.':'.$minuto, 'location');
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
		redirect('main/cambiar_dia/'.$fecha.'#'.$hora.':'.$minuto, 'location');
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
		$this->load->view('pacientes_home', $data);
	}


	function pro_ingresar_paciente() {
		$this->main_model->ingresar_paciente($_POST);
		redirect('main/pacientes/', 'location');
	}

	function pro_nuevo_paciente()
	{	
		//print_r($_POST);
		$data['ficha'] = $this->main_model->check_ficha($_POST['ficha']);
		$data['nroficha'] = $_POST['ficha'];
		$data['paciente'] = $this->main_model->check_nombre_apellido($_POST['nombre'], $_POST['apellido']);

		if ($data['paciente'] == 0) {
			if ($data['ficha'] == 0	) {
				
				$this->main_model->ingresar_paciente($_POST);
				redirect('main/pacientes/', 'location');

			}
			else {
				$data['value'] = 'error ficha';
				$this->load->view('paciente_error',$data);
			}
		}
		else {
			$data['value'] = 'error paciente';
			$this->load->view('paciente_error',$data);
		}
		//$this->load->view('nuevo_turno_exito');
	}

	function pro_edit_paciente() {

		$this->main_model->actualizar_paciente($_POST);
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

		$fecha_sql =  date('Y-m-d');
		$fecha =  date('dmY');
		$tipo = $_POST['tipo'];
		$id_paciente = $_POST['paciente'];

		$dir = "C:\\xampp\\htdocs\\cco\\data\\".$_POST['paciente']; 

		if (!is_dir($dir)) {
			mkdir($dir);
		}

		$count = 0;

		foreach ($_FILES['userfile']['name'] as $fieldName => $file) {

			$contador_archivo = 1;

			$extension = explode('.', $file);
			$extension = ".".$extension[sizeof($extension)-1];

			/*$name = $this->formatear($file, $tipo, $id_paciente);
			$name_extension = $name.$extension;
			$name_aux = $name;

			while (file_exists($dir.'\\'.$name_extension)) {

				$name_aux =$name.'-'.$contador_archivo;
				$name_extension = $name_aux.$extension;
				$contador_archivo++;
			}*/
			$date = (new DateTime())->format('U');
			$imagen = $tipo.'-'.$fecha.'-'.$date;
			$name_extension = $tipo.'-'.$id_paciente.'-'.$fecha.'-'.$date.$extension;
		
    		move_uploaded_file($_FILES['userfile']['tmp_name'][$count], "$dir/$name_extension");
    		//$count++;

    		$array['id_paciente'] = $id_paciente;
			$array['tipo'] = $tipo;
			$array['fecha'] = $fecha_sql;
			$array['imagen'] = $imagen;
			$array['ruta'] = base_url('data/'.$id_paciente.'/'.$name_extension);
			$this->main_model->ingresar_estudios($array);

		}
		$data['url'] = base_url('index.php/main/historia_clinica/'.$id_paciente);
		$this->load->view('upload_msg', $data);

		//redirect('main/cambiar_dia/'.$resultado->fecha, 'location');
		//header('Refresh: 1; url='.base_url('index.php/main/historia_clinica/'.$_POST['paciente']));

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
			$data['borrador_antecedente'] = json_decode($borrador_antecedente->data)->antecedente;
		
		$data['paciente_id'] = $id;
		$this->load->view('view_historia', $data);
	}

	function load_hc_form($id) {
		$data['paciente'] = $id;

		$borrador_registro = $this->main_model->get_borrador($id,"registro");

		if (empty($borrador_registro))
			$data['borrador_registro'] = "";
		else
			$data['borrador_registro'] = $borrador_registro->data;

		//$data['diagnosticos'] = $this->main_model->get_diagnosticos();
		$this->load->view('form_hc',$data);
	}

	function submit_data($tipo) { 
		$data['fecha'] = date('Y-m-d H:i:s',time());

		if ($tipo == "registro") {
			$test = str_replace(array('"',']','['),"", $_POST['txt_diag']);
			$test = str_replace(',', ', ', $test);
			$_POST['txt_diag'] = $test;
		}
			
		$data['text'] = json_encode($_POST,JSON_UNESCAPED_UNICODE);
		$data['tipo'] = $tipo;
		$data['id_paciente'] = $_POST['paciente'];
		$data['medico'] = $this->session->userdata('apellido').', '.$this->session->userdata('nombre');

		$this->main_model->insert_record($data);

		
		//$this->main_model->delete_borrador($data);

		redirect('main/historia_clinica/'.$_POST['paciente']);
	}
	
	function guardar_borrador($tipo) {

		//$data['fecha'] = date('Y-m-d H:i:s',time());
		if ($tipo == "registro") {
			$test = str_replace(array('"',']','['),"", $_POST['txt_diag']);
			$test = str_replace(',', ', ', $test);
			$_POST['txt_diag'] = $test;
		}
		$data['text'] = json_encode($_POST,JSON_UNESCAPED_UNICODE);
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

		$data['tipo_user'] = $this->session->userdata('grupo');
		$data['medico_selected'] = $medico_selected;

		$medico = $this->main_model->get_medico_by_id($medico_selected);
		$data['filas'] = $this->main_model->get_pacientes_admitidos($fecha,$medico,$data['tipo_user']);

		$array = $this->translate($fecha);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];
		
		$this->load->view('pacientes_ok',$data);
	}

	function add_to_facturacion($fecha) {

		$test = str_replace(array('"',']','['),"", $_POST['chk_turno']);
		$test = str_replace(',', ', ', $test);
		$array_turno = implode(", ", $test);

		$medico = $this->main_model->get_medico_by_id($_POST['sel_medico']);
		$this->main_model->update_tipo_turno($_POST['id_turno'],$array_turno, $medico, $_POST['sel_estado']);

		$array_fact['cvc'] = (strpos(strtolower($array_turno),'cvc') >= 0)? $_POST['sel_cvc'] : "";
		$array_fact['iol'] = (strpos(strtolower($array_turno),'iol') >= 0) ? $_POST['sel_iol'] : "";
		$array_fact['me'] = (strpos(strtolower($array_turno),'me') >= 0) ? $_POST['sel_me'] : "";
		$array_fact['oct'] = (strpos(strtolower($array_turno),'oct') >= 0) ? $_POST['sel_oct'] : "";
		$array_fact['topo'] = (strpos(strtolower($array_turno),'topo') >= 0) ? $_POST['sel_topo'] : "";
		$array_fact['rfgc'] = (strpos(strtolower($array_turno),'rfgc') >= 0) ? $_POST['sel_rfgc'] : "";
		$array_fact['rfg'] = (strpos(strtolower($array_turno),'rfg') >= 0) ? $_POST['sel_rfg'] : "";
		$array_fact['yag'] = (strpos(strtolower($array_turno),'yag') >= 0) ? $_POST['sel_yag'] : "";
		$array_fact['laser'] = (strpos(strtolower($array_turno),'laser') >= 0) ? $_POST['sel_laser'] : "";
		$array_fact['obi'] = (strpos(strtolower($array_turno),'obi') >= 0) ? $_POST['sel_obi'] : "";
		$array_fact['paqui'] = (strpos(strtolower($array_turno),'paqui') >= 0) ? $_POST['sel_paqui'] : "";
		$array_fact['hrt'] = (strpos(strtolower($array_turno),'hrt') >= 0) ? $_POST['sel_hrt'] : "";
		$array_fact['consulta'] = (strpos(strtolower($array_turno),'consulta') >= 0) ? $_POST['sel_consulta'] : "";

		$array_fact['cvc_coseguro'] = $_POST['coseguro_cvc'];
		$array_fact['iol_coseguro'] = $_POST['coseguro_iol'];
		$array_fact['me_coseguro'] = $_POST['coseguro_me'];
		$array_fact['oct_coseguro'] = $_POST['coseguro_oct'];
		$array_fact['topo_coseguro'] = $_POST['coseguro_topo'];
		$array_fact['rfgc_coseguro'] = $_POST['coseguro_rfgc'];
		$array_fact['rfg_coseguro'] = $_POST['coseguro_rfg'];
		$array_fact['yag_coseguro'] = $_POST['coseguro_yag'];
		$array_fact['laser_coseguro'] = $_POST['coseguro_laser'];
		$array_fact['obi_coseguro'] = $_POST['coseguro_obi'];
		$array_fact['paqui_coseguro'] = $_POST['coseguro_paqui'];
		$array_fact['hrt_coseguro'] = $_POST['coseguro_hrt'];
		$array_fact['consulta_coseguro'] = $_POST['coseguro_consulta'];

		if (isset($_POST['chk_ord']))
			$array_fact['orden_pendiente'] = implode(", ",$_POST['chk_ord']);

		

		$this->main_model->update_facturacion($_POST['id_turno'], json_encode($array_fact), $medico);

		redirect('main/cambiar_dia/'.$fecha);
	}

	function facturacion() {
		
		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();

		if (sizeof($_POST) != 0) {
			$data['resultado'] = $this->main_model->buscar_facturacion($_POST['sel_obra'], $_POST['sel_medico'], $_POST['sel_localidad'], $_POST['fecha_desde'], $_POST['fecha_hasta']);
			$data['obra_selected'] = $_POST['sel_obra'];
			$data['localidad_selected'] = $_POST['sel_localidad'];
			$data['medico_selected'] = $_POST['sel_medico'];
			$data['fecha_desde'] = $_POST['fecha_desde'];
			$data['fecha_hasta'] = $_POST['fecha_hasta'];
		}

		$this->load->view('facturacion_view',$data);		
	}
}


?>
