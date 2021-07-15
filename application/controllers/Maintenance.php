<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {
 
	var $system_menu = array(); 

	public function __construct(){

		parent::__construct();  
 
		$this->load->model("home_model");
		$this->load->model("admin_model");
		$this->load->model("maintenance_model");

		$result = $this->admin_model->load_index_data();
		$this->system_menu['main_menu'] = $result['main_menu'];
		$this->system_menu['sub_menu'] = $result['sub_menu'];  
		$this->system_menu['index_user_roles'] = $result['index_user_roles'];
		$this->system_menu['settings'] = $result['settings']; 
		$this->system_menu['avatar'] = $result['avatar']; 
		$this->system_menu['company_info'] = $result['company_info']; 


		/* check session if valid $this->load->helper("accountsession"); */
 		$accountsession = new Session_check();
		$accountsession->check_account_session($this->session->user_id);
		
	}

	public function table($table_name){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$module = $this->system_menu;
		$table_name = str_replace("fm_","",$table_name);

		$module["table_name"] = ucwords (str_replace("_"," ",$table_name));
		$table_name_sql = 'fm_'.$table_name;

		$result = $this->maintenance_model->load_table_data($table_name_sql);
		$module['table_data'] = $result['table_data'];
		$module['table_name_sql'] = $table_name_sql;

		$module['module'] = "maintenance/main_table";
		$module['map_link']   = "maintenance > $table_name"; 

		if($table_name == 'brick_type'){ 

			$result = $this->admin_model->load_filemaintenance('fm_wash_process');
			$module['wash_process'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_brick_type');
			$module['brick_type'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_category');
			$module['user_category'] = $result['maintenance_data'];

			$result = $this->admin_model->load_system_users();
			$module['system_users'] = $result['system_users'];

		}elseif($table_name=='wash_process'){

			$result = $this->admin_model->load_filemaintenance('fm_chemicals');
			$module['chemicals'] = $result['maintenance_data'];

		}

		$this->load->view('admin/index',$module);

	}

	public function add_table_data_content($table_name){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$module['table_name'] = $table_name;

		if($table_name == 'fm_brick_type'){ 

			$result = $this->admin_model->load_filemaintenance('fm_wash_process');
			$module['wash_process'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_brick_type');
			$module['brick_type'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_category');
			$module['user_category'] = $result['maintenance_data'];

			$result = $this->admin_model->load_system_users();
			$module['system_users'] = $result['system_users'];

		}elseif($table_name=='fm_wash_process'){

			$result = $this->admin_model->load_filemaintenance('fm_chemicals');
			$module['chemicals'] = $result['maintenance_data'];

		}

		$this->load->view('admin/maintenance/add_table_data_content',$module);

	}

	public function edit_table_data_content($table_name,$id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->maintenance_model->load_table_data_one($table_name,$id);
		$module['table_data'] = $result['table_data']; 

		if(!$module['table_data']){ die('record not found.');}

		if($table_name == 'fm_brick_type'){ 

			$result = $this->admin_model->load_filemaintenance('fm_wash_process');
			$module['wash_process'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_brick_type');
			$module['brick_type'] = $result['maintenance_data'];

			$result = $this->admin_model->load_filemaintenance('fm_category');
			$module['user_category'] = $result['maintenance_data'];


			$result = $this->admin_model->load_system_users();
			$module['system_users'] = $result['system_users'];

		}elseif($table_name=='fm_wash_process'){

			$result = $this->admin_model->load_filemaintenance('fm_chemicals');
			$module['chemicals'] = $result['maintenance_data'];

		}

		$module['table_name'] = $table_name;
		$this->load->view('admin/maintenance/edit_table_data_content',$module);

	}

	public function add_new_table_data($table_name){  

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}
 		
 		$this->form_validation->set_rules('title','Title','trim|required|callback_check_title_duplication'); 
 		$this->form_validation->set_message('check_title_duplication', 'Title already Exist.');

		if($this->form_validation->run() == true){

			$result = $this->maintenance_model->add_table_data($table_name); 

			if($result["result"] == true){ 

				$table_name_mod = str_replace("fm_","",$table_name);
				$table_name_mod = str_replace("_"," ",$table_name_mod);

				/* AUDIT TRAIL */
				$log_module = "file maintenance > $table_name_mod > add new data";
				$log_description = "add new data in $table_name_mod maintenance table, id : ".$result["inserted_id"];
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","data added to the table"); 
		 		$table_name = str_replace("fm_","",$table_name);
		 		redirect("maintenance/table/$table_name","refresh"); 
			}else{
				$this->session->set_flashdata("error","error saving information"); 
			}

		}

		$this->table($table_name);

	}


	function check_title_duplication(){ 

			return $this->maintenance_model->check_title_duplication_validation(); 
	}


	public function update_table_data($table_name,$id){ 

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}
 		
 		$this->form_validation->set_rules('title','Title','trim|required|callback_check_title_duplication_update['.$table_name.','.$id.']'); 
 		$this->form_validation->set_message('check_title_duplication_update', 'Title already Exist.');

		if($this->form_validation->run() == true){

			$result = $this->maintenance_model->update_table_data($table_name,$id); 

			if($result == true){ 

				$table_name_mod = str_replace("fm_","",$table_name);
				$table_name_mod = str_replace("_"," ",$table_name_mod);

				/* AUDIT TRAIL */
				$log_module = "file maintenance > $table_name_mod > update data";
				$log_description = "update data in $table_name_mod , id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","data successfully updated"); 
		 		$table_name = str_replace("fm_","",$table_name);
		 		redirect("maintenance/table/$table_name","refresh");  
			}else{
				$this->session->set_flashdata("error","error saving information"); 
			}

		}

		$this->table($table_name);

	}

	function check_title_duplication_update($var,$data){  
		list($table_name,$id) = explode(",", $data);
		return $this->maintenance_model->check_title_duplication_validation_update($table_name,$id); 
	}

	public function delete_data($table_name,$id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->maintenance_model->delete_table_data($table_name,$id); 

			if($result == true){ 

				$table_name_mod = str_replace("fm_","",$table_name);
				$table_name_mod = str_replace("_"," ",$table_name_mod);

				/* AUDIT TRAIL */
				$log_module = "file maintenance > $table_name_mod > delete data";
				$log_description = "delete data in $table_name_mod , id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","data deleted"); 
		 		$table_name = str_replace("fm_","",$table_name);
		 		redirect("maintenance/table/$table_name","refresh"); 
			}else{
				$this->session->set_flashdata("error","error deleting information"); 
			}

	}

}