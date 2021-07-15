<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {


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

	public function open_status($id=null){

		$module = $this->system_menu;

		$module['module'] = "invoice/open_invoice";
		$module['map_link']   = "home > dashboard";   

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_invoice_jobs();
		$module['invoice_jobs'] = $result['invoice_jobs']; 

		$result = $this->admin_model->load_invoice(1);
		$module['invoice'] = $result['invoice']; 

		$module["id"] = $id;

		$this->load->view('admin/index',$module);  

	}

	public function closed_status($id=null){

		$module = $this->system_menu;

		$module['module'] = "invoice/close_invoice";
		$module['map_link']   = "home > dashboard";   

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_invoice_jobs();
		$module['invoice_jobs'] = $result['invoice_jobs']; 

		$result = $this->admin_model->load_invoice(0);
		$module['invoice'] = $result['invoice']; 

		$module["id"] = $id;

		$this->load->view('admin/index',$module);  

	}


	public function add_invoice_content(){
 
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
 

		$this->load->view('admin/invoice/add_invoice_content',$module);

	}

	public function save_invoice(){

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('bill_to','Bill To','required'); 

		if($this->form_validation->run() == true){

			$result = $this->home_model->save_invoice();  

			if($result["result"]){ 

						/* AUDIT TRAIL */
						$log_module = "invoice > create new invoice";
						$log_description = "create new invoice ".'INV'.sprintf("%07d",$result["inserted_id"]);
						$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

		 				$this->session->set_flashdata("success","invoice created successfuly.");
						redirect("invoice/open_status/".$result["inserted_id"],"refresh"); 

			}else{

		 				$this->session->set_flashdata("error","error saving.");
						redirect("invoice/open_status/","refresh"); 

			}
   
 				
		}

		  
		
	}


	
	public function add_jobs($id,$bill_to){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		$Openssl_security = new Openssl_security;
		$bill_to = $Openssl_security->d($bill_to, $this->config->item('openssl_key'));
 
		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');} 

		$result = $this->admin_model->load_job_orders_builder($bill_to);
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_invoice(1);
		$module['invoice'] = $result['invoice']; 

		$result = $this->admin_model->load_invoice_jobs();
		$module['invoice_jobs'] = $result['invoice_jobs']; 

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$module['id'] = $id; 

		$this->load->view('admin/invoice/add_jobs',$module);

	}


	public function save_jobs($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$this->load->helper(array('form','url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('jobs[]','Jobs','required'); 

		if($this->form_validation->run() == true){

			$result = $this->home_model->save_invoice_jobs($id);   

			/* AUDIT TRAIL */
			$log_module = "invoice > add jobs to invoice";
			$log_description = "add jobs to invoice ".'INV'.sprintf("%07d",$id);
			$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				$this->session->set_flashdata("success","invoice jobs added successfuly.");
			redirect("invoice/open_status/".$result["inserted_id"],"refresh"); 

		}else{ 

			$this->session->set_flashdata("error","error saving. fields are required.");
	    	redirect("invoice/open_status/","refresh"); 
   
		}

		  
		
	}

	public function remove_job_from_invoice($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->home_model->remove_invoice_jobs($id);   

		if($result){

			/* AUDIT TRAIL */
			$log_module = "invoice > remove jobs to invoice";
			$log_description = "remove jobs to invoice";
			$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

			$this->session->set_flashdata("success","invoice jobs removed.");
			redirect("invoice/open_status","refresh"); 

		}else{ 

			$this->session->set_flashdata("error","error saving.");
	    	redirect("invoice/open_status","refresh"); 
   
		}

	}

	public function view_invoice_content($id,$pdf = 'no'){

		$module['id'] = $id;

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
 
		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];
 		
 		$result = $this->admin_model->invoice($id);
		$module['invoice'] = $result['invoice'];

		if(!$module['invoice']){ die('record not found.');}

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_company_info();
		$module['company_info'] = $result['company_info'];

		$result = $this->admin_model->load_invoice_jobs($id);
		$module['invoice_jobs'] = $result['invoice_jobs']; 

		$result = $this->home_model->load_settings();
		$module['settings'] = $result['settings'];

		$result = $this->admin_model->invoice_additional_fee($id);
		$module['invoice_fee'] = $result['invoice_fee'];

		$module['for_email'] = $pdf;

		$this->load->view('admin/invoice/print_invoice_content',$module);

	}

	public function export_to_pdf($id){ 
		//phpinfo();

		$this->view_invoice_content($id,'yes'); 

		// Get output html
		$html = $this->output->get_output();
		 
		$this->load->library('dompdf_gen');
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    $this->dompdf->stream("invoice.pdf");

	    redirect("invoice/open_status","refresh"); 
	     
	     
	}

	public function send_email($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
 
		if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		foreach ($module['system_users'] as $rs) {
			$arr_email[$rs->id] = $rs->email;
		}
 		
 		$result = $this->admin_model->invoice($id);
		$module['invoice'] = $result['invoice'];

		if(!$module['invoice']){ die('record not found.');}

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_company_info();
		$module['company_info'] = $result['company_info'];

		$result = $this->admin_model->load_invoice_jobs($id);
		$module['invoice_jobs'] = $result['invoice_jobs']; 

		$result = $this->home_model->load_settings();
		$module['settings'] = $result['settings'];

		$result = $this->admin_model->invoice_additional_fee($id);
		$module['invoice_fee'] = $result['invoice_fee'];

		$result = $this->home_model->load_settings();
		$module['settings'] = $result['settings'];

		$module['for_email'] = 'yes';

		$admin_email = '';

		$admin_email = $admin_email.')';
		$admin_email = str_replace(', )', '', $admin_email);
 		$from = $module['settings']->system_email;
		//define the headers we want passed. Note that they are separated with \r\n
		$headers = "From: $from\r\n"; 
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		 
		ob_start();  
		$this->load->view('admin/invoice/print_invoice_content',$module);
		$message = ob_get_clean();

		//$message = 'test message : '.$module['order']->job_no;

		$inv_no = 'INV'.sprintf("%07d",$module['invoice']->id);
		$to = $arr_email[$module['invoice']->bill_to];
		 
		if(mail($to,"Copy of Invoice ".$inv_no.".",$message, $headers)){
			$this->session->set_flashdata("success","invoice sent to builder successfuly. To:$to; From:$from; Title:$inv_no;"); 
		}else{
			$this->session->set_flashdata("error","error sending email."); 
		}

		redirect("invoice/open_status","refresh"); 

	}

	public function set_invoice_to_close($id){

			$Openssl_security = new Openssl_security;
			$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

			if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

			$result = $this->home_model->set_invoice_to_close($id);   

			if($result){

				/* AUDIT TRAIL */
				$log_module = "invoice > set invoice to close";
				$log_description = "set invoice ".'INV'.sprintf("%07d",$id)." to close";
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				$this->session->set_flashdata("success","invoice closed successfuly.");
				redirect("invoice/open_status","refresh"); 

			}else{ 

				$this->session->set_flashdata("error","error saving.");
		    	//redirect("invoice/open_status","refresh"); 
		  		$this->open_status();
			}

	}

	public function set_invoice_to_open($id){

			$Openssl_security = new Openssl_security;
			$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

			if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

			$result = $this->home_model->set_invoice_to_open($id);   

			if($result){

				/* AUDIT TRAIL */
				$log_module = "invoice > set invoice open";
				$log_description = "set invoice ".'INV'.sprintf("%07d",$id)." to close";
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				$this->session->set_flashdata("success","invoice re-open successfuly.");
				redirect("invoice/closed_status","refresh"); 

			}else{ 

				$this->session->set_flashdata("error","error saving.");
		    	//redirect("invoice/open_status","refresh"); 
		  		$this->open_status();
			}

	}


	public function add_billing_address_content($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
 
		$module['id'] = $id; 

		$result = $this->admin_model->invoice($id);
		$module['invoice'] = $result['invoice'];

		if(!$module['invoice']){ die('record not found.');}

		$this->load->view('admin/invoice/add_billing_address_content',$module);

	}

	public function save_billing_address($id){

			$Openssl_security = new Openssl_security;
			$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

			if(strtolower($this->session->user_category) != 'admin'){ die('access denied.');}

			$result = $this->home_model->save_billing_address($id);   

			if($result){

				/* AUDIT TRAIL */
				$log_module = "invoice > set invoice billing address";
				$log_description = "set invoice ".'INV'.sprintf("%07d",$id)." billing address";
				$audit_trail = $result = $this->admin_model->audit_trail_logging($log_module,$log_description);

				$this->session->set_flashdata("success","invoice billing successfuly set.");
				redirect("invoice/open_status","refresh"); 

			}else{ 

				$this->session->set_flashdata("error","error saving.");
		    	//redirect("invoice/open_status","refresh"); 
		  		$this->open_status();
			}

	}

	public function add_additional_fees($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));
 
		$module['id'] = $id; 

		$result = $this->admin_model->invoice($id);
		$module['invoice'] = $result['invoice'];

		$result = $this->admin_model->invoice_additional_fee($id);
		$module['invoice_fee'] = $result['invoice_fee'];

		if(!$module['invoice']){ die('record not found.');}

		$this->load->view('admin/invoice/add_additional_fees_content',$module);

	}

	public function save_fee($id){

		$Openssl_security = new Openssl_security;
		$id = $Openssl_security->d($id, $this->config->item('openssl_key'));

		print_r($this->home_model->save_fee($id));  

	}

	public function remove_fee($id){
 
		$this->home_model->remove_fee($id); 
		print_r($id); 

	}
 	
 	public function save_image($id = null){

 		 $key = $id;

 		 $Openssl_security = new Openssl_security;
		 $id = $Openssl_security->d($id, $this->config->item('openssl_key'));

 		$result = $this->admin_model->invoice($id);
		$module['invoice'] = $result['invoice'];

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		foreach ($module['system_users'] as $rs) {
			$arr_email[$rs->id] = $rs->email;
		}

 		 $imgdata = $this->security->xss_clean($this->input->post('img'));
 		 //$temp_file_path = tempnam(sys_get_temp_dir(), 'tempImage'); 
 		 $temp_file_path = './assets/uploaded_files/orders/invoice-'.$key.'.png';
 		 $img = str_replace('data:image/png;base64,', '', $imgdata);
 		 $img = str_replace('[removed]', '', $img);
 		 $img = str_replace(' ', '+', $img);
 		 if(file_put_contents($temp_file_path, base64_decode($img))){
 		 	//echo 'temp file saved. conitiue saving. ';
 		 }else{
 		 	die('nope not saving to temp files.');
 		 }
 		 
 		  

 		    $result = $this->home_model->load_settings();
			$module['settings'] = $result['settings'];

			$module['for_email'] = 'yes';

			$admin_email = '';

			$admin_email = $admin_email.')';
			$admin_email = str_replace(', )', '', $admin_email);
	 		$from = $module['settings']->system_email; 
	 		$inv_no = 'INV'.sprintf("%07d",$id);
			 
 		   	$module['invoice_copy'] = 'invoice-'.$key.'.png';
			
			$headers = "From: $from\r\n"; 
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

 		   	ob_start();  
 		   	$this->load->view('admin/invoice/invoice_copy_content',$module);
 		   	$message = ob_get_clean();

 		   	$to = $arr_email[$module['invoice']->bill_to];
 		    
 		  if(mail ($to, "Invoice Copy - ".$inv_no, $message, "$headers")){
 		  	echo 'email sent!!!!';
 		  }else{
 		  	echo 'fail sending email';
 		  } 
 	}


	
}	