<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{

		$this->logged_in();

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

           		if($login) {

           			$logged_in_sess = array(
           				'id' => $login['id'],
				        'username'  => $login['username'],
				        'email'     => $login['email'],
				        'logged_in' => TRUE
					);

					$this->session->set_userdata($logged_in_sess);
           			redirect('dashboard', 'refresh');
           		}
           		else {
           			$this->data['errors'] = 'Incorrect username/password combination';
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
           		$this->data['errors'] = 'Email does not exists';

           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('login');
        }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

	/* Open view to recovery password */
	public function forgot_pass(){
		$this->load->view('forgot_password');
	}

	public function backlogin(){
		$this->load->view('login');
	}

	public function reset_password(){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[6]|max_length[50]|valid_email');
		
			if($this->form_validation->run() == FALSE){
				$this->data['errors'] = 'Email does not valid.';
				$this->load->view('forgot_password', $this->data);
			}
			else{
				$email = trim($this->input->post('email'));
				$result = $this->model_auth->check_email($email);

				if($result){
					$firstname = $this->model_auth->get_first_name_user($email);
					$this->model_auth->send_reset_password_email($email, $firstname);
					$this->load->view('reset_password_email_sent');
				}
				else{
					//Email not found in database
					$this->data['errors'] = 'Email does not exists';
					$this->load->view('forgot_password', $this->data);
				}
			}
		
		}
		else{
			//Email its empty
			$this->data['errors'] = 'Email field does not can be empty.';
			$this->load->view('forgot_password', $this->data);
		}
	}

	public function reset_password_form($email, $email_code){
		if(isset($email, $email_code)){
			$email = trim($email);
			$email_hash = sha1($email, $email_code);
			$verified = $this->model_auth->verify_reset_password_code($email, $email_code);

			if($verified){
				$this->load->view('reset_password', array('email_hash'=> $email_hash, 'email_code' => $email_code, 'email'=> $email));
			}
			else{
				//error
				$this->load->view('errors/html/error_404');
				/*
				$this->load->view('errors/html/error_general');
				print("Se queda aqui we :(");*/
			}
		}
	}

	public function update_password(){

		$this->form_validation->set_rules('email_hash','Email Hash', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]|matches[password_conf]|xss_clean');
		$this->form_validation->set_rules('password_conf', 'Confirmed Password', 'trim|required|min_length[6]|max_length[50]|xss_clean');

		$this->load->view('login', array('errors'=> 'Password successful update.'));

	}
}
