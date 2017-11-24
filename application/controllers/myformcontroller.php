<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	

	class myformcontroller extends CI_Controller {
		
		function __construct(){
			parent:: __construct();
			$this->load->helper('form');
            $this->load->library('form_validation');
			$this->load->model('insertmodel','m');
		}

        public function index()
        {	
                      
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[30]|alpha');
            $this->form_validation->set_rules('password', 'Password', 'required',
                    array('required' => 'You must provide a %s.')
            );
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            /*$this->form_validation->set_rules('image', 'Image', 'required');*/
      		

      		//SUBMIT FUNCTION
      		
          	if($this->input->post('submit'))
          	{
             	if ($this->form_validation->run() == FALSE)
	                {
	                	$this->load->view('header.php'); 
	                	$this->load->view('myformview',$data0);
	                	$this->load->view('footer.php');
	                }
	                else
	                {
                        $data= array(
                        	'username'=>$this->input->post('username'),
                        	'password'=>$this->input->post('password'),
                        	'email'=>$this->input->post('email'),
                        	/*'image'=>$this->input->post('image')*/
                       	);
                       	/*$data0['checked'] = 'TRUE';*/
                        $this->m->form_insert($data);
                        //extracting data from database;
                    }
	        } 

            /*if(isset($_GET['opt']) && $_GET['opt'] == true) {
                $data0['checked'] = 'TRUE';
            } */
        $data0['posts'] = $this->m->form_show();
        $this->load->view('header.php');                                       
        $this->load->view('myformview', $data0);
        $this->load->view('footer.php');
    
    	}

    	
    	public function update(){
    		$id = $this->uri->segment(3);
       		$data2['posts'] = $this->m->getPostsById($id);
       		$this->load->view('header');
    		$this->load->view('update',$data2);
    		$this->load->view('footer.php');
    		if($this->input->post('update'))
    		{  
                $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[30]|alpha');
                $this->form_validation->set_rules('password', 'Password', 'required',
                        array('required' => 'You must provide a %s.')
                );
                $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                /*$this->form_validation->set_rules('image', 'Image', 'required');*/
    			$data= array(
                        	'username'=>$this->input->post('username1'),
                        	'password'=>$this->input->post('password1'),
                        	'email'=>$this->input->post('email1')
                        	);
    			$id= $this->input->post('hidden');
	        	$this->m->update($id,$data);
	   			//$data0['posts']=$this->m->form_show();
	    		//$data0['checked'] = "TRUE";
	    		
	    		redirect('myformcontroller');
	            
	    	}

    	}

    	
    	public function delete(){
    		$data0['checked'] = 'TRUE';
    		$id = $this->uri->segment(3);
    		
    		$this->m->delete($id);
    		$data0['posts']=$this->m->form_show();
                        $this->load->view('header.php');                                       
                        $this->load->view('myformview',$data0);
                        $this->load->view('footer.php');
    		
    	}
    }

?>