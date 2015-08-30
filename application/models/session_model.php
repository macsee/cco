<?php

class Session_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function do_login($user,$pass){

		$key = $this->config->item('encryption_key');

		$query = $this->db->query("SELECT 
									CONVERT(AES_DECRYPT(user, '$key') USING 'utf8') user,
									CONVERT(AES_DECRYPT(nombre, '$key') USING 'utf8') nombre,
									CONVERT(AES_DECRYPT(apellido, '$key') USING 'utf8') apellido,
									CONVERT(AES_DECRYPT(funciones, '$key') USING 'utf8') funciones,
									id_user,
									last_login					
									FROM usuarios WHERE AES_DECRYPT(user, '$key') = '$user' AND AES_DECRYPT(password, '$key') = '$pass'"
								);
		
//		$query = $this->db->query("SELECT * FROM usuarios WHERE user = '$user' AND password = '$pass'");
		
		if ($query->num_rows()>0) {
			$result = $query->row();
			return $result;
		}	
		else
			return null;
	}

	function set_last_login($user) {

		$key = $this->config->item('encryption_key');
		$where = "user = '".$user."'";
		$data['last_login'] = date('Y-m-d H:i');
		$last_login = date('Y-m-d H:i');

		$this->db->query("UPDATE usuarios SET 	last_login = '$last_login'
									WHERE AES_DECRYPT(user, '$key') = '$user'" 
						);

//		$str = $this->db->update_string('usuarios', $data, $where);
//		$this->db->query($str);

	}

	function reset($user,$password) {

		$key = $this->config->item('encryption_key');
		$where = "user = '".$user."'";
		$data['last_login'] = date('Y-m-d H:i');
		$data['password'] = $password;
		$last_login = date('Y-m-d H:i');

		$this->db->query("UPDATE usuarios SET 	password = AES_ENCRYPT('$password','$key'),
												last_login = '$last_login'
									WHERE AES_DECRYPT(user, '$key') = '$user'" 
						);

//		$str = $this->db->update_string('usuarios', $data, $where);
//		$this->db->query($str);

	}	
}	