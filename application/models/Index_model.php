<?php  
class Index_model extends CI_model
{ 
	public function construct__(){
		parent::__construct();
	}

	public function validate_login(){

		$result 	  = array(); 
		$account 	  = array();
		$user_id 	  = array();
		$name_of_user = ''; 
		$account_details = array();
		$emp_id = '';
		$user_type = '';
		$user_category = '';
		$name = '';
		$email = '';
		$avatar = '';

		$password = $this->input->post("password",TRUE);
		$phppass = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

		/* ADMIN LOGIN VALIDATION */

		$this->db->where('un',$this->input->post("username",TRUE));
		$admin_account = $this->db->get("account"); 

		if ($admin_account->num_rows() == 1) {  
			
			$rs = $admin_account->row();

			if($rs->allow_login==1){

				$getpwd = $rs->ps; 
				$result = $phppass->CheckPassword($password, $getpwd);

				$account = $rs->admin;

				$rs_user_category      = array();  

				/* user cat */
				$this->db->select("*");
				$this->db->from("fm_category");
				$this->db->where(array('id'=>$rs->user_category));
				$query = $this->db->get(); 
				$rsc = $query->row(); 

				$user_id = $rs->id; 
				$name = $rs->name;
				$email = $rs->email;
				$user_category = $rsc->title;
				$avatar = $rs->avatar;

			}else{

				return array(
					'success'	      => false, 
					'user_id'         => '',
					'user_category'   => '',
					'name_of_user'    => '',
					'email' 		  => '',
					'avatar'		  => ''
					);

			}
  

		} 
        
		//return ($result === true) ? "login success" : "Error usernam/password " ;
		return array(
			'success'	      => $result, 
			'user_id'         => $user_id,
			'user_category'   => $user_category,
			'name_of_user'    => $name,
			'email' 		  => $email,
			'avatar'		  => $avatar
			);

	}


}