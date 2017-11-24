<?php
	
	class lm extends CI_Model
	{
		function can_login($name,$password)
		{
			$this->db->where('name',$name);
			$this->db->where('password',$password);
			$query=$this->db->get('login');
			if($query->num_rows()>0)
			{
				return true;
			}
			else{
				return false;
			}
		}
	}
?>