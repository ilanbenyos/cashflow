<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper(array('url'));
		$this->load->model('all_model');
		$this->load->helper('prodconfig');
	}

	public function index()
	{	
	   
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/before-login-header.php');
			$this->load->view('login');
			$this->load->view('templates/footer');
		}else{

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($resolvelogin = $this->all_model->user_login($username, $password))
			{	
					// set session user data

					$_SESSION['userid']     = (int)$resolvelogin->UserID;
					$_SESSION['user_email']     = (string)$resolvelogin->Email;
					$_SESSION['user_name']     = (string)$resolvelogin->Name;
					$_SESSION['logged_in']    = (bool)true;
						
					$_SESSION['user_role']    = (string)$resolvelogin->RoleName;
					$_SESSION['user_pass']  = (string)$resolvelogin->Password;


					if($_SESSION['user_role'] == "Admin" )
					{
						redirect('configuration/users');
					}elseif ($_SESSION['user_role'] == "CEO" ) {
						redirect('configuration/users');
					}
			}
			else
			{
				$_SESSION['pop_mes'] = "Invalid Username & Password";
				/*popup2();
				$data['title'] = "Login";
				$this->load->view('templates/before-login-header.php',$data);
				$this->load->view('login');
				$this->load->view('templates/footer');*/
				redirect('login');
			}
		}
	}
	public function logout()
	{
	
		$this->session->sess_destroy();
		redirect('login');
	
	}
}
