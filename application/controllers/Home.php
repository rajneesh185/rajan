<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	var $system_menu = array(); 

	public function __construct(){

		parent::__construct();  

 
		$this->load->model("home_model");
		$this->load->model("admin_model");   

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

	}

	public function dashboard($filter=null){

		$module = $this->system_menu;

		if(strtolower($this->session->user_category) == 'cleaner'){
			$module['module'] = "home/dashboard_cleaner";
		}else{
			$module['module'] = "home/dashboard";
		} 
		$module['map_link']   = "home > dashboard"; 

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_invoice_jobs();
		$module['invoice_jobs'] = $result['invoice_jobs']; 

		$result = $this->admin_model->load_all_raised_issue();
		$module['raised_issue'] = $result['raised_issue'];
 		
 		$module['filter'] = $filter;
		

		$this->load->view('admin/index',$module);  

	}

	public function company_info(){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$module = $this->system_menu;

		$module['module'] = "home/company_info";
		$module['map_link']   = "home > company_info";  

		$result = $this->admin_model->load_company_info();
		$module['company_info'] = $result['company_info'];
 

		$this->load->view('admin/index',$module);  

	}

	public function save_company_info(){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('company_name','Company_ Name','required'); 

		if($this->form_validation->run() == true){

			$imageData = '';


					       if(!empty($_FILES['images']['name'])){
					 
					          // Define new $_FILES array - $_FILES['file']
					          $_FILES['upload']['name'] = $_FILES['images']['name'];
					          $_FILES['upload']['type'] = $_FILES['images']['type'];
					          $_FILES['upload']['tmp_name'] = $_FILES['images']['tmp_name'];
					          $_FILES['upload']['error'] = $_FILES['images']['error'];
					          $_FILES['upload']['size'] = $_FILES['images']['size'];

					           
					          // Set preference
			          		  $file_path = './assets/uploaded_files/company_files/';

			                  $config['upload_path']          = $file_path;
			                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
			                  //$config['max_size']             = 1000;
			                  //$config['max_width']          = 1024;
			                  //$config['max_height']         = 768; 
			                  $config['overwrite']			= true;
			                  $config['file_name'] 			= $fn = 'company_logo-'.rand(5, 115);
					 
					          //Load upload library 
					          $this->load->library('upload',$config);  
					  		  $this->upload->initialize($config);
					 		  
					 		  if($_FILES['upload']['size']>0){  
					          // File upload
						          if($this->upload->do_upload('upload')){  
						            // Get data about the file 
						            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
						            $imageData = $fn.'.'.$ext;
						          }else{ 
						          	 $this->session->set_flashdata("error","error saving image no.  : ".$this->upload->display_errors());
						          }
						      }
					        } 
 

						/* AUDIT TRAIL */
						$log_module = "home > update company info";
						$log_description = "update company info";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		

				$result = $this->home_model->save_company_info($imageData);  
 
					 
 				$this->session->set_flashdata("success","company information successfuly updated.");
				redirect("home/company_info","refresh"); 
		}

		  
		
	}


	public function add_orders_content(){
 
		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];
 

		$this->load->view('admin/home/add_orders_content',$module);

	}


	public function view_orders_content($id){ 

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_order($id);
		$module['order'] = $result['order'];

		if(!$module['order']){ die('record not found.');}

		$result = $this->admin_model->load_site_report($id);
		$module['site_report'] = $result['site_report'];


		$result = $this->admin_model->load_raised_issue($id);
		$module['raised_issue'] = $result['raised_issue'];

		$result = $this->admin_model->load_job_order_comments($id);
		$module['comments'] = $result['comments'];
 

		$this->load->view('admin/home/view_orders_content',$module);

	}
 
	public function save_new_job_orders(){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('job_no','Job Number','required|min_length[1]|max_length[225]');
		$this->form_validation->set_rules('builder','Builder','required'); 
		$this->form_validation->set_rules('cement_type','Cement Type','required'); 
		$this->form_validation->set_rules('sand_type','Sand Type','required'); 
		$this->form_validation->set_rules('bricklayer','Bricklayer Code','required'); 

		if($this->form_validation->run() == true){

			$imageData = '';

				$result = $this->home_model->create_order(); 

				if($result['result'] == true){ 

					$countfiles = count($_FILES['images']['name']); 

					for($i=0; $i<$countfiles; $i++){  
					 
					        if(!empty($_FILES['images']['name'][$i])){
					 
					          // Define new $_FILES array - $_FILES['file']
					          $_FILES['upload']['name'] = $_FILES['images']['name'][$i];
					          $_FILES['upload']['type'] = $_FILES['images']['type'][$i];
					          $_FILES['upload']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
					          $_FILES['upload']['error'] = $_FILES['images']['error'][$i];
					          $_FILES['upload']['size'] = $_FILES['images']['size'][$i];

					           
					          // Set preference
			          		  $file_path = './assets/uploaded_files/orders/';

			                  $config['upload_path']          = $file_path;
			                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
			                  //$config['max_size']             = 1000;
			                  //$config['max_width']          = 1024;
			                  //$config['max_height']         = 768; 
			                  $config['overwrite']			= true;
			                  $config['file_name'] 			= $result['inserted_id'].'-'.$i;
					 
					          //Load upload library 
					          $this->load->library('upload',$config);  
					  		  $this->upload->initialize($config);
					 		  
					          // File upload
					          if($this->upload->do_upload('upload')){  
					            // Get data about the file 
					            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
					            $imageData.= $result['inserted_id'].'-'.$i.'.'.$ext.'-split-';
					          }else{ 
					          	 $this->session->set_flashdata("error","error saving image no. ".($i+=1)." : ".$this->upload->display_errors());
					          }
					        }
					    }


					    if($imageData){
					    	$this->home_model->update_order($result['inserted_id'],$imageData); 
					    }

						/* AUDIT TRAIL */
						$log_module = "home > creare new job order";
						$log_description = "creare new job order";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","job order successfuly created.");

				 		//redirect("home/dashboard","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving"); 
				}

		}
		$this->dashboard();
		  
		//redirect("home/dashboard","refresh"); 
	}
 
 

	public function profile(){

		$module = $this->system_menu;

		$module['module'] = "profile";
		$module['map_link']   = "home > profile"; 

		$result = $this->admin_model->system_user_info(); 
		$module['su'] = $result['su']; 

		$result = $this->admin_model->load_audit_trail();
		$module['audit_trail'] = $result['audit_trail'];

		$this->load->view('admin/index',$module);

	}

	public function change_password(){

		$module = $this->system_menu;

		$module['module'] = "change_password";
		$module['map_link']   = "home > change_password"; 

		$this->load->view('admin/index',$module);

	} 

	public function save_new_password(){

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('current_password','Current Password','required|min_length[1]|max_length[225]');
		$this->form_validation->set_rules('new_password','New Password','required|min_length[5]|max_length[225]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[new_password]');

		if($this->form_validation->run() == true){

				$result = $this->home_model->change_password(); 

				if($result == true){ 

						/* AUDIT TRAIL */
						$log_module = "profile settings > change password";
						$log_description = "change profile password";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","new password saved");

				 		redirect("home/change_password","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving new password"); 
				}

		}

		  
		$this->change_password();
	}

	public function settings(){

		$module = $this->system_menu;

		$module['module'] = "settings";
		$module['map_link']   = "home > settings"; 

		$this->load->view('admin/index',$module);

	}

	public function settings_update(){

		$module = $this->system_menu;

		$module['module'] = "settings";
		$module['map_link']   = "home > dashboard"; 

		$result = $this->home_model->settings_update(); 

		if($result == true){ 

				/* AUDIT TRAIL */
				$log_module = "profile settings";
				$log_description = "update profile settings";
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","new settings saved"); 
		 		redirect("home/settings","refresh"); 
		}else{
				$this->session->set_flashdata("error","error saving new settings"); 
		}

		$this->load->view('admin/index',$module);

	}

	public function system_users(){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$module = $this->system_menu;

		$module['module'] = "home/system_users";
		$module['map_link']   = "home > system_users"; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];
		
		$result = $this->admin_model->load_user_roles_all();
		$module['user_roles'] = $result['user_roles'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 


		$this->load->view('admin/index',$module);

	}

	public function user_roles($id){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$module = $this->system_menu;

		$module['module'] = "home/user_roles";
		$module['map_link']   = "home > user_roles"; 

		$result = $this->admin_model->load_system_user($id);
		$module['system_user'] = $result['system_user'];
		$emp_id = $result['emp_id'];

		$result = $this->admin_model->load_user_roles($id);
		$module['user_roles'] = $result['user_roles'];  

		$result = $this->admin_model->load_audit_trail($id);
		$module['audit_trail'] = $result['audit_trail'];

		$module['id'] = $id;

		$this->load->view('admin/index',$module);

	}

	public function add_system_users_content(){ 

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data'];

		$this->load->view('admin/home/add_system_user_content',$module);
	}

	public function edit_system_users_content($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

	    $result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_user($id);
		$module['system_user'] = $result['system_user']; 

		if(!$module['system_user']){ die('record not found.');}

		$this->load->view('admin/home/edit_system_user_content',$module);
	}
	
	public function edit_system_users_pass($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

	    $result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_user($id);
		$module['system_user'] = $result['system_user']; 

		if(!$module['system_user']){ die('record not found.');}

		$this->load->view('admin/home/edit_system_user_pass',$module);
	}
	
	//Edit system user staus to active or deactive by admin
	public function edit_system_users_status($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
	
		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

	    $result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_user($id);
		$module['system_user'] = $result['system_user']; 

		if(!$module['system_user']){ die('record not found.');}

		$this->load->view('admin/home/edit_system_user_status',$module);
	}

	public function add_new_system_user(){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}
 		
 		$this->form_validation->set_rules('cat','User Category','required');
 		$this->form_validation->set_rules('name','Name','required');
 		$this->form_validation->set_rules('email','email','required'); 
 		
 		$this->form_validation->set_rules('username','Username','required');
 		$this->form_validation->set_rules('password','Password','required|min_length[3]|max_length[225]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|matches[password]');

		if($this->form_validation->run() == true){

			$result = $this->home_model->add_system_user(); 

			if($result["result"] == true){ 

				$imageData = '';


		       if(!empty($_FILES['images']['name'])){
		 
		          // Define new $_FILES array - $_FILES['file']
		          $_FILES['upload']['name'] = $_FILES['images']['name'];
		          $_FILES['upload']['type'] = $_FILES['images']['type'];
		          $_FILES['upload']['tmp_name'] = $_FILES['images']['tmp_name'];
		          $_FILES['upload']['error'] = $_FILES['images']['error'];
		          $_FILES['upload']['size'] = $_FILES['images']['size'];

		           
		          // Set preference
          		  $file_path = './assets/uploaded_files/user/';

                  $config['upload_path']          = $file_path;
                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
                  //$config['max_size']             = 1000;
                  //$config['max_width']          = 1024;
                  //$config['max_height']         = 768; 
                  $config['overwrite']			= true;
                  $config['file_name'] 			= 'user-'.$result['inserted_id'];
		 
		          //Load upload library 
		          $this->load->library('upload',$config);  
		  		  $this->upload->initialize($config);
		 		  
		          // File upload
		          if($this->upload->do_upload('upload')){  
		            // Get data about the file 
		            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
		            $imageData = 'user-'.$result['inserted_id'].'.'.$ext;
		          }else{ 
		          	 $this->session->set_flashdata("error","error saving image no.  : ".$this->upload->display_errors());
		          }
		        } 

		        $this->home_model->update_system_user_avatar($result['inserted_id'],$imageData); 

				/* AUDIT TRAIL */
				$log_module = "home > system user";
				$log_description = "add new system user , user id : ".$result["inserted_id"];
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","new system user added"); 
		 		redirect("home/system_users","refresh"); 
			}

		} 

		$this->system_users();
	}

	public function update_system_user($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}
 		
 		$this->form_validation->set_rules('cat','User Category','required');
 		$this->form_validation->set_rules('name','Name','required');
 		$this->form_validation->set_rules('email','email','required'); 
 		
 		$this->form_validation->set_rules('username','Username','required'); 

		if($this->form_validation->run() == true){

			$imageData = '';


		       if(!empty($_FILES['images']['name'])){
		 
		          // Define new $_FILES array - $_FILES['file']
		          $_FILES['upload']['name'] = $_FILES['images']['name'];
		          $_FILES['upload']['type'] = $_FILES['images']['type'];
		          $_FILES['upload']['tmp_name'] = $_FILES['images']['tmp_name'];
		          $_FILES['upload']['error'] = $_FILES['images']['error'];
		          $_FILES['upload']['size'] = $_FILES['images']['size'];

		           
		          // Set preference
          		  $file_path = './assets/uploaded_files/user/';

                  $config['upload_path']          = $file_path;
                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
                  //$config['max_size']             = 1000;
                  //$config['max_width']          = 1024;
                  //$config['max_height']         = 768; 
                  $config['overwrite']			= true;
                  $config['file_name'] 			= 'user-'.$id;
		 
		          //Load upload library 
		          $this->load->library('upload',$config);  
		  		  $this->upload->initialize($config);
		 		  
		          // File upload
		          if($this->upload->do_upload('upload')){  
		            // Get data about the file 
		            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
		            $imageData = 'user-'.$id.'.'.$ext;
		          }else{ 
		          	 $this->session->set_flashdata("error","error saving image no.  : ".$this->upload->display_errors());
		          }
		        } 

			$result = $this->home_model->update_system_user($id,$imageData); 

			if($result["result"] == true){ 




				/* AUDIT TRAIL */
				$log_module = "home > system user";
				$log_description = "update system user , user id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","system user updated successfuly"); 
		 		redirect("home/system_users","refresh"); 
			}

		} 

		$this->system_users();
	}
	
	public function update_system_user_pass($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
        $pass =  $this->input->post('new_password'); 
		
		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}
 		
 		
 		$this->form_validation->set_rules('username','Username','required'); 

		if($this->form_validation->run() == true){
			$result = $this->home_model->update_system_user_pass($id,$pass); 

			if($result["result"] == true){ 

				/* AUDIT TRAIL */
				$log_module = "home > system user";
				$log_description = "update system user , user id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","system user password updated successfuly"); 
		 		redirect("home/system_users","refresh"); 
			}

		} 

		$this->system_users();
	}
	
	//update system user status to active/deactive
	public function update_system_user_status($id,$status_allow_login){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'),$st_allow_login);

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}
 		
 		echo $status_allow_login;
		
            $statusData = array('allow_login' => $status_allow_login);


		       
			$result = $this->home_model->update_system_user_status($id,$statusData); 

			if($result["result"] == true){ 

                /* AUDIT TRAIL */
				$log_module = "home > system user";
				$log_description = "update system user , user id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","system user updated successfuly"); 
		 		redirect("home/system_users","refresh"); 
			}

		

		$this->system_users();
	}

	public function save_user_roles($id){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->home_model->update_user_roles($id); 

		if($result == true){ 

			/* AUDIT TRAIL */
			$log_module = "home > system user > update user roles";
			$log_description = "update system user restriction, user id : ".$id;
			$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

	 		$this->session->set_flashdata("success","user roles successfully updates");  
		}else{
			$this->session->set_flashdata("error","error saving information");  
		}

	 	redirect("home/user_roles/$id","refresh");
	}

	public function delete_account($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$result = $this->home_model->delete_system_user($id); 

			if($result == true){ 

				/* AUDIT TRAIL */
				$log_module = "home > system user > delete user";
				$log_description = "detele system user, user id : ".$id;
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 		$this->session->set_flashdata("success","account was successfully removed");  
			}else{
				$this->session->set_flashdata("error","error deleting account");  
			}

		 	redirect("home/system_users","refresh"); 
	}

	public function change_picture(){

		$this->load->view('admin/change_picture');

	}

	public function upload_profile_picture(){

		$result = $this->home_model->update_avatar(); 

			$upload_result = $this->do_upload_images(); 

			if($upload_result == true || !$upload_result){ 
				$this->session->set_flashdata("success","profile picture successfully uploaded");  
			}else{
				$this->session->set_flashdata("error","error uploading profile picture");  
			} 

		//$this->profile();
		redirect("home/profile","refresh"); 

	}


	public function do_upload_images()
    {		
    		$result = false;
    		$file_path = './assets/uploaded_files/user/'; 

            $config['upload_path']          = $file_path;
            $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
            $config['max_size']             = 1000;
            //$config['max_width']          = 1024;
            //$config['max_height']         = 768; 
            $config['overwrite']			= true;
            $config['file_name'] 			= "profile-".$this->session->user_id;

            //$this->load->library('upload', $config);  
			$this->upload->initialize($config);

            if ( ! $this->upload->do_upload('profile_pic'))
            {
                    $this->session->set_flashdata("error","error uploading image.(".$this->upload->display_errors().")");
               		$result = true;
            }
            else
            {		 
                    $data = array('upload_data' => $this->upload->data()); 
                    $result = false;
            }

        return $result;
            
    }


    public function create_site_report_content($id){

    	$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

    	if(strtolower($this->session->user_category) != 'cleaner'){ die('access denied.');}
  
		$module['id'] = $id;
 
		$this->load->view('admin/home/create_site_report_content',$module);

	}

	public function save_site_report($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'cleaner'){ die('access denied.');}

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('visit_date','Visit Date','required'); 

		if($this->form_validation->run() == true && $id){

			$board_photos = '';
			$pre_clean_photos = '';
			$post_clean_photos = '';

				$result = $this->home_model->save_site_report($id); 

				if($result['result'] == true){ 

					    $countfiles = count($_FILES['board_photos']['name']); 

					    for($i=0; $i<$countfiles; $i++){  
					 
					        if(!empty($_FILES['board_photos']['name'][$i])){
					 
					          // Define new $_FILES array - $_FILES['file']
					          $_FILES['upload']['name'] = $_FILES['board_photos']['name'][$i];
					          $_FILES['upload']['type'] = $_FILES['board_photos']['type'][$i];
					          $_FILES['upload']['tmp_name'] = $_FILES['board_photos']['tmp_name'][$i];
					          $_FILES['upload']['error'] = $_FILES['board_photos']['error'][$i];
					          $_FILES['upload']['size'] = $_FILES['board_photos']['size'][$i];

					           
					          // Set preference
			          		  $file_path = './assets/uploaded_files/orders/';

			                  $config['upload_path']          = $file_path;
			                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
			                  //$config['max_size']             = 1000;
			                  //$config['max_width']          = 1024;
			                  //$config['max_height']         = 768; 
			                  $config['overwrite']			= true;
			                  $config['file_name'] 			= 'board-'.$result['inserted_id'].'-'.$i;
					 
					          //Load upload library 
					          $this->load->library('upload',$config);  
					  		  $this->upload->initialize($config);
					 		  
					          // File upload
					          if($this->upload->do_upload('upload')){  
					            // Get data about the file 
					            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
					            $board_photos.= 'board-'.$result['inserted_id'].'-'.$i.'.'.$ext.'-split-';
					          }else{ 
					          	 $this->session->set_flashdata("error","error saving image no. ".($i+=1)." : ".$this->upload->display_errors());
					          }
					        }
					    }



					    $countfiles = count($_FILES['pre_clean_photos']['name']); 

					    for($i=0; $i<$countfiles; $i++){  
					 
					        if(!empty($_FILES['pre_clean_photos']['name'][$i])){
					 
					          // Define new $_FILES array - $_FILES['file']
					          $_FILES['upload']['name'] = $_FILES['pre_clean_photos']['name'][$i];
					          $_FILES['upload']['type'] = $_FILES['pre_clean_photos']['type'][$i];
					          $_FILES['upload']['tmp_name'] = $_FILES['pre_clean_photos']['tmp_name'][$i];
					          $_FILES['upload']['error'] = $_FILES['pre_clean_photos']['error'][$i];
					          $_FILES['upload']['size'] = $_FILES['pre_clean_photos']['size'][$i];

					           
					          // Set preference
			          		  $file_path = './assets/uploaded_files/orders/';

			                  $config['upload_path']          = $file_path;
			                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
			                  //$config['max_size']             = 1000;
			                  //$config['max_width']          = 1024;
			                  //$config['max_height']         = 768; 
			                  $config['overwrite']			= true;
			                  $config['file_name'] 			= 'pre-'.$result['inserted_id'].'-'.$i;
					 
					          //Load upload library 
					          $this->load->library('upload',$config);  
					  		  $this->upload->initialize($config);
					 		  
					          // File upload
					          if($this->upload->do_upload('upload')){  
					            // Get data about the file 
					            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
					            $pre_clean_photos.= 'pre-'.$result['inserted_id'].'-'.$i.'.'.$ext.'-split-';
					          }else{ 
					          	 $this->session->set_flashdata("error","error saving image no. ".($i+=1)." : ".$this->upload->display_errors());
					          }
					        }
					    }


					    $countfiles = count($_FILES['post_clean_photos']['name']); 

					    for($i=0; $i<$countfiles; $i++){  
					 
					        if(!empty($_FILES['post_clean_photos']['name'][$i])){
					 
					          // Define new $_FILES array - $_FILES['file']
					          $_FILES['upload']['name'] = $_FILES['post_clean_photos']['name'][$i];
					          $_FILES['upload']['type'] = $_FILES['post_clean_photos']['type'][$i];
					          $_FILES['upload']['tmp_name'] = $_FILES['post_clean_photos']['tmp_name'][$i];
					          $_FILES['upload']['error'] = $_FILES['post_clean_photos']['error'][$i];
					          $_FILES['upload']['size'] = $_FILES['post_clean_photos']['size'][$i];

					           
					          // Set preference
			          		  $file_path = './assets/uploaded_files/orders/';

			                  $config['upload_path']          = $file_path;
			                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
			                  //$config['max_size']             = 1000;
			                  //$config['max_width']          = 1024;
			                  //$config['max_height']         = 768; 
			                  $config['overwrite']			= true;
			                  $config['file_name'] 			= 'post-'.$result['inserted_id'].'-'.$i;
					 
					          //Load upload library 
					          $this->load->library('upload',$config);  
					  		  $this->upload->initialize($config);
					 		  
					          // File upload
					          if($this->upload->do_upload('upload')){  
					            // Get data about the file 
					            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
					            $post_clean_photos.= 'post-'.$result['inserted_id'].'-'.$i.'.'.$ext.'-split-';
					          }else{ 
					          	 $this->session->set_flashdata("error","error saving image no. ".($i+=1)." : ".$this->upload->display_errors());
					          }
					        }
					    } 

					    if($board_photos || $pre_clean_photos || $post_clean_photos){
					    	$this->home_model->update_site_report($result['inserted_id'], $board_photos, $pre_clean_photos, $post_clean_photos); 
					    }

						/* AUDIT TRAIL */
						$log_module = "home > creare job order site report";
						$log_description = "creare job order site report";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","site report successfuly created.");

				 		//redirect("home/dashboard","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving"); 
				}

		}

		  
		redirect("home/dashboard","refresh"); 
	}



	public function raise_an_issue_content($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];
  
		$module['id'] = $id;
 
		$this->load->view('admin/home/raise_an_issue_content',$module);

	}
 
	
	public function save_raised_issue($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');  

			$imageData = '';

				$result = $this->home_model->save_raised_issue($id); 

				if($result['result'] == true){ 

					$countfiles = count($_FILES['images']['name']); 

					for($i=0; $i<$countfiles; $i++){  
					 
					        if(!empty($_FILES['images']['name'][$i])){
					 
					          // Define new $_FILES array - $_FILES['file']
					          $_FILES['upload']['name'] = $_FILES['images']['name'][$i];
					          $_FILES['upload']['type'] = $_FILES['images']['type'][$i];
					          $_FILES['upload']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
					          $_FILES['upload']['error'] = $_FILES['images']['error'][$i];
					          $_FILES['upload']['size'] = $_FILES['images']['size'][$i];

					           
					          // Set preference
			          		  $file_path = './assets/uploaded_files/orders/';

			                  $config['upload_path']          = $file_path;
			                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
			                  //$config['max_size']             = 1000;
			                  //$config['max_width']          = 1024;
			                  //$config['max_height']         = 768; 
			                  $config['overwrite']			= true;
			                  $config['file_name'] 			= 'issue-'.$result['inserted_id'].'-'.$i;
					 
					          //Load upload library 
					          $this->load->library('upload',$config);  
					  		  $this->upload->initialize($config);
					 		  
					          // File upload
					          if($this->upload->do_upload('upload')){  
					            // Get data about the file 
					            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
					            $imageData.= 'issue-'.$result['inserted_id'].'-'.$i.'.'.$ext.'-split-';
					          }else{ 
					          	 $this->session->set_flashdata("error","error saving image no. ".($i+=1)." : ".$this->upload->display_errors());
					          }
					        }
					    }


					    if($imageData){
					    	$this->home_model->update_raised_issue($result['inserted_id'],$imageData); 
					    }

						/* AUDIT TRAIL */
						$log_module = "home > creare new job order issue";
						$log_description = "creare new job order issue";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","rased issue successfuly created.");

				 		//redirect("home/dashboard","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving"); 
				} 

		  
		redirect("home/dashboard","refresh"); 
	}


	public function add_comments_content($id){ 

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
  
		$module['id'] = $id;
 
		$this->load->view('admin/home/add_comments_content',$module);

	}

	public function save_comments($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('comments','comments','required'); 

		if($this->form_validation->run() == true){

			$imageData = '';

				$result = $this->home_model->save_comments($id); 

				if($result['result'] == true){  

						/* AUDIT TRAIL */
						$log_module = "home > creare new job order comments";
						$log_description = "creare new job orde commentsr";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","comments successfuly created.");

				 		//redirect("home/dashboard","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving"); 
				}

		}

		  
		redirect("home/dashboard","refresh"); 
	}


	public function set_as_completed($id){ 

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'cleaner'){ die('access denied.');}

		if($id){
 			
 			$result = $this->admin_model->load_job_order($id);
 			$order = $result['order'];
 			
 			$result = $this->admin_model->load_system_user($order->builder);
 			$system_user = $result['system_user'];

				$result = $this->home_model->set_as_completed($id); 

				if($result['result'] == true){   	
					
					$this->send_email($id, 'admin/home/email_job_order_content','job completed',$system_user->email);
					//========= end of mail

						/* AUDIT TRAIL */
						$log_module = "home > set job order as completed";
						$log_description = "set job order as completed";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","job order successfuly set as completed.");

				 		//redirect("home/dashboard","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving"); 
				}

		}

		  
		redirect("home/dashboard","refresh"); 
	}

	public function set_as_inprogress($id){ 

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'cleaner'){ die('access denied.');}

		if($id){
 			
 			$result = $this->admin_model->load_job_order($id);
 			$order = $result['order'];
 			
 			$result = $this->admin_model->load_system_user($order->builder);
 			$system_user = $result['system_user'];

				$result = $this->home_model->set_as_inprogress($id); 

				if($result['result'] == true){   	
					 
					//========= end of mail

						/* AUDIT TRAIL */
						$log_module = "home > set job order as completed";
						$log_description = "set job order as completed";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","job order successfuly set as in-progress.");

				 		//redirect("home/dashboard","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving"); 
				}

		}

		  
		redirect("home/dashboard","refresh"); 
	}

	public function generate_invoice_content($id){

	    $Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key')); 
  
		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_order($id);
		$module['order'] = $result['order'];

		if(!$module['order']){ die('record not found.'.$id);}

		$result = $this->admin_model->load_site_report($id);
		$module['site_report'] = $result['site_report'];


		$result = $this->admin_model->load_raised_issue($id);
		$module['raised_issue'] = $result['raised_issue'];

		$result = $this->admin_model->load_job_order_comments($id);
		$module['comments'] = $result['comments'];

		$result = $this->admin_model->load_company_info();
		$module['company_info'] = $result['company_info'];
  
		$module['id'] = $id;
 
		$this->load->view('admin/home/generate_invoice_content',$module);

	}


	public function view_wash_procecess_content($id){ 

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
  
		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$module['id'] = $id;
 
		$this->load->view('admin/home/view_wash_procecess_content',$module);

	}

	public function send_email($id=null,$url,$subject,$to){

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		foreach ($module['user_category'] as $rs) {
			$cat[$rs->id] = $rs->title;
		}

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_order($id);
		$module['order'] = $result['order'];

		if(!$module['order']){ die('record not found.');}

		$result = $this->home_model->load_settings();
		$module['settings'] = $result['settings'];

		$admin_email = '';

		foreach($module['system_users'] as $rs){
			if(strtolower($cat[$rs->user_category]) == 'admin'){
				$admin_email.=$rs->email.', ';
			}
		}

		$admin_email = $admin_email.')';
		$admin_email = str_replace(', )', '', $admin_email);
 		$from = $module['settings']->system_email;
		//define the headers we want passed. Note that they are separated with \r\n
		$headers = "From: $from\r\n"; 
		$headers .= 'Cc: $admin_email' . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		 
		ob_start();  
		$this->load->view('admin/home/email_job_order_content',$module); 
		$message = ob_get_clean();

		//$message = 'test message : '.$module['order']->job_no;
		 
		$mail_sent = mail($to,"Job Order ".$module['order']->job_no." Completed",$message, $headers);
		 
		//echo $mail_sent ? "<script> alert('email sent - fr:$from cc:$admin_email'); </script>" : "<script>alert('error sending - fr:$from cc:$admin_email');</script>"; 
	} 

	public function view_system_user_content($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key')); 

	    $result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_user($id);
		$module['system_user'] = $result['system_user']; 

		if(!$module['system_user']){ die('record not found.');}

		$this->load->view('admin/home/view_system_user_content',$module);
	}

	public function edit_error_date($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');} 

		$module['id'] = $id;

		$this->load->view('admin/home/edit_error_date_content',$module);
	}

	public function edit_job_open_date($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'builder'){ die('access denied.');} 

		$module['id'] = $id;

		$this->load->view('admin/home/edit_job_open_date_content',$module);
	}

	public function save_job_open_date($id,$log = ''){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$result = $this->home_model->save_job_open_date($id,$log); 

		$this->session->set_flashdata("success","Open job date successfuly changed."); 
		  
		redirect("home/dashboard","refresh"); 

	}

	public function edit_job_order($id){ 

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_order($id);
		$module['order'] = $result['order'];

		if(!$module['order']){ die('record not found.');}

		$result = $this->admin_model->load_site_report($id);
		$module['site_report'] = $result['site_report'];


		$result = $this->admin_model->load_raised_issue($id);
		$module['raised_issue'] = $result['raised_issue'];

		$result = $this->admin_model->load_job_order_comments($id);
		$module['comments'] = $result['comments'];

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];
 

		$this->load->view('admin/home/edit_job_order_content',$module);

	}

	public function update_new_job_orders($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('job_no','Job Number','required|min_length[1]|max_length[225]');
		$this->form_validation->set_rules('builder','Builder','required'); 
		$this->form_validation->set_rules('cement_type','Cement Type','required'); 
		$this->form_validation->set_rules('sand_type','Sand Type','required'); 
		$this->form_validation->set_rules('bricklayer','Bricklayer Code','required'); 

		if($this->form_validation->run() == true){

			$imageData = '';

				$result = $this->home_model->update_order($id); 

				if($result['result'] == true){ 

					$countfiles = count($_FILES['images']['name']);  

					for($i=0; $i<$countfiles; $i++){  
					 
					        if(!empty($_FILES['images']['name'][$i])){
					 
					          // Define new $_FILES array - $_FILES['file']
					          $_FILES['upload']['name'] = $_FILES['images']['name'][$i];
					          $_FILES['upload']['type'] = $_FILES['images']['type'][$i];
					          $_FILES['upload']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
					          $_FILES['upload']['error'] = $_FILES['images']['error'][$i];
					          $_FILES['upload']['size'] = $_FILES['images']['size'][$i];

					           
					          // Set preference
			          		  $file_path = './assets/uploaded_files/orders/';

			                  $config['upload_path']          = $file_path;
			                  $config['allowed_types']        = 'gif|jpg|png|jpeg|gif';
			                  //$config['max_size']             = 1000;
			                  //$config['max_width']          = 1024;
			                  //$config['max_height']         = 768; 
			                  $config['overwrite']			= true;
			                  $config['file_name'] 			= $result['inserted_id'].'-'.$i;
					 
					          //Load upload library 
					          $this->load->library('upload',$config);  
					  		  $this->upload->initialize($config);
					 		  
					          // File upload
					          if($this->upload->do_upload('upload')){  
					            // Get data about the file 
					            $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
					            $imageData.= $result['inserted_id'].'-'.$i.'.'.$ext.'-split-';
					          }else{ 
					          	 $this->session->set_flashdata("error","error saving image no. ".($i+=1)." : ".$this->upload->display_errors());
					          }
					        }
					    }


					    if($imageData){
					    	$this->home_model->update_order($result['inserted_id'],$imageData); 
					    }

						/* AUDIT TRAIL */
						$log_module = "home > creare new job order";
						$log_description = "creare new job order";
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				 		$this->session->set_flashdata("success","job order successfuly updated.");

				 		//redirect("home/dashboard","refresh");  
				}else{
						$this->session->set_flashdata("error","error saving"); 
				}

		}
		$this->dashboard();
		  
		//redirect("home/dashboard","refresh"); 
	}


	public function delete_job($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$result = $this->home_model->delete_job($id); 

		$this->session->set_flashdata("success","Job order successfuly removed."); 
		  
		redirect("home/dashboard","refresh"); 

	} 

	public function delete_site_report($id){
		
		//$Openssl_security = new Openssl_security;
		//$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
		
		$data['status'] = 0; 
		$this->db->where('id',$id);
		if($this->db->update('site_report',$data)){
			echo 'success';
		} 
		
	}

	public function delete_raised_issue($id){
		
		//$Openssl_security = new Openssl_security;
		//$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
		
		$data['status'] = 0; 
		$this->db->where('id',$id);
		if($this->db->update('raised_issue',$data)){
			echo 'success';
		} 
		
	}


	public function delete_comment($id){
		
		//$Openssl_security = new Openssl_security;
		//$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
		
		$data['status'] = 0; 
		$this->db->where('id',$id);
		if($this->db->update('job_order_comments',$data)){
			echo 'success';
		} 
		
	}


	
}	