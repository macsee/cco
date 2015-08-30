<?php

/**
* 
*/
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('session_model');
	}
	
	function index() {

		$this->load->view('login_view');
		
		/*
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (isset($is_logged_in) && $is_logged_in == true)
			redirect('main/index');
		*/	
	}

	function conectar() {
		$this->manage_login($_POST['user'],$_POST['password']);
	}

	function manage_login($user, $password) {
		$query = $this->session_model->do_login($user,$password);

		if ($query != null) {
			
			if ($query->last_login == null) {

				$data['user'] = $user;
				$data['password'] = $password;
				$this->load->view('reset_view',$data);

			}
			else {
				/*
				$data['user'] = "Macsee";
				$data['nombre'] = "Maxi";
				$data['apellido'] = "Crav";
				$data['grupo'] = "Tecnico";
				$data['id_user'] = "macseec";
				*/
				$data['user'] = $user;
				$data['nombre'] = $query->nombre;
				$data['apellido'] = $query->apellido;
				$data['funciones'] = $query->funciones;
				$data['id_user'] = $query->id_user;
				
				$this->set_credentials($data);

				$this->session_model->set_last_login($user);
				redirect('main/index');

			}	
		}
		else {

			$data['login_incorrecto'] = true;
			$this->load->view('login_view',$data);
			//redirect('login');
		}	
	}

	function desconectar() {

		$is_logged_in = $this->session->userdata('is_logged_in');

		if (isset($is_logged_in) && $is_logged_in == true) {
			$this->session->sess_destroy();
			redirect('login');
		}
			
	}

	function set_credentials($array) {

		$data = array(
			'user' => $array['user'],
			'nombre' => $array['nombre'],
			'apellido' => $array['apellido'],
			'funciones' => $array['funciones'],
			'id_user' => $array['id_user'],
			'is_logged_in' => true
		);
		
		if (strpos($data['funciones'], "Medico") !== false )
			$this->session->set_userdata('medico_seleccionado', $array['id_user']);
		else
			$this->session->set_userdata('medico_seleccionado', "todos");

		$this->session->set_userdata($data);
	}

	function reset_password() {

		$this->session_model->reset($_POST['user'],$_POST['pass']);
		$this->manage_login($_POST['user'], $_POST['pass']);

	}

}