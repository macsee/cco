<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
public function __construct()
{
   parent::__construct();
}

public function index()
{
  if( !empty( $_GET['file'] ) )
    {
      // check if user is logged
      if($this->session->userdata("is_logged_in"))
      {
            
        $array = explode("/",$_GET['file']);
        $filePath = $_SERVER['DOCUMENT_ROOT'];
        $fileName = $array[sizeof($array)-1];
        $localFilePathName = $filePath.$_GET['file'];
        
        $ext = pathinfo($fileName)['extension'];

        if ($ext == "pdf") {
          header('Content-Type: application/pdf');
        }
        else {
          header('Content-Type: image/'.$ext);
        }
        echo file_get_contents($localFilePathName);

      }else{
        redirect('error_auth');
        }
    }
}
}