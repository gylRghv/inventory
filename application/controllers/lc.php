<?php
	
	class lc extends CI_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->library(array('form_validation'));
			$this->load->helper('form');
			$this->load->model('lm');
			
		}

		function login(){			
			/*$data = array(
					'img_path' => '' ,
					'img_url' => '',
					'width' => '150',
					'height' => '70'
				);

			$captcha=create_captcha($data);*/
			$this->load->view('login');			
		}
		function login_validation(){
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('password','Password','required');
			/*$this->form_validation->set_rules('captcha','Captcha','required');
			$captcha=set_value('captcha');*/
			/*$word = $this->session->userdata('captchaWord');*/
			$response= $this->input->post('g-recaptcha-response');
			if($this->form_validation->run()==TRUE && isset($response))
			{	
				/*$this->session->unset_userdata('captcha');*/				
				$name=$this->input->post('name');
				$password=$this->input->post('password');				
				$result=$this->lm->can_login($name,$password);				
				if($result){					
					$session_data=array(
							'name' => $name
					);
					$this->session->set_userdata($session_data);
					redirect(base_url().'lc/enter');
				}else{
					$this->session->set_flashdata('error','Invalid Username or Password!');
					redirect(base_url().'lc/login');
				}	
			}	
			else
			{
				$this->login();
			}			
			/*else
			{
				$this->session->set_flashdata('error1','invalid Captcha');
				redirect(base_url().'lc/login');
			}	*/
		}

		function enter(){
			if($this->session->userdata('name') !=""){
				echo "Welcome " .$this->session->userdata('name')."<br />";
				echo '<button><a href="'.base_url().'lc/logout">Logout</a></button>';
			}else{
				redirect(base_url().'lc/login');
			}
		}

		function logout(){
			$this->session->unset_userdata('name');
			redirect(base_url().'lc/login');
		}
	}
?>