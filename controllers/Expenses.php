<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {
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
		$data['getallExpenses'] = $this->all_model->getallExpenses();
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('expenses',$data);
		$this->load->view('templates/footer');
	}
	public function getBanks($id){
		$data['banks'] = $this->all_model->getBanks($id);
		echo json_encode($data);
	}
    public function transferAmt($id){
        $data['transferAmt'] = $this->all_model->getTransferTypeAmount($id);
        echo json_encode($data);
    }
	public function addExpenseDetails(){
		if (!isset($_SESSION['logged_in'])) {
			redirect('login');
		}
		$this->form_validation->set_rules ( 'vendor', 'Vendor Name', 'trim|required' );
		$this->form_validation->set_rules ( 'bankid', 'Bank', 'trim|required' );
		$this->form_validation->set_rules ('expCat', 'Expense Category', 'trim|required');
        $this->form_validation->set_rules ('transType', 'Transfer Type', 'trim|required');
		if ($this->form_validation->run () === FALSE) {
			$data['vendors'] = $this->all_model->vendors();
            $data['transType'] = $this->all_model->getTransferType();
            $data['expCat'] = $this->all_model->get_active_categories();
            $data['banks'] = $this->all_model->get_all_banks();
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('add-expenses',$data);
			$this->load->view('templates/footer');
		}else{
				$token = $this->input->post('expense_token');
        		$session_token=null;
        		$session_token = $_SESSION['token_expense'];
        		//unset($_SESSION['token_pspincome']);
        		if(!empty($token) == $session_token)
        		{	
                    $date = date('Y-m-d H:i:s');

        			$vendor = $this->input->post('vendor');
        			$BankId = $this->input->post('bankid');
        			$desc = $this->input->post('desc');
                    $expCat = $this->input->post('expCat');
                    $transType = $this->input->post('transType');
        			$pldatereceive = $this->input->post('pldatereceive');
        			$plamtReceived = $this->input->post('plamtReceived');
        			$curr = $this->input->post('plcurr');

        			$shares = $this->input->post('shareP');
                    $acdatereceive = $this->input->post('acdatereceive');
                    $acamtReceive = $this->input->post('acamtReceive');
                    $fbc = $this->input->post('fbc');
                    $nfb = $this->input->post('nfb');
        			$uid = $this->input->post('userid');

                    $shareAmount = $this->input->post('shareAmount');
                    $BankOutCommAmount = $this->input->post('BankOutCommAmount');
                    $transferCommP = $this->input->post('transferCommP');
                    $TransferCommAmount = $this->input->post('TransferCommAmount');
                    $outCommP = $this->input->post('outCommP');

                  
			       $from = $pldatereceive;
		
            		$a = explode ( '/', $from );
            		$c = trim ( $a [2], " " );
            		$d = trim ( $a [0], " " );
            		$from = $c . '-' . $a [1] . '-' . $d;
            		
                    $to = $acdatereceive;
                        
                    $a2 = explode ( '/', $to );
                    $c2 = trim ( $a2 [2], " " );
                    $d2 = trim ( $a2 [0], " " );
                    $to = $c2 . '-' . $a2 [1] . '-' . $d2;
                    

        			$expenses = array(
        				'VendorId' => $vendor,
        				'BankId' => $BankId,
        				'Description' => $desc,
        				'Currency' => $curr,
        				'CatId' => $expCat,
        				'ExpDate' => $from,
        				'PlannedAmt' => $plamtReceived,
                        'ActualDate' => $to,
        				'ActualAmt' => $acamtReceive,
        				'BankTransferId' => $transType,
        				'Share' => $shares,
                        'ShareAmount' => $shareAmount,
        				'FinalBankComm' => $fbc,
                        'NetFromBank' => $nfb,
                        'BankOutCommP' => $outCommP,
                        'BankOutCommAmount' => $BankOutCommAmount,
                        'TransferCommP' => $transferCommP,
                        'TransferCommAmount' => $TransferCommAmount,
                        'Active' => 1,
        				'CreatedBy' => $uid,
                        'CreatedOn' => $date,
                        'ModifiedBy' => $uid
        			);
        			$this->db->insert('expenses',$expenses);

                    $this->db->select('BankId,BankName,Balance');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$BankId);
                    $bal = $this->db->get()->row();

                    $UpdatedBal = ($bal->Balance-$nfb);


                    $this->db->where('BankId',$BankId);
                    $this->db->update('bankmaster',array('Balance'=>$UpdatedBal));

        			$_SESSION['pop_mes'] = "Expenses Added Successfully."; 
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
	    $this->form_validation->set_rules ( 'vendor', 'Vendor Name', 'trim|required' );
        $this->form_validation->set_rules ( 'bankid', 'Bank', 'trim|required' );
        $this->form_validation->set_rules ('expCat', 'Expense Category', 'trim|required');
        $this->form_validation->set_rules ('transType', 'Transfer Type', 'trim|required');
		if ($this->form_validation->run () === FALSE) {
            $data['vendors'] = $this->all_model->vendors();
            $data['transType'] = $this->all_model->getTransferType();
            $data['expCat'] = $this->all_model->get_active_categories();
            $data['expenses'] =$this->all_model->getexpenses($id);
            $data['banks'] = $this->all_model->get_all_banks();
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('edit-expenses',$data);
			$this->load->view('templates/footer');
		}else{   
				$token = $this->input->post('editexpense_token');
        		$session_token=null;
        		$session_token = $_SESSION['token_edit-expenses'];
        		//unset($_SESSION['token_pspincome']);
        		if(!empty($token) == $session_token)
        		{   
        			$vendor = $this->input->post('vendor');
                    $BankId = $this->input->post('bankid');
                    $desc = $this->input->post('desc');
                    $expCat = $this->input->post('expCat');
                    $transType = $this->input->post('transType');
                    $pldatereceive = $this->input->post('pldatereceive');
                    $plamtReceived = $this->input->post('plamtReceived');
                    $curr = $this->input->post('plcurr');

                    $shares = $this->input->post('shareP');
                    $acdatereceive = $this->input->post('acdatereceive');
                    $acamtReceive = $this->input->post('acamtReceive');
                    $fbc = $this->input->post('fbc');
                    $nfb = $this->input->post('nfb');
                    $uid = $this->input->post('userid');

                    $shareAmount = $this->input->post('shareAmount');
                    $BankOutCommAmount = $this->input->post('BankOutCommAmount');
                    $transferCommP = $this->input->post('transferCommP');
                    $TransferCommAmount = $this->input->post('TransferCommAmount');
                    $outCommP = $this->input->post('outCommP');
                    

                    $from = $pldatereceive;
    
                    $a = explode ( '/', $from );
                    $c = trim ( $a [2], " " );
                    $d = trim ( $a [0], " " );
                    $from = $c . '-' . $a [1] . '-' . $d;
                    
                    $to = $acdatereceive;
                        
                    $a2 = explode ( '/', $to );
                    $c2 = trim ( $a2 [2], " " );
                    $d2 = trim ( $a2 [0], " " );
                    $to = $c2 . '-' . $a2 [1] . '-' . $d2;
        			
                    $expenses = array(
                        'VendorId' => $vendor,
                        'BankId' => $BankId,
                        'Description' => $desc,
                        'Currency' => $curr,
                        'CatId' => $expCat,
                        'ExpDate' => $from,
                        'PlannedAmt' => $plamtReceived,
                        'ActualDate' => $to,
                        'ActualAmt' => $acamtReceive,
                        'BankTransferId' => $transType,
                        'Share' => $shares,
                        'ShareAmount' => $shareAmount,
                        'FinalBankComm' => $fbc,
                        'NetFromBank' => $nfb,
                        'BankOutCommP' => $outCommP,
                        'BankOutCommAmount' => $BankOutCommAmount,
                        'TransferCommP' => $transferCommP,
                        'TransferCommAmount' => $TransferCommAmount,
                        'Active' => 1,
                        'ModifiedBy' => $uid,
                        'CreatedBy' => $uid,
                    );
                    $this->db->where('TransId',$id);
                    $this->db->update('expenses',$expenses);


                    $this->db->select('BankId,BankName,Balance');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$BankId);
                    $bal = $this->db->get()->row();

                    $UpdatedBal = ($bal->Balance-$nfb);
                    

                    $this->db->where('BankId',$BankId);
                    $this->db->update('bankmaster',array('Balance'=>$UpdatedBal));

	        		$_SESSION['pop_mes'] = "Expenses Updated Successfully.";
	        		redirect('expenses');
        		}else{
        			$_SESSION['pop_mes'] = "Token does not matched."; 
					redirect('expenses');
        		}
		}
	}

}
