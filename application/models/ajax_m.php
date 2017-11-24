<?php

	class ajax_m extends CI_Model
	{
		function can_login($email,$password)
		{
			$this->db->select(['id','fname']);
			$this->db->where(['email'=>$email,'password'=>$password]);
			/*$this->db->where('password',$password);*/
			$query=$this->db->get('login');
			if($query->num_rows()>0)
			{
				return $query->result();
			}
			else{
				return false;
			}
		}
		
		public function showAllData($limit,$offset)
		{	
			if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        	}
			$this->db->limit($limit,$offset);
			$query = $this->db->get('ajaxform');
			if($query->num_rows() > 0)
			{
				return $query->result();
			}			
		}
		
		public function num_rows()
		{	
			$query = $this->db->get('ajaxform');
			if($query->num_rows() > 0)
			{
				return $query->num_rows();
			}			
		}

		public function getCountry(){
			$query= $this->db->get('country');
			return $query->result(); 
		}

		public function getState($country_id){
			$query= $this->db->get_where('state', array('country_id' => $country_id));
			return $query->result(); 
		}

		public function insertData()
		{
			$field= array(
            	'name'=>$this->input->post('name'),
            	'address'=>$this->input->post('address'),            	            
            	'country_name'=>$this->input->post('country_name'),
            	'state_name'=>$this->input->post('state_name')
                );
			$this->db->insert('ajaxform',$field);
			if($this->db->affected_rows()>0){
				return true;
			}else{
				return false;
			} 			
		}

		public function signUp()
		{	
			/*echo "okay";exit;*/
			$field= array(
            	'fname'=>$this->input->post('fname'),
            	'lname'=>$this->input->post('lname'),
            	'email'=>$this->input->post('email'),
            	'mobile'=>$this->input->post('mobile'),            	            
            	'password'=>$this->input->post('password'),
            	'status' =>$this->input->post('status')            	
                );
			/*print_r($field);exit;*/
			$this->db->insert('login',$field);
			if($this->db->affected_rows()>0){
				echo "done";
				return true;
			}else{
				echo "not"; 
				return false;
			} 			
		}

		public function getById($id){
			$this->db->where('id',$id);
			$query = $this->db->get('ajaxform');			
			$query= $query->row();			
			return $query;
		}

		public function editData($id)
		{				
			$field= array(
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'country_name' => $this->input->post('country_name'),
				'state_name' => $this->input->post('state_name'),
			);
			$this->db->where('id',$id);
			$this->db->update('ajaxform',$field);
			if($this->db->affected_rows()>0){
				/*echo"success";exit;*/			
				return true;
			}else{
/*				echo"failure";exit;
*/				return false;
			}	
		}

		public function deleteData()
		{
			$id = $this->input->get('id');
			$this->db->where('id',$id);
			$this->db->delete('ajaxform');
			if($this->db->affected_rows()>0){
				return true;
			}else{
				return false;
			}			
		}

		public function showName($country_id){
			$this->db->select('country_name');
			$this->db->where('id',$country_id);
			$query=$this->db->get('country');
			return $query;
		}

		
	}
?>