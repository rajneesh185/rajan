<?php  
class Admin_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function check_admin_email(){

		$this->db->select("*");
		$this->db->from("account");
		$this->db->where(array('email'=>$this->input->post('email')));
		$query = $this->db->get(); 
		$rs_student = $query->row(); 

		return array(
			'result'  =>	 $rs_student
			);

	}

	public function save_reset_password($email_to,$user_type,$key){

		$data = array( 
		'email'  		=> $email_to,
		'key' 	 		=> $key,
		'user_type'	    => $user_type,
		'status'	    => 1,
		'dc' 			=> datedb
		 );

		$result = $this->db->insert('forgot_password',$data);
		//$inserted_id = $this->db->insert_id();
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function reset_password($key){

		$this->db->select("*");
		$this->db->from("forgot_password");
		$this->db->where(array('key'=>$key));
		$query = $this->db->get(); 
		return $query->row();  
	}

	public function save_reset_password_key($key){

		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$new_password = $phppass->HashPassword($this->input->post("password1",TRUE));

		$this->db->select("*");
		$this->db->from("forgot_password");
		$this->db->where(array('key'=>$key));
		$query = $this->db->get(); 
		$key_row = $query->row(); 

		if($key_row->user_type == 3){

			$this->db->select("*");
			$this->db->from("employee");
			$this->db->where(array('email_address'=> $key_row->email));
			$query2 = $this->db->get(); 
			$er = $query2->row(); 

			$this->db->set('ps',$new_password);  
			$this->db->where('emp_id', $er->id);
			$this->db->update('account'); 

		}elseif($key_row->user_type == 1){
			$this->db->set('password',$new_password);  
			$this->db->where('email_address', $key_row->email);
			$this->db->update('students'); 

		}elseif($key_row->user_type == 2){
			$this->db->set('password',$new_password);  
			$this->db->where('email_address', $key_row->email);
			$this->db->update('parents'); 

		} 

		$this->db->set('status',0);  
		$this->db->where('key', $key);
		$this->db->update('forgot_password');

		return true;
	}


	public function audit_trail_logging($module,$log_description){ 

		$data = array( 
		'module' 	 	 => $module,
		'description' 	 => $log_description, 
		'dc' 			 => datetimedb,
		'user_id' 		 => $this->session->user_id
		 );

		$result = $this->db->insert('audit_trail',$data);
		//$inserted_id = $this->db->insert_id();
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function load_audit_trail($id=''){

		$rs_audit_trail      = array();   

		$this->db->order_by("id", "desc");
		if($id){
			$this->db->where(array('user_id'=>$id));
		}else{
			$this->db->where(array('user_id'=>$this->session->user_id));
		}
		
		$audit_trail = $this->db->get("audit_trail");
		if($audit_trail->num_rows()>0){
			foreach($audit_trail->result() as $data){
				$rs_audit_trail[] = $data; 
			}
		} 

		return array(
			'audit_trail'  =>	 $rs_audit_trail 
			);

	}

	public function load_index_data(){

		$rs_main_menu  = array(); 
		$rs_sub_menu   = array(); 
		$rs_user_roles = array();
		$rs_settings   = array();
		$rs_notif = array();
		$sql_selected_asset = array();
		$sql_selected_assets = '';
		$rs_selected_assets = '';
		$rs_p_students = array();
		$rs_p_parents   = array();

		/* account info */ 

		$this->db->select("*");
		$this->db->from("account");
		$this->db->where(array('id'=>$this->session->user_id));
		$query = $this->db->get(); 
		$rs_system_user = $query->row(); 
		$emp_id = null;
		if(isset($rs_system_user->avatar) && $rs_system_user->avatar){
			$avatar = $rs_system_user->avatar; 
		}else{
			$avatar = '';
		}

		/* main menu */
		$this->db->order_by("pri", "asc");
		$this->db->where('act', 1);
		$main_menu = $this->db->get("menu_main");
		if($main_menu->num_rows()>0){
			foreach($main_menu->result() as $data){
				$rs_main_menu[] = $data; 
			}
		} 

		/* sub menu */
		$this->db->order_by("pri", "asc");
		$this->db->where('act', 1);
		$sub_menu = $this->db->get("menu_sub");
		if($sub_menu->num_rows()>0){
			foreach($sub_menu->result() as $data){
				$rs_sub_menu[] = $data; 
			}
		} 

		/* user roles */
		$this->db->where('user_id', $this->session->user_id);
		$user_roles = $this->db->get("user_roles");
		if($user_roles->num_rows()>0){
			foreach($user_roles->result() as $data){
				$rs_user_roles[] = $data; 
			}
		} 

		/* settings */
		$this->db->select("*");
		$this->db->from("settings"); 
		$query = $this->db->get(); 
		$rs_settings = $query->row(); 

		if($rs_settings->timezone){
			 date_default_timezone_set($rs_settings->timezone);
		}   


		/* one data ony */
		$this->db->select("*");
		$this->db->from("company_info"); 
		$query = $this->db->get(); 
		$company_info = $query->row();  
 


		return array(
			'main_menu'          =>	 $rs_main_menu,
			'sub_menu'	         =>	 $rs_sub_menu,
			'index_user_roles'   =>	 $rs_user_roles,
			'settings' 		     =>  $rs_settings, 
			'avatar'			 =>  $avatar, 
			'company_info' 		=> $company_info
			);
	}

	public function load_system_users(){

		$rs_system_users      = array();  

		/* user list */
		$this->db->where('act', 1);
		$this->db->order_by("name", "asc");
		$system_users = $this->db->get("account");
		if($system_users->num_rows()>0){
			foreach($system_users->result() as $data){
				$rs_system_users[] = $data; 
			}
		}  

		return array(
			'system_users'  =>	 $rs_system_users 
			);

	}

	public function load_system_user($id){

		$rs_system_user      = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from("account");
		$this->db->where(array('id'=>$id));
		$query = $this->db->get(); 
		$rs_system_user = $query->row();  

		return array(
			'system_user'  =>	 $rs_system_user
			);

	}

	public function load_user_roles($id){

		$rs_user_roles  = array();  

		/* user roles */
		$this->db->where('user_id', $id);
		$user_roles = $this->db->get("user_roles");
		if($user_roles->num_rows()>0){
			foreach($user_roles->result() as $data){
				$rs_user_roles[] = $data; 
			}
		}  

		return array(
			'user_roles'  =>	 $rs_user_roles 
			);

	}

	public function load_user_roles_all(){

		$rs_user_roles  = array();  

		/* user roles */ 
		$user_roles = $this->db->get("user_roles");
		if($user_roles->num_rows()>0){
			foreach($user_roles->result() as $data){
				$rs_user_roles[] = $data; 
			}
		}  

		return array(
			'user_roles'  =>	 $rs_user_roles 
			);

	}

	public function load_filemaintenance($table_name){
		
		$rs_table_data  = array();
		/* user roles */ 
		$this->db->where(array('status'=>1));
		$this->db->order_by("title", "asc");
		$table_data = $this->db->get($table_name);
		if($table_data->num_rows()>0){
			foreach($table_data->result() as $data){
			$rs_table_data[] = $data; 
			if(isset($data->title)&& $data->title == 'unknown' ){
			$data_append = $data;
			}else{
				$rs_table_data[] = $data; 
			}
			}
			if(isset($data_append)){
			array_unshift($rs_table_data,$data_append);
			}
		}  

		return array(
			'maintenance_data'  =>	 $rs_table_data 
			);

	}

	public function system_user_info(){

		$rs_system_user      = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from("account");
		$this->db->where(array('id'=>$this->session->user_id));
		$query = $this->db->get(); 
		$rs_system_user = $query->row();  

		return array( 
			'su' 		=> $rs_system_user 
			);

	}

	public function load_company_info(){

		$rs      = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from("company_info"); 
		$query = $this->db->get(); 
		$rs = $query->row();  

		return array( 
			'company_info' 		=> $rs
			);

	}

	public function load_job_orders(){

		$rs_system_users      = array();  

		/* user list */
		$this->db->where('active', 1);
		$system_users = $this->db->get("job_orders");
		if($system_users->num_rows()>0){
			foreach($system_users->result() as $data){
				$rs_system_users[] = $data; 
			}
		}  

		return array(
			'job_orders'  =>	 $rs_system_users 
			);

	}

	public function load_job_orders_builder($id){

		$rs_system_users      = array();  

		/* user list */ 
		$this->db->where('builder', $id);
		$system_users = $this->db->get("job_orders");
		if($system_users->num_rows()>0){
			foreach($system_users->result() as $data){
				$rs_system_users[] = $data; 
			}
		}  

		return array(
			'job_orders'  =>	 $rs_system_users 
			);

	}

	public function load_job_order($id){

		/* one data ony */
		$this->db->select("*");
		$this->db->from("job_orders");
		$this->db->where(array('id'=>$id));
		$query = $this->db->get();  
		$rs = $query->row(); 

		return array(
			'order'  =>	 $rs 
			);

	}

	public function load_site_report($id){

		/* one data ony */
		$this->db->select("*");
		$this->db->from("site_report");
		$this->db->where(array('job_order_id'=>$id,'status'=>1));
		$query = $this->db->get();  
		$rs = $query->result(); 

		return array(
			'site_report'  =>	 $rs 
			);

	}

	public function load_all_site_report(){

		/* one data ony */
		$this->db->select("*");
		$this->db->where(array('status'=>1));
		$this->db->from("site_report"); 
		$query = $this->db->get();  
		$rs = $query->result(); 

		return array(
			'site_reports'  =>	 $rs 
			);

	}

	public function load_raised_issue($id){

		/* one data ony */
		$this->db->select("*");
		$this->db->from("raised_issue");
		$this->db->where(array('job_order_id'=>$id,'status'=>1));
		$query = $this->db->get();  
		$rs = $query->result(); 

		return array(
			'raised_issue'  =>	 $rs 
			);

	}

	public function load_all_raised_issue(){

		/* one data ony */
		$this->db->select("*");
		$this->db->where(array('status'=>1));
		$this->db->from("raised_issue"); 
		$query = $this->db->get();  
		$rs = $query->result(); 

		return array(
			'raised_issue'  =>	 $rs 
			);

	}

	public function load_job_order_comments($id = ''){

		if($id){

			/* one builder comment data ony */
			$this->db->select("*");
			$this->db->from("job_order_comments");
			$this->db->where(array('job_order_id'=>$id,'status'=>1));
			$query = $this->db->get();  
			$rs = $query->result(); 

		}else{

			$this->db->select("*");
			$this->db->where(array('status'=>1));
			$this->db->from("job_order_comments"); 
			$query = $this->db->get();  
			$rs = $query->result(); 

		}
		

		return array(
			'comments'  =>	 $rs 
			);

	}

	public function load_invoice($status){

		/* one data ony */
		$this->db->select("*");
		$this->db->from("invoice");
		if($status!=3){ 
			$this->db->where(array('status'=>$status));
		}
		$query = $this->db->get();   
		$rs = $query->result();

		return array(
			'invoice'  =>	 $rs 
			);

	}

	public function load_invoice_jobs($id=''){

		/* one data ony */
		$this->db->select("*");
		$this->db->from("invoice_jobs");
		if($id){
			$this->db->where('invoice_id', $id);
		}
		$query = $this->db->get();   
		$rs = $query->result();  

		return array(
			'invoice_jobs'  =>	 $rs 
			);

	}

	public function invoice($id){

		/* one data ony */
		$this->db->select("*");
		$this->db->from("invoice");
		$this->db->where(array('id'=>$id));
		$query = $this->db->get();   
		$rs = $query->row(); 

		return array(
			'invoice'  =>	 $rs 
			);

	}
	
	public function invoice_additional_fee($id){

		/* one data ony */
		$this->db->select("*");
		$this->db->from("invoice_additional_fee");
		$this->db->where(array('invoice_id'=>$id));
		$query = $this->db->get();   
		$rs = $query->result(); 

		return array(
			'invoice_fee'  =>	 $rs 
			);

	}
 
}