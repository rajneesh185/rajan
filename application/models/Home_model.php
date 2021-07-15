<?php  
class Home_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function add_system_user(){

		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$password = $phppass->HashPassword($this->input->post("password",TRUE));

		$data = array( 
		'user_category' 		  => $this->input->post('cat',TRUE),
		'name' => $this->input->post('name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'contact_no' => $this->input->post('contact_no',TRUE),
		'address' => $this->input->post('address',TRUE),
		'abn' => $this->input->post('abn',TRUE),
		'allow_login' => $this->input->post('allow_login',TRUE),
		'un'	      	  => $this->input->post('username',TRUE),
		'ps'	          => $password,
		'dc' 	 		  => datedb,
		'act'			  => 1
		 );

		$result = $this->db->insert('account',$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}
	
	public function update_system_user_status($id,$allow_login){
		//$data = array( 'allow_login'  => $allow_login );
		//print_r($data);
//die();		
		$this->db->where('id', $id);
		$result = $this->db->update('account',$allow_login); 
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'          => $result
		);		
	}

	public function update_system_user($id,$img){ 

		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
	    $password = $phppass->HashPassword($this->input->post("new_password",TRUE));

		if($img){
			if($this->input->post('new_password',TRUE)){

				

				$data = array( 
				'user_category'  => $this->input->post('cat',TRUE),
				'name' => $this->input->post('name',TRUE),
				'email' => $this->input->post('email',TRUE),
				'contact_no' => $this->input->post('contact_no',TRUE),
				'address' => $this->input->post('address',TRUE),
				'abn' => $this->input->post('abn',TRUE),
				'allow_login' => $this->input->post('allow_login',TRUE),
				'un'	      	  => $this->input->post('username',TRUE) ,
				'ps'	          => $password,
				'avatar'	      	  => $img
				 );
			}else{
				$data = array( 
				'user_category'  => $this->input->post('cat',TRUE),
				'name' => $this->input->post('name',TRUE),
				'email' => $this->input->post('email',TRUE),
				'contact_no' => $this->input->post('contact_no',TRUE),
				'address' => $this->input->post('address',TRUE),
				'abn' => $this->input->post('abn',TRUE),
				'allow_login' => $this->input->post('allow_login',TRUE),
				'un'	      	  => $this->input->post('username',TRUE) ,
				'avatar'	      	  => $img
				 );
			}
			
		}else{
			if($this->input->post('new_password',TRUE)){
				$data = array( 
				'user_category'  => $this->input->post('cat',TRUE),
				'name' => $this->input->post('name',TRUE),
				'email' => $this->input->post('email',TRUE),
				'contact_no' => $this->input->post('contact_no',TRUE),
				'address' => $this->input->post('address',TRUE),
				'abn' => $this->input->post('abn',TRUE),
				'allow_login' => $this->input->post('allow_login',TRUE),
				'un'	      	  => $this->input->post('username',TRUE),
				'ps'	          => $password
				 );
			}else{
				$data = array( 
				'user_category'  => $this->input->post('cat',TRUE),
				'name' => $this->input->post('name',TRUE),
				'email' => $this->input->post('email',TRUE),
				'contact_no' => $this->input->post('contact_no',TRUE),
				'address' => $this->input->post('address',TRUE),
				'abn' => $this->input->post('abn',TRUE),
				'allow_login' => $this->input->post('allow_login',TRUE),
				'un'	      	  => $this->input->post('username',TRUE) 
				 );
			}
		}
		

		$this->db->where('id', $id);
		$result = $this->db->update('account',$data); 
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'          => $result
		);

	}
	//update system user password
	public function update_system_user_pass($id,$img){ 

		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
	    $password = $phppass->HashPassword($this->input->post("new_password",TRUE));

		if($this->input->post('new_password',TRUE)){
				$data = array( 
				'ps'	          => $password
				 );
			}

		$this->db->where('id', $id);
		$result = $this->db->update('account',$data); 
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'          => $result
		);

	}
	


	public function update_system_user_avatar($id,$img){ 

		$data = array( 
		'avatar'  => $img
		 );

		$this->db->where('id', $id);
		$result = $this->db->update('account',$data); 
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'          => $result
		);

	}


	public function delete_system_user($id){

		$this->db->delete('account', array('id' => $id));
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function update_user_roles($id){

		$limited = 1;
		$result  = false;

		$this->db->delete('user_roles', array('user_id' => $id));

		$menu_sub = $this->db->get("menu_sub");
		if($menu_sub->num_rows()>0){
			foreach($menu_sub->result() as $data){
				
				if($this->input->post('user_role'.$data->id ,TRUE)){
					$data = array( 
					'user_id' 	   => $id,
					'sub_menu_id'  => $data->id,
					'main_menu_id' => $this->input->post('user_role'.$data->id ,TRUE)
					 );

					$result = $this->db->insert('user_roles',$data);
				}else{
					$limited=0;
				}
			}
		}   

		$this->db->set('full_access',$limited);  
	  
		$this->db->where('id', $id);
		$this->db->update('account'); 

		//return ($this->db->affected_rows() != 1) ? false : true;
		return ($result != true) ? false : true;

	}

	public function settings_update(){

		$this->db->set('timezone',$this->input->post('timezone',TRUE));  
		$this->db->set('currency',$this->input->post('currency',TRUE));  
		$this->db->set('gst',$this->input->post('gst',TRUE)); 
		$this->db->set('system_email',$this->input->post('system_email',TRUE)); 
	  
		$this->db->update('settings'); 

		//$this->output->enable_profiler(TRUE);

		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function update_avatar(){ 

		$name_file = $_FILES['profile_pic']['name'];
		$ext = $this->get_file_extension($name_file); 

		$this->db->set('avatar',"profile-".$this->session->user_id.".".$ext);      
	    
	    $this->db->where('id', $this->session->user_id);
		$this->db->update('account'); 

		//$this->output->enable_profiler(TRUE);

		return ($this->db->affected_rows() != 1) ? false : true;


	}

	public function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}


	public function change_password(){

		$result = '';

		$password = $this->input->post("current_password",TRUE);
		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$new_password = $phppass->HashPassword($this->input->post("new_password",TRUE));
 
			$this->db->where('id',$this->session->user_id);
			$my_account = $this->db->get("account"); 
			$rs = $my_account->row();
			$getpwd = $rs->ps;  

		
		$result_pass = $phppass->CheckPassword($password, $getpwd);

		if ($result_pass == true) {  

			 
				$this->db->set('ps',$new_password);  
				$this->db->where('id', $this->session->user_id);
				$this->db->update('account'); 
 

			$result = ($this->db->affected_rows() != 1) ? false : true;

		}

		return $result;

	}

	public function create_order(){ 
 
		$job_open_date = str_replace( "/", "-", $this->input->post('job_open_date',TRUE));

		$data = array( 
		'job_no' 		  => $this->input->post('job_no',TRUE),
		'builder' => $this->input->post('builder',TRUE),
		'job_open_date' => date(dateformatdb,strtotime($job_open_date)),
		'qty_bricks' => $this->input->post('qty_bricks',TRUE),
		'approved' => $this->input->post('approved',TRUE),
		'location'	      	  => $this->input->post('location',TRUE),
		'address'	          => $this->input->post('address',TRUE),
		'supervisor' 	 		  => $this->input->post('supervisor',TRUE),
		'tel_no'	      	  => $this->input->post('tel_no',TRUE),
		'cement_type'	      	  => $this->input->post('cement_type',TRUE),
		'sand_type'	      	  => $this->input->post('sand_type',TRUE),
		'brick_type'	      	  => $this->input->post('brick_type',TRUE),
		'bricklayer'	      	  => $this->input->post('bricklayer',TRUE),
		'cleaner'	      	  => $this->input->post('cleaner',TRUE),
		'description'	      	  => $this->input->post('ds',TRUE),
		'wash_process'	      	  => $this->input->post('wash_process',TRUE),
		'attachments'	      	  => '',
		'date_created'	      	  =>  datetimedb,
		'user_id'	      	  => $this->session->user_id
		 );

		$result = $this->db->insert('job_orders',$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true; 

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}

	public function update_order($id){ 
 
		$job_open_date = str_replace( "/", "-", $this->input->post('job_open_date',TRUE));

		$data = array( 
		'job_no' 		  => $this->input->post('job_no',TRUE),
		'builder' => $this->input->post('builder',TRUE),
		'job_open_date' => date(dateformatdb,strtotime($job_open_date)),
		'qty_bricks' => $this->input->post('qty_bricks',TRUE),
		'approved' => $this->input->post('approved',TRUE),
		'location'	      	  => $this->input->post('location',TRUE),
		'address'	          => $this->input->post('address',TRUE),
		'supervisor' 	 		  => $this->input->post('supervisor',TRUE),
		'tel_no'	      	  => $this->input->post('tel_no',TRUE),
		'cement_type'	      	  => $this->input->post('cement_type',TRUE),
		'sand_type'	      	  => $this->input->post('sand_type',TRUE),
		'brick_type'	      	  => $this->input->post('brick_type',TRUE),
		'bricklayer'	      	  => $this->input->post('bricklayer',TRUE),
		'cleaner'	      	  => $this->input->post('cleaner',TRUE),
		'description'	      	  => $this->input->post('ds',TRUE),
		'wash_process'	      	  => $this->input->post('wash_process',TRUE),
		'attachments'	      	  => '',
		'date_created'	      	  =>  datetimedb,
		'user_id'	      	  => $this->session->user_id
		 );

		$this->db->where('id', $id);
		$result = $this->db->update('job_orders',$data);
		$inserted_id = $id;
		$result = ($this->db->affected_rows() != 1) ? false : true; 

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}
  
	public function save_job_open_date($id,$log){

		$job_open_date = str_replace( "/", "-", $this->input->post('job_open_date',TRUE)); 

		if($log){
			/* one data ony */
			$this->db->select("job_open_date");
			$this->db->from("job_orders");
			$this->db->where(array('id'=>$id));
			$query = $this->db->get();  
			$rs = $query->row(); 

			$data = array(  
			'job_id' => $id,
			'date_from' => $rs->job_open_date,
			'date_to' => $job_open_date, 
			'date_created'	      	  =>  datetimedb,
			'user_id'	      	  => $this->session->user_id
			 );

			$result = $this->db->insert('job_open_date_edit_history',$data);


		}

		$this->db->set('job_open_date',date(dateformatdb,strtotime($job_open_date)));  
		$this->db->where('id', $id);
		$this->db->update('job_orders'); 

	}


	public function save_site_report($id){ 
 
		$visit_date = str_replace( "/", "-", $this->input->post('visit_date',TRUE));

		$data = array(  
		'visit_date' => date(dateformatdb,strtotime($visit_date)),
		'atsd' => $this->input->post('atsd',TRUE),
		'mpo' => $this->input->post('mpo',TRUE),
		'wp' => $this->input->post('wp',TRUE),
		'note' => $this->input->post('note',TRUE),
		'score_bricklayer' => $this->input->post('score_bricklayer',TRUE),
		'score_cleaner' => $this->input->post('score_cleaner',TRUE),
		'job_order_id' => $id, 
		'date_created'	      	  =>  datetimedb,
		'user_id'	      	  => $this->session->user_id
		 );

		$result = $this->db->insert('site_report',$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true; 

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}

	public function update_site_report($id, $board_photos, $pre_clean_photos, $post_clean_photos){
		$this->db->set('board_photos',$board_photos); 
		$this->db->set('pre_clean_photos',$pre_clean_photos); 
		$this->db->set('post_clean_photos',$post_clean_photos);  
		$this->db->where('id', $id);
		$this->db->update('site_report'); 
	}

	public function save_raised_issue($id){ 

		$data = array(  
		'responsible' => $this->input->post('responsible',TRUE), 
		'job_order_id' => $id,
		'description' => $this->input->post('ds',TRUE), 
		'date_created'	      	  =>  datetimedb,
		'user_id'	      	  => $this->session->user_id
		 );

		$result = $this->db->insert('raised_issue',$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true; 

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}

	public function update_raised_issue($id,$img){
		$this->db->set('attachments',$img);  
		$this->db->where('id', $id);
		$this->db->update('raised_issue'); 
	}

	public function save_comments($id){ 

		$data = array(   
		'job_order_id' => $id,
		'comments' => $this->input->post('comments',TRUE), 
		'score' => $this->input->post('score',TRUE), 
		'date_created'	      	  =>  datetimedb,
		'user_id'	      	  => $this->session->user_id
		 );

		$result = $this->db->insert('job_order_comments',$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true; 

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}

	public function set_as_completed($id){ 
		$this->db->set('date_completed',datetimedb);  
		$this->db->set('completed_by',$this->session->user_id);  

		$this->db->set('status',0);  
		$this->db->where('id', $id);
		$result = $this->db->update('job_orders');

		 return array(
			'result'          => $result
		);

	}

	public function set_as_inprogress($id){ 
		$this->db->set('date_completed',datetimedb);  
		$this->db->set('completed_by',$this->session->user_id);  

		$this->db->set('status',1);  
		$this->db->where('id', $id);
		$result = $this->db->update('job_orders');

		 return array(
			'result'          => $result
		);

	}


	public function save_company_info($logo){ 

		$this->db->set('company_name',$this->input->post('company_name',TRUE));   
		$this->db->set('contact_number',$this->input->post('contact_no',TRUE));   
		$this->db->set('email',$this->input->post('email',TRUE));   
		$this->db->set('address',$this->input->post('address',TRUE));   
		$this->db->set('abn',$this->input->post('abn',TRUE));   
		$this->db->set('invoice_terms',$this->input->post('invoice_terms',TRUE));   
		if($logo){
		$this->db->set('company_logo',$logo);   
		}
		$this->db->update('company_info'); 

	}

	public function save_invoice(){ 

		$data = array(  
		'bill_to' => $this->input->post('bill_to',TRUE), 
		'date_created'	      	  =>  datetimedb,
		'user_id'	      	  => $this->session->user_id
		 );

		$result = $this->db->insert('invoice',$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true; 

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}
 
	public function save_invoice_jobs($id){ 

		$batch_data = [];

		foreach($this->input->post("jobs") as $job_id){

	   		$data = array(  
			'invoice_id' => $id, 
			'job_id' => $job_id, 
			'date_created'	      	  =>  datetimedb,
			'user_id'	      	  => $this->session->user_id
			 );

	   		array_push($batch_data, $data);

   		}

		$result = $this->db->insert_batch('invoice_jobs',$batch_data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true; 

		return array(
			'result'          => $result,
			'inserted_id'     => $inserted_id 
		);

	}

	public function remove_invoice_jobs($id){ 
 
		$this->db->where('id', $id);
	    $this->db->delete('invoice_jobs');
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function set_invoice_to_close($id){

		$this->db->where('id', $id);
		$this->db->set('status',0);    
		$this->db->set('date_closed',datedb); 
		$this->db->update('invoice'); 
		return ($this->db->affected_rows() != 1) ? false : true; 

	}

	public function set_invoice_to_open($id){

		$this->db->where('id', $id);
		$this->db->set('status',1);    
		$this->db->set('date_closed',null); 
		$this->db->update('invoice'); 
		return ($this->db->affected_rows() != 1) ? false : true; 

	}

	public function load_settings(){
		
		$this->db->select("*");
		$this->db->from("settings"); 
		$query = $this->db->get(); 
		$rs_settings = $query->row(); 

		return array(
			'settings'          => $rs_settings
		);

	}

	public function delete_job($id){
		$this->db->set('active',0);  
		$this->db->where('id', $id);
	    $this->db->update('job_orders');
		return ($this->db->affected_rows() != 1) ? false : true;
	} 
	
	public function save_billing_address($id){

		$this->db->where('id', $id);  
		$this->db->set('billing_address', $this->input->post('billing_address')); 
		$this->db->update('invoice'); 
		return ($this->db->affected_rows() != 1) ? false : true; 

	}

	public function save_fee($id){

		$data = array(  
		'title' 		=> $this->input->post('ds',TRUE), 
		'amount'	    => $this->input->post('amount',TRUE),
		'date_created'	 => datedb, 
		'user_id'       => $this->session->user_id,
		'invoice_id'	 => $id
		 );

		$result = $this->db->insert('invoice_additional_fee',$data);
		return $inserted_id = $this->db->insert_id(); 

	}

	public function remove_fee($id){ 
		$this->db->where('id', $id);
	    $this->db->delete('invoice_additional_fee');
		return ($this->db->affected_rows() != 1) ? false : true;
	} 
	



}