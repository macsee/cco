<?php

class Session_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function do_login($user,$pass){
		
		$query = $this->db->query("SELECT * FROM usuarios WHERE user = '$user' AND password = '$pass'");
		
		if ($query->num_rows()>0)
			return $query->row();
		else
			return null;
	}
}	