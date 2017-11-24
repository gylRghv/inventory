<?php 
	
	class inModel extends CI_Model
	{
		public function can_login($ename,$code)
		{
			$this->db->select(['EmployeeID','EmployeeName','EmployeeCode']);
			$this->db->where(['EmployeeName'=>$ename,'EmployeeCode'=>$code]);
			/*$this->db->where('code',$code);*/
			$query=$this->db->get('employee');
			if($query->num_rows()>0)
			{
				return $query->result();
			}
			else{
				return false;
			}
		}

		public function showAllData($officeID,$categoryId)
		{							
			$this->db->select(array('location_wise_item.quantity', 'item.itemName','item.itemId'))
							->join('item','location_wise_item.itemId = item.itemId','inner')
							->where('location_wise_item.officeID',$officeID)
							->where('location_wise_item.categoryId',$categoryId);
			$query=$this->db->get('location_wise_item');
			/*print_r($query->result());exit;	*/		
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else{
				echo "test fail";exit;
			}			
		}

		public function location($EmployeeID)
		{
			if($EmployeeID != '1'){
				$this->db->select('officeID');
				$this->db->where('EmployeeID',$EmployeeID);
				$query = $this->db->get('map');
				$query = $query->result();
				/*echo "<pre>";print_r($query[0]->{'officeID'});echo "</pre>";exit;*/	
				$query1=array();
				foreach($query as $key=>$value)
				{	
					$this->db->select(array('officeID','locationName'));
					$this->db->where('officeID',$value->{'officeID'});
					$query1[] = $this->db->get('office_address')->result();
				}				
				return $query1;
			}else{
				$this->db->select(array('officeID','locationName'));
				$query = $this->db->get('office_address');
				return $query->result();
/*				 echo "<pre>";print_r($query->result());exit;
*/			}	
		}

		public function insertData()
		{	
			$itemId	  = $this->input->post('itemId');						
			$quantity = $this->input->post('quantity');
			$officeID = $this->input->post('officeID');			
			$field = array(
				'itemID' => $itemId,
				'officeID' => $officeID,
				'quantity' 	=>$quantity,
				'consumed'	=>$this->input->post('consumed'),
				'createdOn' =>$this->input->post('updatedOn'),
				'createdBy' =>$this->input->post('EmployeeID'),
				'updatedOn' =>$this->input->post('updatedOn'),
				'updatedBy'=>$this->input->post('EmployeeID')
			);
			$query1 = $this->db->insert('stock_activity',$field);

			$this->db->set('quantity', $quantity);
			$this->db->where('itemId',$itemId);
			$this->db->where('officeID',$officeID);
			$query2 = $this->db->update('location_wise_item');			
			/*$query2 = $this->db->query(UPDATE `location_wise_item' SET `quantity`=$quantity WHERE );*/
			if($query1->num_rows>0 AND $query2->num_rows>0){
				return true;
			}else{
				return false;
			}					
		}

		function stock($officeID,$start,$end){						
			$this->db->select(['item.itemName','stock_activity.*','office_address.locationName','employee.EmployeeName','item_c.categoryName'])
						->join('item','stock_activity.itemId = item.itemId','inner')
						->join('office_address','stock_activity.officeID = office_address.officeID','inner')
						->join('employee','stock_activity.createdBy = employee.EmployeeID','inner')
						->join('item_c','item.categoryId = item_c.categoryId','inner')
						->where_in('stock_activity.officeID',$officeID);
			
			$where = array('stock_activity.createdOn >=' => $start, 'stock_activity.createdOn <=' =>$end);			
			/*$where = "`stock_activity`.`officeID` = $officeID AND `stock_activity`.`createdOn` >= $start AND `stock_activity`.`createdOn` <= $end";	*/		
			$this->db->where($where);					
			$query = $this->db->get('stock_activity');

			/*$query = "SELECT `item`.`itemName`, `stock_activity`.`createdOn`, `stock_activity`.`id` FROM `stock_activity` INNER JOIN `item` ON `stock_activity`.`itemId` = `item`.`itemId` WHERE `stock_activity`.`officeID` = $officeID and date('stock_activity.createdOn') >=$start and date('stock_activity.createdOn') <=$end";*/
			/*print_r($query->result());exit;*/
			return $query->result();
			
		}

	}
?>