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
		$query = $this->session_model->do_login($_POST['user'],$_POST['password']);

		if ($query != null) {
			$data = array(
				'user' => $_POST['user'],
				'nombre' => $query->nombre,
				'apellido' => $query->apellido,
				'grupo' => $query->grupo,
				'id_user' => $query->id_user,
				'is_logged_in' => true
			);
			
			if ($query->grupo == "Medico")
				$this->session->set_userdata('medico_seleccionado', $query->id_user);
			else
				$this->session->set_userdata('medico_seleccionado', "todos");

			$this->session->set_userdata($data);
			redirect('main/index');
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

}