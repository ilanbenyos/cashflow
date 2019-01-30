<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Psp_income extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper ( 'url_helper' );
		$this->load->helper ( 'url' );
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('all_model');
		$this->load->helper('prodconfig');
	}
	public function index(){
		if (!isset($_SESSION['logged_in'])) {
			redirect('login');
		}
		$data['allPspIncome'] = $this->all_model->getPspIncome();
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('deposit-details',$data);
		$this->load->view('templates/footer');
	}
	public function getBanks($id){
		$data['getpsp'] = $this->all_model->get_psp($id);
		echo json_encode($data);
	}
	public function addDepositDetails(){
		if (!isset($_SESSION['logged_in'])) {
			redirect('login');
		}

		$this->form_validation->set_rules ( 'bank', 'Bank Name', 'trim|required' );
		$this->form_validation->set_rules ( 'psp', 'PSP', 'trim|required' );
		$this->form_validation->set_rules ('pldatereceive', 'Planned Amount Receive', 'trim|required');
		$this->form_validation->set_rules ('acdatereceive', 'Actual Amount Receive', 'trim|required');
		if ($this->form_validation->run () === FALSE) {
			$data['banks'] = $this->all_model->get_all_banks();
			$data['all_psp'] = $this->all_model->get_all_psp();
			
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('add-deposit-details',$data);
			$this->load->view('templates/footer');
		}else{
				$token = $this->input->post('pspin_token');
        		$session_token=null;
        		$session_token = $_SESSION['token_pspincome'];
        		//unset($_SESSION['token_pspincome']);
        		if(!empty($token) == $session_token)
        		{	
        			$pspid = $this->input->post('psp');
        			$BankId = $this->input->post('bankid');
        			$desc = $this->input->post('desc');
        			$pldatereceive = $this->input->post('pldatereceive');
        			$plamtReceived = $this->input->post('plamtReceived');
        			//$plcurr = $this->input->post('plcurr');
        			$curr = $this->input->post('plcurr');
        			$plcommval = $this->input->post('plcommval');
        			$plamtval = $this->input->post('plamtval');
        			$plnetAmt = $this->input->post('plnetAmt');
        			$acdatereceive = $this->input->post('acdatereceive');
        			$acamtReceive = $this->input->post('acamtReceive');
        			//$accurr = $this->input->post('accurr');
        			$accommval = $this->input->post('accommval');
        			$acamtval = $this->input->post('acamtval');
        			$acnetAmt = $this->input->post('acnetAmt');
        			$uid = $this->input->post('userid');

        			$pspIncomeInfo = array(
        				'PspId' => $pspid,
        				'BankId' => $BankId,
        				'Description' => $desc,
        				'Currency' => $curr,
        				'ExpDate' => $pldatereceive,
        				'PlannedAmt' => $plamtReceived,
        				'PlannedCom' => $plcommval,
        				'PlannedNetAmt' => $plnetAmt,
        				'ActualDate' => $acdatereceive,
        				'ActualAmt' => $acamtReceive,
        				'ActualCom' => $accommval,
        				'ActualNetAmt' => $acnetAmt,
        				'CreatedBy' => $uid
        			);
        			$this->db->insert('pspincome',$pspIncomeInfo);
        			$_SESSION['pop_mes'] = "PSP Income Added Successfully."; 
					return 1;
        		}else{
        			$_SESSION['pop_mes'] = "Token does not matched."; 
					return 1;
        		}
		}
	}
	public function update($id){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
	    $this->form_validation->set_rules ( 'bank', 'Bank Name', 'trim|required' );
		$this->form_validation->set_rules ( 'psp', 'PSP', 'trim|required' );
		$this->form_validation->set_rules ('pldatereceive', 'Planned Amount Receive', 'trim|required');
		$this->form_validation->set_rules ('acdatereceive', 'Actual Amount Receive', 'trim|required');
		if ($this->form_validation->run () === FALSE) {
			$data['banks'] = $this->all_model->get_all_banks();
			$data['all_psp'] = $this->all_model->get_all_psp();
			$data['allPspIncome'] = $this->all_model->pspIncome($id);
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('edit-deposit-details',$data);
			$this->load->view('templates/footer');
		}else{
				$token = $this->input->post('pspin_edittoken');
        		$session_token=null;
        		$session_token = $_SESSION['token_editpspincome'];
        		//unset($_SESSION['token_pspincome']);
        		if(!empty($token) == $session_token)
        		{
        			$pspid = $this->input->post('psp');
        			$BankId = $this->input->post('bankid');
        			$desc = $this->input->post('desc');
        			$pldatereceive = $this->input->post('pldatereceive');
        			$plamtReceived = $this->input->post('plamtReceived');
        			//$plcurr = $this->input->post('plcurr');
        			$curr = $this->input->post('plcurr');
        			$plcommval = $this->input->post('plcommval');
        			$plamtval = $this->input->post('plamtval');
        			$plnetAmt = $this->input->post('plnetAmt');
        			$acdatereceive = $this->input->post('acdatereceive');
        			$acamtReceive = $this->input->post('acamtReceive');
        			//$accurr = $this->input->post('accurr');
        			$accommval = $this->input->post('accommval');
        			$acamtval = $this->input->post('acamtval');
        			$acnetAmt = $this->input->post('acnetAmt');
        			$uid = $this->input->post('userid');

        			$updatePspIncomeInfo = array(
        				'PspId' => $pspid,
        				'BankId' => $BankId,
        				'Description' => $desc,
        				'Currency' => $curr,
        				'ExpDate' => $pldatereceive,
        				'PlannedAmt' => $plamtReceived,
        				'PlannedCom' => $plcommval,
        				'PlannedNetAmt' => $plnetAmt,
        				'ActualDate' => $acdatereceive,
        				'ActualAmt' => $acamtReceive,
        				'ActualCom' => $accommval,
        				'ActualNetAmt' => $acnetAmt,
        				'CreatedBy' => $uid
        			);
        			$this->db->where('TransId',$id);
	        		$user = $this->db->update('pspincome',$updatePspIncomeInfo);
	        		$_SESSION['pop_mes'] = "PSP Income Updated Successfully.";
	        		redirect('psp-income');
        		}else{
        			$_SESSION['pop_mes'] = "Token does not matched."; 
					redirect('psp-income');
        		}
		}
	}

}