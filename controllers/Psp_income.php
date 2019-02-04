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
        public function que(){
                /*$this->db->where('TransId', 3);
                $this->db->delete('pspincome');*/
                //$this->db->query('ALTER TABLE `pspincome` ADD `PlannedComP` DECIMAL(13,2) NOT NULL AFTER `PlannedCom`');
                //$this->db->query('ALTER TABLE `pspincome` ADD `PlannedComP` DECIMAL(13,2) NOT NULL AFTER `PlannedCom`');
                //$this->db->query('ALTER TABLE `pspincome` ADD `ActualComP` DECIMAL(13,2) NOT NULL AFTER `ActualCom`;');
                 /*$query4 =  $this->db->query("DESC pspincome");
                $data_2= $query4->result();
                print_r($data_2);
               $query3 =  $this->db->query("ALTER TABLE `pspincome` CHANGE `ActualComP` `ActualComP` DECIMAL(13,2) NOT NULL DEFAULT '0'");*/
                //$data_1= $query3->result();
               

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
		//$this->form_validation->set_rules ('acdatereceive', 'Actual Amount Receive', 'trim|required');
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
        			if($plcommval == ""){
        				$plcommval = 0;
        			}
        			if($accommval == ""){
        				$accommval = 0;
        			}
                    if ($plamtval == "") {
                            $plamtval = 0;
                    }
                    if($acamtval == ""){
                        $acamtval = 0;
                    }
					
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

                    /*if ($acdatereceive == "") {
                        $to = "";
                    }else{
                        $to = $acdatereceive;
                        
                        $a2 = explode ( '/', $to );
                        $c2 = trim ( $a2 [2], " " );
                        $d2 = trim ( $a2 [0], " " );
                        $to = $c2 . '-' . $a2 [1] . '-' . $d2;
                    }
                    if ($acamtReceive == "") {
                        $acamtReceive = 0;
                    }*/
        			$pspIncomeInfo = array(
        				'PspId' => $pspid,
        				'BankId' => $BankId,
        				'Description' => $desc,
        				'Currency' => $curr,
        				'ExpDate' => $from,
        				'PlannedAmt' => $plamtReceived,
        				'PlannedCom' => $plamtval,
                        'PlannedComP' => $plcommval,
        				'PlannedNetAmt' => $plnetAmt,
        				'ActualDate' => $to,
        				'ActualAmt' => $acamtReceive,
        				'ActualCom' => $acamtval,
                        'ActualComP' => $accommval,
        				'ActualNetAmt' => $acnetAmt,
        				'CreatedBy' => $uid
        			);
                    $table = 'bankmaster';
                    $columns = 'BankName,Balance';
                    $wherecol = 'BankId';
                    $data['getBankBal'] = $this->all_model->getbankData($table,$columns,$wherecol,$BankId);
                    $updatedBal = ($data['getBankBal']->Balance + $acnetAmt);


                    $this->db->where('BankId',$BankId);
                    $this->db->update('bankmaster',array('Balance'=>$updatedBal));
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
		//$this->form_validation->set_rules ('acdatereceive', 'Actual Amount Receive', 'trim|required');
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

                    $acamtnetReceivebefore = $this->input->post('acamtnetReceivebefore');

        			if($plcommval == ""){
        				$plcommval = 0;
        			}
        			if($accommval == ""){
        				$accommval = 0;
        			}
                    if ($plamtval == "") {
                        $plamtval = 0;
                    }
                    if($acamtval == ""){
                        $acamtval = 0;
                    }

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
                    /*if ($acdatereceive == "") {
                    $to = "";
                    }else{
                        $to = $acdatereceive;
                        
                        $a2 = explode ( '/', $to );
                        $c2 = trim ( $a2 [2], " " );
                        $d2 = trim ( $a2 [0], " " );
                        $to = $c2 . '-' . $a2 [1] . '-' . $d2;
                    }
                    if ($acamtReceive == "") {
                        $acamtReceive = 0;
                    }*/

                                $log = "ip:" . $_SERVER ['REMOTE_ADDR'] . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL 
                . "POST edit deposit: " .json_encode($_POST) . PHP_EOL . "-------------------------" . PHP_EOL;
                                        file_put_contents ( 'Logs/adddeposit.txt', $log . "\n", FILE_APPEND );

                                        $log = "ip:" . $_SERVER ['REMOTE_ADDR'] . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL 
                . "FROM: " . $from. PHP_EOL . "-------------------------" . PHP_EOL;
                                        file_put_contents ( 'Logs/adddeposit.txt', $log . "\n", FILE_APPEND );

                                        $log = "ip:" . $_SERVER ['REMOTE_ADDR'] . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL 
                . "TO: " . $to. PHP_EOL . "-------------------------" . PHP_EOL;
                                        file_put_contents ( 'Logs/adddeposit.txt', $log . "\n", FILE_APPEND );

                                

        			$updatePspIncomeInfo = array(
        				'PspId' => $pspid,
        				'BankId' => $BankId,
        				'Description' => $desc,
        				'Currency' => $curr,
        				'ExpDate' => $from,
        				'PlannedAmt' => $plamtReceived,
        				'PlannedCom' => $plamtval,
                        'PlannedComP' => $plcommval,
        				'PlannedNetAmt' => $plnetAmt,
        				'ActualDate' => $to,
        				'ActualAmt' => $acamtReceive,
        				'ActualCom' => $acamtval,
                        'ActualComP' => $accommval,
        				'ActualNetAmt' => $acnetAmt,
        				'CreatedBy' => $uid
        			);

                    $table = 'bankmaster';
                    $columns = 'BankName,Balance';
                    $wherecol = 'BankId';
                    $data['getBankBal'] = $this->all_model->getbankData($table,$columns,$wherecol,$BankId);
                    /*if (($data['getBankBal']->Balance) > 0) {
                        echo 'if';
                        echo '<br>';*/
                        
                        //if ($data['getBankBal']->Balance > 0 ) {
                            $updatedBal = (($data['getBankBal']->Balance) - ($acamtnetReceivebefore));

                            /*echo 'bank balance:'.$data['getBankBal']->Balance;
                            echo '<br>';
                            echo 'Amount receive before:'.$acamtnetReceivebefore;
                            echo '<br>';
                            echo 'updatedBal'.$updatedBal;
                            echo '<br>';
                            echo 'amount receive after'.$acamtReceive;
                            echo '<br>';*/
                            $updatedBal = (($updatedBal)+($acnetAmt));
                            //echo 'new updated bal'.$updatedBal;

                        //}
                        /*exit();
                    }else{
                        echo 'else';
                        echo '<br>';
                        $updatedBal = (($acamtnetReceivebefore) - ($datea['getBankBal']->Balance));
                        echo 'bank balance:'.$data['getBankBal']->Balance;
                        echo '<br>';
                        echo 'Amount receive before:'.$acamtnetReceivebefore;
                        echo '<br>';
                        echo 'updatedBal'.$updatedBal;
                        echo '<br>';
                        echo 'amount receive after'.$acamtReceive;
                        echo '<br>';
                        //$updatedBal = (($updatedBal)+($acamtReceive));
                        echo 'new updated bal'.$updatedBal;
                        exit();
                    }*/
                    $this->db->where('BankId',$BankId);
                    $this->db->update('bankmaster',array('Balance'=>$updatedBal));
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
