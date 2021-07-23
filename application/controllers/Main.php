<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()
	{
		$this->load->model('main_model');
		$data['fetch_data'] = $this->main_model->fetch_data();
		$this->load->view('main_view',$data);
	}
	public function form_validation()
	{
		// $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha');

        if ($this->form_validation->run())
        {
            $this->load->model('main_model');
            $data = array(
            	"firstname" => $this->input->post("firstname"),
            	"lastname" => $this->input->post("lastname")
            );

            //update data
            if($this->input->post('update')){
            	$this->main_model->updated_data($data, $this->input->post('hidden_id'));
				redirect(base_url().'main/updated');
            }
            //end of update data
            
            // insert data
            if($this->input->post('insert')){
            	$this->main_model->insert_data($data);
            	redirect(base_url().'main/inserted');
            }
            //end of insert data
            
        }
        else
        {
            $this->index();
        }
	}
	public function inserted(){
		$this->index();
	}

	//Delete
	public function deleted_data(){
		$id = $this->uri->segment(3);
		$this->load->model('main_model');
		$this->main_model->deleted_data($id);
		redirect(base_url().'main/deleted');
	}
	public function deleted(){
		$this->index();
	}
	// Update
	public function update_data($id){
		$id = $this->uri->segment(3);

		$this->load->model('main_model');
		$data['fetch_single_data'] = $this->main_model->fetch_single_data($id);
		$data['fetch_data'] = $this->main_model->fetch_data();
		$this->load->view('main_view',$data);
	}
	public function updated(){
		$this->index();
	}

	//login
	public function login(){
		$data['title'] = "CodeIgniter Simple Login Form with Sessions";
		$this->load->view('login',$data);
	}
	public function login_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		 if ($this->form_validation->run())
	        {
	            $username = $this->input->post('username');
	            $password = $this->input->post('password');

	            // model function
	            $this->load->model('main_model');
				if($this->main_model->can_login($username,$password)){
					$session_data = array(
						'username' => $username
					);
					$this->session->set_userdata($session_data);
					redirect(base_url().'main/enter');
				}else{
					// echo "yes";
	    			// die();
					$this->session->set_flashdata('error','Invalid username and password');
					redirect(base_url().'main/login');
				}

	        }else{
	            $this->login();
	        }

	}

	public function enter(){
		if($this->session->userdata('username') != ''){
			echo '<h2>Welcome to '.$this->session->userdata('username').'</h2>';
			echo '<a href="'.base_url().'main/logout">Logout</a>';
		}else{
			redirect(base_url().'main/login');
		}
	}

	public function logout(){
		$this->session->unset_userdata('username');
		redirect(base_url().'main/login');
	}
}

?>

