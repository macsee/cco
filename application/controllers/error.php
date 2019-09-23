<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class error extends CI_Controller
{
public function __construct()
{
   parent::__construct();
}

public function index()
{
	$data['title'] = "Error";
	$data['heading'] = "No Autorizado";
	$data['message'] = 'Por Favor <a href="'.base_url('login').'">Iniciar Sesión</a> Para Poder Visualizar Este Archivo:';
	$this->load->view("error_404", $data);
}

}