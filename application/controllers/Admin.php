<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	var $system_menu = array(); 

	public function __construct(){

		parent::__construct(); 
  
 		
		$this->load->model("admin_model");
		$result = $this->admin_model->load_index_data();
		$this->system_menu['main_menu'] = $result['main_menu'];
		$this->system_menu['sub_menu'] = $result['sub_menu']; 
		$this->system_menu['company_info'] = $result['company_info']; 


		/* check session if valid $this->load->helper("accountsession"); */
 		$accountsession = new Session_check();
		$accountsession->check_account_session($this->session->user_id);
		
	} 

	public function side_bar_menu(){
		$result = $this->admin_model->load_index_data();
		$module['main_menu'] = $result['main_menu'];
		$module['sub_menu'] = $result['sub_menu'];
		return $module;
	}

	public function home(){
		
		$module = $this->system_menu;

		$module['module'] = "home";
		$module['map_link']   = "home";  

		$this->load->view('admin/index',$module);
		/*
		$this->dashboard();
*/
	}

	public function dashboard(){

		$module = $this->system_menu;

		$module['module'] = "dashboard";
		$module['map_link']   = "dashboard"; 

		$this->load->view('admin/index',$module);

	}

	public function system_users(){

		$module = $this->system_menu;

		$module['module'] = "system_users";
		$module['map_link']   = "system_users"; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		/*
		$result = $this->admin_model->load_user_roles($id);
		$module['user_roles'] = $result['user_roles'];
		*/

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data'];
 

		$this->load->view('admin/index',$module);

	} 

	public function logout()
	{	
		if($this->session->user_type == 'employee'){ 
		/* AUDIT TRAIL */
		$log_module = "account page";
		$log_description = "logout to account.";
		$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);
		}
		
		$this->session->unset_userdata('user_id','name_of_user','account','username','datetime','logged_in','user_type','emp_id');
		redirect("index/load_first","refresh");  
	}

	

}