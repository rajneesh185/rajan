<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
 
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

	public function job_order(){

		$module = $this->system_menu; 

		$module['module'] = "reports/job_order";
		$module['map_link']   = "reports > job_order"; 
 
		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];
 

		$this->load->view('admin/index',$module);

	} 

	public function generate_job_order_report(){

		$module = $this->system_menu; 

		$module['module'] = "reports/cleaner";
		$module['map_link']   = "reports > cleaner"; 
 
		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_all_site_report();
		$module['site_reports'] = $result['site_reports'];

		$module['report_type'] = $this->input->post('report_type');
		$module['date_from'] = $this->input->post('date_from');
		$module['date_to'] = $this->input->post('date_to');

		$result = $this->admin_model->load_company_info();
		$module['company_info'] = $result['company_info'];

		$module['invoice_tab'] = $this->input->post('invoice_tab');

		if($module['invoice_tab'] == 1){
			$result = $this->admin_model->load_invoice_jobs();
			$module['invoice_jobs'] = $result['invoice_jobs']; 

			$result = $this->admin_model->load_invoice(3);
			$module['invoice'] = $result['invoice']; 
		}

		$result = $this->admin_model->load_job_order_comments();
		$module['comments'] = $result['comments'];

		$result = $this->admin_model->load_all_raised_issue();
		$module['raised_issue'] = $result['raised_issue'];

		$this->load->view('admin/reports/'.strtolower($this->session->user_category).'_generate_job_order_report',$module);

	} 


	public function cleaner_score_report(){

		$module = $this->system_menu; 

		$module['module'] = "reports/cleaner_score_report";
		$module['map_link']   = "reports > job_order"; 
 
		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];
 

		$this->load->view('admin/index',$module);

	} 

	public function generate_cleaner_score_report(){

		$module = $this->system_menu; 

		$module['module'] = "reports/cleaner";
		$module['map_link']   = "reports > cleaner"; 
 
		$result = $this->admin_model->load_filemaintenance('fm_wash_process');
		$module['wash_process'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_brick_type');
		$module['brick_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_category');
		$module['user_category'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_sand_type');
		$module['sand_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_cement_type');
		$module['cement_type'] = $result['maintenance_data'];

		$result = $this->admin_model->load_filemaintenance('fm_chemicals');
		$module['chemicals'] = $result['maintenance_data']; 

		$result = $this->admin_model->load_system_users();
		$module['system_users'] = $result['system_users'];

		$result = $this->admin_model->load_job_orders();
		$module['job_orders'] = $result['job_orders'];

		$result = $this->admin_model->load_all_site_report();
		$module['site_reports'] = $result['site_reports'];

		$module['report_type'] = $this->input->post('report_type');
		$module['date_from'] = $this->input->post('date_from');
		$module['date_to'] = $this->input->post('date_to');

		$result = $this->admin_model->load_company_info();
		$module['company_info'] = $result['company_info']; 
		 

		$result = $this->admin_model->load_job_order_comments();
		$module['comments'] = $result['comments'];

		$result = $this->admin_model->load_all_raised_issue();
		$module['raised_issue'] = $result['raised_issue'];

		$this->load->view('admin/reports/generate_cleaner_score_report',$module);

	} 


}