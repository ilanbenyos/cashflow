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
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$this->form_validation->set_rules ( 'BankName', 'Bank Name', 'trim|required' );
			$this->form_validation->set_rules ( 'status', 'Status', 'trim|required' );
		
		if ($this->form_validation->run () === FALSE) {
		$data['currency'] = $this->all_model->getAllCurrency();
		$data ['title'] = 'Add New Bank';
		$data['transferType'] = $this->all_model->getTransferType();
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

    	        $BankId = $this->db->insert_id();
    	        /*$transfertype = $this->input->post('transfertype');
    	        $amount = $this->input->post('amount');*/

    	        /*$bankTransferType = array(
    	        	'BanktransferName' => $transfertype,
    	        	'BankId' => $BankId,
    	        	'Active' => 1,
    	        	'CreatedBy' => $_SESSION['userid'],
    	        );
    	        $this->db->insert('banktransfertype',$bankTransferType);

    	        $BankTransferId = $this->db->insert_id();*/
    	       /* $this->db->where('BankId',$BankId);
    	        $this->db->delete('banktransfercharges');*/

    	        $BankTransferId = $this->input->post('transfertype');
    	        $amount = $this->input->post('amount');
    	        $data =array_combine($BankTransferId,$amount);
    	        /*print_r($BankTransferId);
    	        echo "</br>";
    	        print_r($amount);
    	         echo "</br>";
    	         print_r($data);*/
    	        foreach ($data as $key => $amt) {
    	        	$transfercharges = array(
		    	        	'BankTransferId' => $key,    
		    	        	'BankId' => $BankId,
		    	        	'Amount' => $amt,
		    	        	'CreatedBy' => $_SESSION['userid'],
		    	        	'ModifiedBy' => $_SESSION['userid']
		    	        );
    	        	$this->db->insert('banktransfercharges',$transfercharges);
    	        }
    	        

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
	    //print_r($id);exit();
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
		$data['transferDetails'] = $this->all_model->BankTransferdetails($id);
		$data['transferData'] = $this->all_model->getBankTransferdetails($id);  // to get all banktranfer ad and amount related to bank
		$data['transferType'] = $this->all_model->getTransferType();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/left-sidebar', $data);
		$this->load->view('configuration/edit-new-bank', $data);
		$this->load->view('templates/footer');
		}
		else
		{
				$token = $this->input->post('my_token_editbank');
        		$session_token=null;
        		$session_token = $_SESSION['form_token_editbank'];
        		unset($_SESSION['form_token_editbank']);
        		
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
					'ModifiedBy'=> $_SESSION['userid'],
    	        );
				$this->db->where('BankId',$id);
	        	$user = $this->db->update('bankmaster',$userinfo);
	        	
	        	$this->db->select('BankId,BankName');
	        	$this->db->from('bankmaster');
	        	$this->db->where('BankId',$id);
	        	$BankId = $this->db->get()->row();
	        	$BankId = $BankId->BankId;
	        	$transfertype = $this->input->post('transfertype');
    	        $amount = $this->input->post('amount');


    	        $BankTransferId = $this->input->post('transfertype');
    	        $amount = $this->input->post('amount');
    	        $data =array_combine($BankTransferId,$amount);
    	        
				 
				 $this->db->where ( 'BankId', $BankId );
				 $this->db->delete ( 'banktransfercharges' );
				 
    	        foreach ($data as $key => $amt) {
    	        	$transfercharges = array(
		    	        	'BankTransferId' => $key,    
		    	        	'BankId' => $BankId,
		    	        	'Amount' => $amt,
		    	        	'ModifiedBy' => $_SESSION['userid'],
		    	        );
    	        	$this->db->insert('banktransfercharges',$transfercharges);
    	        }

				$_SESSION['pop_mes'] = "Bank Details Updated Successfully.";
				redirect('configuration/bank');	
				}
				else{
					$_SESSION['pop_mes'] = "Token does not matched."; 
				
				redirect('configuration/bank');
					
				}	
		}
	}
	public function bankTransferType(){
		$data['transferType'] = $this->all_model->getTransferType();
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('configuration/transfer_type',$data);
		$this->load->view('templates/footer');
	}
	public function addBankTransferType(){
		if(!isset($_SESSION['logged_in'])){
			redirect('login');
		}
		$this->form_validation->set_rules ( 'type', 'Transfer Type', 'trim|required' );
		if ($this->form_validation->run () === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('configuration/transfer_type');
			$this->load->view('templates/footer');
		}else{
				$token = $this->input->post('type_token');
        		$session_token=null;
        		$session_token = $_SESSION['new_type'];
        		if(!empty($token) == $session_token){	
        			$date = date('Y-m-d H:i:s');
        			$type = $this->input->post('type');
        			$uid = $this->input->post('userid');
        			//$desc = $this->input->post('desc');
        			$addType = array(
        				'BanktransferName' => $type,
        				'CreatedBy' => $uid,
        				'Active' => 1,
        				'CreatedOn' =>$date
        			);
        			$this->db->insert('banktransfertype',$addType);
        			$_SESSION['pop_mes'] = "Bank Transfer Type Added Successfully."; 
					return 1;
        		}else{
        			$_SESSION['pop_mes'] = "Token does not matched."; 
					return 1;
        		}
		}
	}
	public function updateBankTransferType($id){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
	    $this->form_validation->set_rules ( 'type', 'Transfer Type', 'trim|required' );
	    if ($this->form_validation->run () === FALSE) {
	    	$data['transferType'] = $this->all_model->transferType($id);
			$this->load->view('configuration/edit_transfer_type',$data);
		}else{
			$token = $this->input->post('editcategory_token');
        		$session_token=null;
        		$session_token = $_SESSION['edit_category'];
        		if(!empty($token) == $session_token){
        			$type = $this->input->post('type');
        			$uid = $this->input->post('userid');

        			$updateCat = array(
        				'BanktransferName' => $type,
        				'ModifiedBy' => $uid
        			);
        			$this->db->where('BankTransferId',$id);
        			$this->db->update('banktransfertype',$updateCat);
        			$_SESSION['pop_mes'] = "Bank Transfer Type Updated Successfully."; 
					return 1;
        		}else{
        			$_SESSION['pop_mes'] = "Token does not matched."; 
					return 1;
        		}

		}

	}
	public function test(){ // not in use
		//$data['transferType'] = $this->all_model->getBankTransferData();
		$date = date("Y-m-d");
    	echo date('Y-m-d', strtotime($date. ' + 180 days'));
    	exit();
		$data['transferType'] = $this->all_model->getTransferType();
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('configuration/bank_transfer_type',$data);
		$this->load->view('templates/footer');
		
	}
}
