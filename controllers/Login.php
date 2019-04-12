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
			$transactionId = guidv4 ( openssl_random_pseudo_bytes ( 16 ) );
    		/*$log = "Transaction ID:" . $transactionId  . PHP_EOL . ''. PHP_EOL.
    		"ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
	        . "Login_Post_Request: " ."Transaction ID:" . $transactionId  . json_encode($_POST).PHP_EOL . "-------------------------" . PHP_EOL;
	        file_put_contents ( logger_url, $log . "\n", FILE_APPEND );*/

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($resolvelogin = $this->all_model->user_login($username, $password))
			{	

				/*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
		        . "Resolve_login: ". "Transaction ID:" . $transactionId  . json_encode($resolvelogin) .PHP_EOL . "-------------------------" . PHP_EOL;
		        file_put_contents ( logger_url, $log . "\n", FILE_APPEND );*/
					// set session user data

					$_SESSION['userid']     = (int)$resolvelogin->UserID;
					$_SESSION['user_email']     = (string)$resolvelogin->Email;
					$_SESSION['user_name']     = (string)$resolvelogin->Name;
					$_SESSION['logged_in']    = (bool)true;
						
					$_SESSION['user_role']    = (string)$resolvelogin->RoleName;
					$_SESSION['user_pass']  = (string)$resolvelogin->Password;

					/*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
			        . "Set_session: ". "Transaction ID:" . $transactionId  . json_encode($_SESSION) .PHP_EOL . "-------------------------" . PHP_EOL;
			        file_put_contents ( logger_url, $log . "\n", FILE_APPEND );
*/

					if($_SESSION['user_role'] == "Admin" )
					{
						redirect('configuration');
					}elseif ($_SESSION['user_role'] == "CEO" ) {
						redirect('configuration');
					}elseif ($_SESSION['user_role'] == "Book Keeper"){
						redirect('configuration');
					}elseif ($_SESSION['user_role'] == "Call Center x"){
						redirect('all-expenses');
					}
			}
			else
			{
				//$_SESSION['pop_mes'] = "Invalid Username & Password";
    	        /*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
		        . "Error: " . "Transaction ID:" . $transactionId  . json_encode($_SESSION).PHP_EOL . "-------------------------" . PHP_EOL;
		        file_put_contents ( logger_url, $log . "\n", FILE_APPEND );*/
				/*popup2();
				$data['title'] = "Login";
				$this->load->view('templates/before-login-header.php',$data);
				$this->load->view('login');
				$this->load->view('templates/footer');*/
				$ret = "Invalid Username or Password";
				$this->session->set_flashdata('error_view',$ret);
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
