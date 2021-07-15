<?php  
class Maintenance_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function load_table_data($table_name){

		$rs_table  = array();  

		/* main menu */ 
		$this->db->where(array('status'=>1));
		$table_data = $this->db->get($table_name);
		if($table_data->num_rows()>0){
			foreach($table_data->result() as $data){
				$rs_table[] = $data; 
			}
		}  

		return array(
			'table_data'        =>	 $rs_table
			);

	}

	public function add_table_data($table_name){

		if($table_name=='fm_brick_type'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'manufacturer' 	   => $this->input->post('manufacturer',TRUE),
			'wash_approved' => $this->input->post('wash_approved',TRUE),
			'wash_process' => $this->input->post('wash_process',TRUE),
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => datedb 
			 ); 
		}elseif($table_name=='fm_chemicals'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'retail_price' 	   => $this->input->post('retail_price',TRUE),
			'liter_per_bottle' => $this->input->post('liter_per_bottle',TRUE),
			'bottles_per_pallet' => $this->input->post('bottles_per_pallet',TRUE),
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => datedb 
			 ); 
		}elseif($table_name=='fm_wash_process'){

			$data = array( 
			'title' 		  	   => $this->input->post('title',TRUE),
			'ds' 			 	   => $this->input->post('ds',TRUE),
			'chemicals' 	       => $this->input->post('chemicals',TRUE), 
			'chemicals_ratio' 	   => $this->input->post('chemicals_ratio',TRUE), 
			'user_id'	           => $this->session->user_id,
			'dc' 	 		       => datedb 
			 ); 

		}else{

			$data = array( 
			'title' 		  => $this->input->post('title',TRUE),
			'ds' 			  => $this->input->post('ds',TRUE),
			'user_id'	      => $this->session->user_id,
			'dc' 	 		  => datedb 
			 );

		}

		$result = $this->db->insert($table_name,$data);
		$inserted_id = $this->db->insert_id();
		$result = ($this->db->affected_rows() != 1) ? false : true;

		return array(
			'result'  	   =>   $result,
			'inserted_id'  =>   $inserted_id
			);

	}	

	public function delete_table_data($table_name,$id){

		//$this->db->delete($table_name, array('id' => $id));
		//return ($this->db->affected_rows() != 1) ? false : true;

		$this->db->set('status',0);   
	  
		$this->db->where('id', $id);
		$this->db->update($table_name); 

		return ($this->db->affected_rows() != 1) ? false : true;

	}

	public function load_table_data_one($table_name,$id){

		$rs_table_data  = array();  

		/* one data ony */
		$this->db->select("*");
		$this->db->from($table_name);
		$this->db->where(array('id'=>$id,'status'=>1));
		$query = $this->db->get(); 
		$rs_table_data = $query->row();  

		return array(
			'table_data'  =>   $rs_table_data
			);

	}

	public function update_table_data($table_name,$id){

		$this->db->set('title',$this->input->post('title',TRUE));  
		$this->db->set('ds',$this->input->post('ds',TRUE)); 
		if($table_name=='fm_brick_type'){
		$this->db->set('manufacturer',$this->input->post('manufacturer',TRUE));
		$this->db->set('wash_approved',$this->input->post('wash_approved',TRUE));
		$this->db->set('wash_process',$this->input->post('wash_process',TRUE)); 
		}elseif($table_name=='fm_chemicals'){
		$this->db->set('retail_price',$this->input->post('retail_price',TRUE));
		$this->db->set('liter_per_bottle',$this->input->post('liter_per_bottle',TRUE));
		$this->db->set('bottles_per_pallet',$this->input->post('bottles_per_pallet',TRUE)); 
		}elseif($table_name=='fm_wash_process'){
		$this->db->set('chemicals',$this->input->post('chemicals',TRUE));
		$this->db->set('chemicals_ratio',$this->input->post('chemicals_ratio',TRUE));
		} 
		$this->db->set('user_id',$this->session->user_id);  
		$this->db->set('dc',datedb);   
	  
		$this->db->where('id', $id);
		$this->db->update($table_name); 

		return ($this->db->affected_rows() != 1) ? false : true;

	}


	public function check_title_duplication_validation(){

		$rs_table_data  = array();  

		/* one data ony */
		$this->db->select("id");
		$this->db->from($this->input->post('table_name',TRUE));
		$this->db->where(array('title'=>$this->input->post('title',TRUE),'status'=>1));
		$query = $this->db->get();   

		if($query->num_rows() == 1){
			return  false;
		}else{
			return  true;
		}

	}

	public function check_title_duplication_validation_update($table_name,$id){

		$rs_table_data  = array();  

		/* one data ony */
		$this->db->select("id");
		$this->db->from($table_name);
		$this->db->where(array('title'=>$this->input->post('title',TRUE),'id !='=>$id,'status'=>1));
		$query = $this->db->get();   

		//$this->output->enable_profiler(TRUE);

		if($query->num_rows() == 1){
			return  false;
		}else{
			return  true;
		}

	}



}