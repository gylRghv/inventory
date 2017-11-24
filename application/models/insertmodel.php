<?php

	class insertmodel extends CI_Model{

		function form_insert($data){

			 $this->db->insert('ciform', $data);
			
		}

		function form_show(){
			$query = $this->db->get('ciform');
			if($query->num_rows()>0){
			return $query->result();
			}
		}

		function getPostsByID($id){
			$this->db->where('id',$id);
			$query = $this->db->get('ciform');
			if($query->num_rows()>0){
			return $query->row();
			}
		}

		function update($id,$data){
								
			$this->db->where('id',$id);
 		    $this->db->update('ciform', $data);
        	
        	
		}

		function delete($id){
			$this->db->where('id',$id);
			$this->db->delete('ciform');
			/*alert('deleted successfully...redirecting to original form');*/
			/*redirect('myformcontroller');*/
			$this->form_show();
		}

	}
?>
	
				


	