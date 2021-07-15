<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){

		parent::__construct(); 

		$this->load->model("index_model");
		$this->load->model("admin_model");
		$this->load->model("home_model"); 
	}

	public function load_first()
		{
			$module = array();
			$module['reset_password'] = 0;

			$result = $this->admin_model->load_company_info();
			$module['company_info'] = $result['company_info'];

			$this->load->view('login',$module);
		}

	public function validate_login(){
		$this->form_validation->set_rules('username','Username','required|max_length[225]');
		$this->form_validation->set_rules('password','Password','required|max_length[225]');
		if($this->form_validation->run() == TRUE){ 

				$result = $this->index_model->validate_login();

				if($result['success']==TRUE){ 
 					
					$account_data = array(
					        'user_id'  		  => $result['user_id'],
					        'user_category'   => $result['user_category'],
					        'name_of_user'    => $result['name_of_user'],
					        'email' 	      => $result['email'],
					        'avatar' 	      => $result['avatar'],
					        'username'  	  => $this->input->post("username",TRUE), 
					        'datetime'     	  => sdatetime,
					        'logged_in' 	  => TRUE
					);

					// $account_data = serialize($account_data);
					//$Openssl_security = new Openssl_security;
					//$account_data = $Openssl_security->e($account_data, $this->config->item('openssl_key') );  

					$this->session->set_userdata($account_data);

					$this->session->set_flashdata("success","login success, welcome ".$result['name_of_user']);

					 
						/* AUDIT TRAIL */
						$log_module = "login page";
						$log_description = "login to account.";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);
						  
						 
					redirect("home/dashboard","refresh");
						//$this->load->view('admin/index');

				}else{

					$this->session->set_flashdata("error","invalid username/password.");

				}

				if($result['success']==FALSE){ 
					$this->load_first();
				}

		}

		
		

	}

	public function send_reset_password(){

		$this->form_validation->set_rules('email','email','required|max_length[225]');
		$this->form_validation->set_rules('ut','user type','required|max_length[225]');

		if($this->form_validation->run() == TRUE){ 

			$this->load->library('email');

			$email_to = $this->input->post('email');
			$user_type = $this->input->post('ut'); 

				$result = $this->admin_model->check_admin_email();
				$module['result'] = $result['result']; 
 

			if($module['result']){

				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
				$key = substr(str_shuffle($permitted_chars), 0, 30);

				$this->admin_model->save_reset_password($email_to,$user_type,$key);

						$result = $this->home_model->load_settings();
						$module['settings'] = $result['settings']; 
				 		$from = $module['settings']->system_email; 

				$this->email->from($from, system_name);
				$this->email->to($email_to);  

				$this->email->subject('Reset Password');
				$this->email->message("Reset My password. Click the link : ".base_url()."index/reset/".$key." to reset password.");

				$this->email->send(); 

				$this->session->set_flashdata("success","Reset link sent to your email.");

			}else{

				$this->session->set_flashdata("error","Invalid email.");

			}

		}

		$this->load_first();

	}

	public function reset($key=null){

		$module = array();

		if($key){
		$result = $this->admin_model->reset_password($key); 

	    	if($result->id){ 

	    		$module['reset_password'] = 1;
	    		$module['key'] = $key;

	    	}else{
	    		$this->session->set_flashdata("error","Invalid reset password request.");
	    	}

		}

		$this->load->view('login',$module);

	}

	public function reset_password($key){

		$this->form_validation->set_rules('password1','new password','required|min_length[5]|max_length[225]');
		$this->form_validation->set_rules('password2','re-type password','required|min_length[5]|max_length[225]|matches[password1]');

		if($this->form_validation->run() == TRUE){

			$result = $this->admin_model->save_reset_password_key($key); 

			$this->session->set_flashdata("success","password successfuly updated.");

			$module['reset_password'] = 0;

			$this->load->view('login',$module);

		}else{

			$this->session->set_flashdata("error","Invalid new password.");

			$module['reset_password'] = 1;
			$module['key'] = $key;

			$this->load->view('login',$module);

		}

	}

}
