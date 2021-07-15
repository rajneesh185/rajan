<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Session_check { 

    function check_account_session($ses)
    {

		if(!isset($ses)){
					
					$module['module'] = "login";
					//$this->session->get_flashdata("error","You need to be login first.");
					redirect("index/load_first","refresh");
					//$this->load->view('index/load_first',$module);		
		}

	}

}


