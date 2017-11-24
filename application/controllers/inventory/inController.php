<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class  inController extends CI_Controller
	{
		function __construct(){
			parent:: __construct();
			$this->load->driver('session');	
			$this->load->library('form_validation');
			$this->load->helper(array('form','captcha','url','cookie'));
			$this->load->model('inventory/inModel','inM');
		}

		function inlogin(){
			
			/*if(! $this->session->userdata('ename') and ! $this->session->userdata('code')){*/
				$this->load->view('inventory/inLogin');
			/*}else{
				redirect(base_url('inController/dash'));
			}	*/		
			
		}

		function dash(){

			$this->form_validation->set_rules('ename','ename','required');
			$this->form_validation->set_rules('code','code','required');		
			if($this->form_validation->run()==TRUE)
			{			
				$ename=$this->input->post('ename');				
				$code=$this->input->post('code');				
				$remember= $this->input->post('remember');				
				if($remember){					
					if(get_cookie('ename') OR get_cookie('code')){
						delete_cookie('ename');
						delete_cookie('code');
					}
					set_cookie('ename',$ename,time()+(60*60));					
					set_cookie('code',$code,time()+(60*60));
				}else{
					delete_cookie('ename');
					delete_cookie('code');
				}
				$result=$this->inM->can_login($ename,$code);
				if($result)
				{	
					/*$session_data=array('fname' => $fname);*/
					$this->session->set_userdata(['ename'=>$result['0']->{'EmployeeName'},'EmployeeID'=>$result['0']->{'EmployeeID'}]);						
					if($this->session->has_userdata('ename') and $this->session->has_userdata('EmployeeID'))
					{
						if($ename == "System Admin" AND $code == "ADMIN"){
							$this->admin();
						}else{
							$this->dashboard();
						}						
					}
					else{
						echo "session doesnt have name or code ";
						redirect(base_url().'inventory/inController/inLogin');
					}				
				}else
				{
					$this->session->set_flashdata('error','Invalid Email or Password');
					redirect('inventory/inController/inLogin');
				}			
			}	
			else
			{	
				echo validation_errors();
				echo "validations wrong...";				
				redirect('inventory/inController/inLogin');				
			}	
		}

		function admin(){			 
			// $arr = $this->location();			
			$this->load->view('inventory/admin',$this->location());
		}

		function dashboard(){
			
			$this->load->view('inventory/dashboard',$this->location());
			
		}
		
		function logout(){
			$this->session->unset_userdata('ename');
			$this->session->unset_userdata('EmployeeID');
			redirect(base_url().'inventory/inController/inLogin');		
		}

		function showAllData(){
			$officeID = $this->input->post('officeID');
			$categoryId = $this->input->post('categoryId');			
			$result=$this->inM->showAllData($officeID,$categoryId);			
			echo json_encode($result);
		}

		function location(){
			$EmployeeID=$this->session->userdata('EmployeeID');			
			$arr['result']=$this->inM->location($EmployeeID);
			return $arr;			
		}

		function insertData(){
			$result = $this->inM->insertData();						
			$msg['success']= false;
			if($result){
				$msg['success']=true;
			}	
			echo json_encode($msg);					
		}
		
		function stock(){
			$office = $this->input->get('office');
			/*print_r($office);exit;*/
			$start = $this->input->get('start');
			$end = $this->input->get('end');
			/*echo "start: $start end: $end";
			exit;*/	
			$result = $this->inM->stock($office,$start,$end);
			echo json_encode($result);
		}
	}


?>