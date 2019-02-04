<?php
class Bank extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->helper ( 'url_helper' );
		$this->load->helper ( 'url' );
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('all_model');
        $this->load->database();
        $this->load->helper('prodconfig');

	}


	public function listbankdata(){
		
		

		$table = 'bankmaster B';
		$columns = 'B.BankName,B.Balance,B.Active,UM.Name,B.BankId';
		$wherecol = 'B.BankId';
		$join = '';
		$data['results'] = $this->all_model->listData($table,$columns,$orderBy='DESC','B.ModifiedOn',$join);
		$obj_result = new \stdclass();
	$obj_result->data = $data['results'];
	echo json_encode($obj_result);
	exit;
	}



	public function index(){
	    //print_r($_SESSION);exit();
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$table = 'bankmaster B';
		$join = '';
		$columns = 'B.BankName,B.Balance,B.Active,UM.Name,B.BankId,B.CurId,C.CurId,C.CurName';
		$wherecol = 'B.BankId';
		
		
		$data['results'] = $this->all_model->listData($table,$columns,$orderBy='DESC','B.Active',$join);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/left-sidebar');
		$this->load->view('configuration/bank', $data);
		$this->load->view('templates/footer');
	}
	
	public function add(){
	    //print_r($_SESSION);exit();
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$this->form_validation->set_rules ( 'BankName', 'Bank Name', 'trim|required' );
			$this->form_validation->set_rules ( 'status', 'Status', 'trim|required' );
		
		if ($this->form_validation->run () === FALSE) {
		$data['currency'] = $this->all_model->getAllCurrency();
		$data ['title'] = 'Add New Bank';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/left-sidebar', $data);
		$this->load->view('configuration/add-new-bank', $data);
		$this->load->view('templates/footer');
		}
		else
		{
		
$token = $this->input->post('my_token_addbank');
        		
        		$session_token=null;
        		
        		$session_token = $_SESSION['form_token_addbank'];
        		unset($_SESSION['form_token_addbank']);
        		
        		if(!empty($token) == $session_token)
        		{
					$userinfo = array(
    	            
    	            'BankName' => $this->input->post('BankName'),
    	            'Balance' => $this->input->post('Balance'),
    	            'CurId' => $this->input->post('cur'),
    	            'InComP' => $this->input->post('InComP'),
    	            'OctComP' => $this->input->post('OutComP'),
    	            'InCom' => $this->input->post('InCom'),
    	            'OutCom' => $this->input->post('OutCom'),
					'Active' => $this->input->post('status'),
					'CreatedBy'=> $_SESSION['userid'],
    	        );
    	        $user = $this->db->insert('bankmaster',$userinfo);
				$_SESSION['pop_mes'] = "Bank Added Successfully."; 
				
				redirect('configuration/bank');
				
					
				}
				else{
					$_SESSION['pop_mes'] = "Token does not matched."; 
				
				redirect('configuration/bank');
					
				}
		
			
		}
	}
	
	
	public function update($id){
	    //print_r($_SESSION);exit();
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$this->form_validation->set_rules ( 'BankName', 'Bank Name', 'trim|required' );
			$this->form_validation->set_rules ( 'status', 'Status', 'trim|required' );
		
		if ($this->form_validation->run () === FALSE) {
		$data ['title'] = 'Update New Bank';
		$table = 'bankmaster';
		$columns = 'BankName,Balance,InComP,OctComP,InCom,OutCom,Active,CreatedBy,CurId';
		$wherecol = 'BankId';
		$data['result'] = $this->all_model->getbankData($table,$columns,$wherecol,$id);
		$data['currency'] = $this->all_model->getAllCurrency();
		$data['currencyId'] = $this->all_model->getCurrency($id);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/left-sidebar', $data);
		$this->load->view('configuration/edit-new-bank', $data);
		$this->load->view('templates/footer');
		}
		else
		{
		
$token = $this->input->post('my_token_addbank');
        		
        		$session_token=null;
        		
        		$session_token = $_SESSION['form_token_addbank'];
        		unset($_SESSION['form_token_addbank']);
        		
        		if(!empty($token) == $session_token)
        		{
					$userinfo = array(
    	            
    	            'BankName' => $this->input->post('BankName'),
    	            'Balance' => $this->input->post('Balance'),
    	            'CurId' => $this->input->post('cur'),
    	            'InComP' => $this->input->post('InComP'),
    	            'OctComP' => $this->input->post('OutComP'),
    	            'InCom' => $this->input->post('InCom'),
    	            'OutCom' => $this->input->post('OutCom'),
					'Active' => $this->input->post('status'),
					'CreatedBy'=> $_SESSION['userid'],
    	        );
				$this->db->where('BankId',$id);
	        $user = $this->db->update('bankmaster',$userinfo);
    	       
				$_SESSION['pop_mes'] = "Bank Details Updated Successfully."; 
				
				redirect('configuration/bank');
				
					
				}
				else{
					$_SESSION['pop_mes'] = "Token does not matched."; 
				
				redirect('configuration/bank');
					
				}
		
			
		}
	}
	
	
	
}
