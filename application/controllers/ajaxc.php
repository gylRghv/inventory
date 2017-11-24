<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ajaxc extends CI_Controller
	{
		function __construct(){
			parent:: __construct();
			$this->load->driver('session');	
			$this->load->library('form_validation');
			$this->load->helper(array('form','captcha','url','cookie'));
			$this->load->model('ajax_m','m');
		}
		
		function login()
		{	
			if(! $this->session->userdata('id')){				
				$this->createCaptcha();
			}else{
				redirect(base_url('ajaxc/ajax_v'));
			}			
			
        }
		
		function contact()
		{
			$this->load->view('contact');
		}
			

		function createCaptcha()
		{
			$random_number = substr(number_format(time() * rand(),0,'',''),0,4);
	      // setting up captcha config
	      $vals = array(
	             'word' => $random_number,
	             'img_path' => './captcha/',
	             'img_url' => base_url().'captcha/',
	             'img_width' => 174,
	             'img_height' => 35,
	             'expiration' => 180
	            );
	      $data['captcha'] = create_captcha($vals);
	      $this->session->set_userdata('captchaWord',$data['captcha']['word']);
	      $this->load->view('login',$data);
		}

		function login_validation()					
		{	
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');			
			$this->form_validation->set_rules('captcha','Captcha','required');

			if($this->form_validation->run()==TRUE)
			{			
				$email=$this->input->post('email');				
				$password=$this->input->post('password');				
				$response= $this->input->post('captcha');
				$remember= $this->input->post('remember');				
				if(isset($remember)){				
					if(get_cookie('email') && get_cookie('password')) {
						delete_cookie('email');
						delete_cookie('password');
					}
					setcookie('email',$email,time()+(60*60));					
					setcookie('password',$password,time()+(60*60));					
				}
				$result=$this->m->can_login($email,$password);			
				if($response == $this->session->userdata('captchaWord'))
				{						
					if($result)
					{	
						/*$session_data=array('fname' => $fname);*/
						$this->session->set_userdata(['fname'=>$result['0']->{'fname'},'id'=>$result['0']->{'id'}]);						
						if($this->session->has_userdata('fname') and $this->session->has_userdata('id'))
						{ 
							$this->ajax_v();							
						}
						else{
							echo "session doesnt have name or id ";exit;
							redirect(base_url().'ajaxc/login');
						}				
					}else
					{
						$this->session->set_flashdata('error','Invalid Email or Password');
						redirect('ajaxc/login');
					}
				}
				else{
					echo "wrong captcha";
					$this->createCaptcha();
					/*redirect('ajaxc/login');*/
				}
				
			}	
			else
			{	
				echo validation_errors();
				echo "validations wrong...";				
				redirect('ajaxc/login');				
			}	
			
		}

		function signUp(){

			$this->form_validation->set_rules('fname','firstName','trim|required|min_length[2]|alpha');
			$this->form_validation->set_rules('lname', 'lastName', 'trim|required|min_length[2]|alpha');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[login.email]');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('rPass', 'Confirm Password', 'required|matches[password]');	

			if($this->form_validation->run() == False)
			{
				echo validation_errors();
				echo ("not signed up");	
			}else
			{
				echo ("signed up");
				$result=$this->m->signUp();
				/*echo $result;*/				
				$msg['success']= false;
				if($result){
					$msg['success']=true;
				}	
				echo json_encode($msg);
			}
			
		}

		function logout(){
			$this->session->unset_userdata('fname');
			$this->session->unset_userdata('id');
			redirect(base_url().'ajaxc/login');
		}

		function ajax_v()
		{	
					//print_r($config);exit;
			
			if($this->session->userdata('id') and $this->session->userdata('fname') !="")
			{		
				$data3['country'] = $this->m->getCountry();
				$this->load->view('header');
				$this->load->view('ajax_v', $data3);
				$this->load->view('footer');				
				echo "Welcome " .$this->session->userdata('fname')." <br />";
				echo '<button><a href="'.base_url().'ajaxc/logout">Logout</a></button>';
				
			}else{
				redirect(base_url().'ajaxc/login');
			}			     	
		}

		function getState(){

			/*if($country_id == 0){*/
			$country_id = $this->input->post('country_id');				
			$state = $this->m->getState($country_id);			
			$state_select = '';
			if(count($state)>0)
			{				
				$state_select .= "<option value=''>Select State</option>";
				foreach($state as $value)
				{	
					$state_select .="<option value='".$value->state_id."'>".$value->state_name."</option>";
				}
				echo $state_select;
			};

		}

		function showAllData($offset = 0){
			
			$this->load->library('pagination');			
			$config = array(
				'base_url' 		=> base_url('ajaxc/ajax_v'),
				'per_page' 		=> 10,
				'total_rows' 	=> $this->m->num_rows(),
				'uri_segment'	=> 3,
				'use_page_numbers'=> TRUE,
				'full_tag_open' => '<ul class="pagination">',
				'full_tag_close'=> '</ul>',
				'next_tag_open'	=> '<li>',
				'next_tag_close'=> '</li>',
				'prev_tag_open'	=> '<li>',
				'prev_tag_close'=> '</li>',
				'num_tag_open'	=> '<li>',
				'num_tag_close'	=> '</li>',
				'cur_tag_open'	=> '<li class="active"><a>',
				'cur_tag_close'	=> '</a></li>',

			);

			$this->pagination->initialize($config);
/*			$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;								
*/			$result['records'] = $this->m->showAllData($config['per_page'], $offset);
			$result['pagination'] = $this->pagination->create_links();
			echo json_encode($result);						
		}

		function insertData(){			
			$result = $this->m->insertData();			
			$msg['success']= false;
			if($result){
				$msg['success']=true;
			}	
			echo json_encode($msg);					
		}

		function deleteData(){
			$result= $this->m->deleteData();
			$msg['success']= false;
			if($result){
				$msg['success']=true;
			}	
			echo json_encode($msg);
		}

		function edit(){
			$json = array();
			$id=$this->input->get('id');			
			$json['data'] = $this->m->getById($id);
			$country_name = $json['data']->country_name;		
			if($country_name != ""){
				$json['state']=$this->m->getState($country_name);
			};					
			echo json_encode($json);
		}

		function editData(){
			$id=$this->input->post('id');					
			$result= $this->m->editData($id);
			$msg['success']= false;
			if($result){
				$msg['success']=true;
			}	
			echo json_encode($msg);	
		}	
		 function showName(){
		 	$id=$this->input->post('id');
		 	$json['result']= $this->m->showName($id);
		 	echo json_encode($json);
		 }
	}
?>