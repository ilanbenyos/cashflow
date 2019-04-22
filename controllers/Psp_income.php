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
		$this->form_validation->set_rules ('pldatereceive', 'Planned Date Receive', 'trim|required');
		//$this->form_validation->set_rules ('acdatereceive', 'Actual Amount Receive', 'trim|required');
		if ($this->form_validation->run () === FALSE) {
			$data['banks'] = $this->all_model->get_all_banks();
			$data['all_psp'] = $this->all_model->get_all_psp();

			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('add-deposit-details',$data);
			$this->load->view('templates/footer');
		}else{   
                
                //Log
                $this->db->select('UserID,Name');
                $this->db->from('usermaster');
                $this->db->where('UserID',$this->input->post('userid'));
                $userName = $this->db->get()->row();
                $userName = $userName->Name;
                $transactionId = guidv4 ( openssl_random_pseudo_bytes ( 16 ) );
                $log = "Transaction ID:" . $transactionId  . ' : ' . "Add-PSP" . ' - ' . "Created By: ". $userName. PHP_EOL . ''. PHP_EOL.
                "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-PSP" . PHP_EOL
                . "Add-PSP-POST-REQUEST: " ."Transaction ID:" . $transactionId  . json_encode($_POST).PHP_EOL . "-------------------------" . PHP_EOL;
                file_put_contents ( logger_url_psp , $log . "\n", FILE_APPEND );

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
        			$plamtReceived = str_replace(',','',$this->input->post('plamtReceived'));
        			//$plcurr = $this->input->post('plcurr');
        			$curr = $this->input->post('plcurr');

        			$plcommval = str_replace(',','',$this->input->post('plcommval'));
        			$plamtval = str_replace(',','',$this->input->post('plamtval'));

        			$plnetAmt = str_replace(',','',$this->input->post('plnetAmt'));
        			$acdatereceive = $this->input->post('acdatereceive');
        			$acamtReceive = str_replace(',','',$this->input->post('acamtReceive'));
        			//$accurr = $this->input->post('accurr');
        			$accommval = str_replace(',','',$this->input->post('accommval'));
        			$acamtval = str_replace(',','',$this->input->post('acamtval'));
                    $bankcomm = str_replace(',','',$this->input->post('bankcomm'));
        			//$acnetAmt = str_replace(',','',$this->input->post('acnetAmt'));
                    $nettoBankAmt = str_replace(',','',$this->input->post('nettoBankAmt'));
                    $crrAmt = str_replace(',','',$this->input->post('crrAmt'));
                    $additionalFees = str_replace(',','',$this->input->post('additionalFees'));
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

                    //if (!empty($crrAmt)) {
                    if ($crrAmt != 0.00) {
                        $isCrr = 1;
                    }else{
                        $isCrr = 0;
                    }
                    

                    /*if ($crr == "") {
                        $isCrr = 0;
                    }else{
                        $isCrr = 1;
                        $crrAmount = $crr;
                        $date = date("Y-m-d");
                        $crrReceive =  date('Y-m-d', strtotime($date. ' + 180 days'));
                    }*/
					/*if ($curr == 'USD') {
                        $cur = 'EUR';*/
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        //echo "rate USD " . $rate;
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nettoBankAmt * $exchange_rate;
                    /*}else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        //echo "rate EUR " . $rate;
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nettoBankAmt * $exchange_rate;
                    }*/
					/*echo 'exchange_rate ' . $exchange_rate;
                    echo 'euro_amount ' . $euro_amount;
                    exit();*/
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
                        'BankCom' => $bankcomm,
                        'NetBankAmt' => $nettoBankAmt,
                        'ActualNetAmt' => $nettoBankAmt,
                        'EuroValue' => $nettoBankAmt,
                        'ActualNetAmt' => $nettoBankAmt,
                        'AdditionalFees' => $additionalFees,
                        'ExchangeRate' => $exchange_rate,
                        'EuroValue' => $euro_amount,
        				//'ActualNetAmt' => $acnetAmt,
                        //'EuroValue' => $acnetAmt,

                        'isCRR' => $isCrr,
        				'CreatedBy' => $uid,
                        'ModifiedBy ' => $uid
        			);
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-PSP". PHP_EOL
                    . "Add-PSP-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($pspIncomeInfo) .PHP_EOL . "-------------------------" . PHP_EOL;
                    file_put_contents ( logger_url_psp , $log . "\n", FILE_APPEND );

                    $table = 'bankmaster';
                    $columns = 'BankName,Balance,MaxBalance,BankId';
                    $wherecol = 'BankId';
                    $data['getBankBal'] = $this->all_model->getbankData($table,$columns,$wherecol,$BankId);
                    //$updatedBal = ($data['getBankBal']->Balance + $acnetAmt);
                    $updatedBal = ($data['getBankBal']->Balance + $nettoBankAmt);

                    /*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
                    . "Bank-Balance-Before: ". "Transaction ID:" . $transactionId  . ' - ' . $data['getBankBal']->Balance .PHP_EOL . "-------------------------" . PHP_EOL;
                    file_put_contents ( 'Logs/pspIncome.txt', $log . "\n", FILE_APPEND );

                    $updatedBal = ($data['getBankBal']->Balance + $acnetAmt);

                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
                    . "Bank-Balance-After: ". "Transaction ID:" . $transactionId  . ' - ' . $updatedBal .PHP_EOL . "-------------------------" . PHP_EOL;
                    file_put_contents ( 'Logs/pspIncome.txt', $log . "\n", FILE_APPEND );*/

                    $this->db->where('BankId',$BankId);
                    $this->db->update('bankmaster',array('Balance'=>$updatedBal));
        			$this->db->insert('pspincome',$pspIncomeInfo);
                    $crrId = $this->db->insert_id();
                    // generate new crr record

                    $date = $to;
                    $crrReceive =  date('Y-m-d', strtotime($date. ' + 180 days'));
                    if ($isCrr == 1) {
                        $crrData = array(
                        'PspId' => $pspid,
                        'BankId' => $BankId,
                        'Description' => 'Rolling Reserve For PSP Income No.'.$crrId,
                        'Currency' => $curr,
                        //'ActualDate' => $crrReceive,
                        'ExpDate' => $crrReceive,
                        //'ActualAmt' => $crrAmt,
                        'PlannedAmt' => $crrAmt,
                        //'isCRR' => $isCrr,
                        'CRRId' => $crrId,
                        'CreatedBy' => $uid,
                        'ModifiedBy ' => $uid
                        );

                        $this->db->select('PspId,Balance');
                        $this->db->from('pspmaster');
                        $this->db->where('PspId',$_POST['psp']);
                        $data['pspBalance'] = $this->db->get()->row();
                        $crrBal = ($data['pspBalance']->Balance)+($crrAmt);
                        $pspMaster = array(                            // To update rolling reserve blance
                                'Balance' => $crrBal
                            );
                        

                        $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-PSP". PHP_EOL
                        . "Add-PSP-Crr-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($crrData) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents (logger_url_psp , $log . "\n", FILE_APPEND );
                        
                        $this->db->insert('pspincome',$crrData);
                        $this->db->update('pspmaster',array('Balance'=>$crrAmt),array('PspId'=>$pspid));

                        $this->db->where('PspId',$pspid);
                        $this->db->update('pspmaster',$pspMaster);

                    }
                    

        			$_SESSION['pop_mes'] = "PSP Income Added Successfully."; 
                    /*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
                        . "Success-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( 'Logs/pspIncome.txt', $log . "\n", FILE_APPEND );*/
                        $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Add-PSP" . PHP_EOL
                            . "Add-PSP-Info: ". "Transaction ID:" . $transactionId  . ' - ' . "Bank-Balance-Before: " . $data['getBankBal']->Balance .','
                            ."Bank-Balance-After: ".$updatedBal .','."Success-Message: ".$_SESSION['pop_mes']. PHP_EOL . "-------------------------" . PHP_EOL;
                            file_put_contents ( logger_url_psp, $log . "\n", FILE_APPEND );
                            if ($data['getBankBal']->Balance > $data['getBankBal']->MaxBalance) {
                                $_SESSION['bankId']=$data['getBankBal']->BankId;
                                $_SESSION['balance']=$data['getBankBal']->Balance;
                                $_SESSION['bankName']=$data['getBankBal']->BankName;
                                $_SESSION['MaxBalance']=$data['getBankBal']->MaxBalance;
                                $_SESSION['maxBal']="yes";
                            }
					return 1;
        		}else{
        			$_SESSION['pop_mes'] = "Token does not match."; 
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-PSP" . PHP_EOL
                        . "Add-PSP-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_psp , $log . "\n", FILE_APPEND );
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
		$this->form_validation->set_rules ('pldatereceive', 'Planned Date Receive', 'trim|required');
		//$this->form_validation->set_rules ('acdatereceive', 'Actual Amount Receive', 'trim|required');
		if ($this->form_validation->run () === FALSE) {
			$data['banks'] = $this->all_model->get_all_banks();
			$data['all_psp'] = $this->all_model->get_all_psp();
			$data['allPspIncome'] = $this->all_model->pspIncome($id);
            //print_r($data['allPspIncome']);
            $data['crrData'] = $this->all_model->getCrrGeneratedData($id); // get only CRR data
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('edit-deposit-details',$data);
			$this->load->view('templates/footer');
		}else{  


                //echo logger_url_psp;
                $this->db->select('UserID,Name');
                $this->db->from('usermaster');
                $this->db->where('UserID',$this->input->post('userid'));
                $userName = $this->db->get()->row();
                $userName = $userName->Name;
                $transactionId = guidv4 ( openssl_random_pseudo_bytes ( 16 ) );
                $log = "Transaction ID:" . $transactionId  . ' : ' . "Edit-PSP" . ' - ' . "Created By: ". $userName. PHP_EOL . ''. PHP_EOL.
                "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-PSP" . PHP_EOL
                . "Edit-PSP-POST-REQUEST: " ."Transaction ID:" . $transactionId  . json_encode($_POST).PHP_EOL . "-------------------------" . PHP_EOL;
                file_put_contents ( logger_url_psp, $log . "\n", FILE_APPEND );

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
        			$plamtReceived = str_replace(',','',$this->input->post('plamtReceived'));
        			//$plcurr = $this->input->post('plcurr');
        			$curr = $this->input->post('plcurr');
        			$plcommval = str_replace(',','',$this->input->post('plcommval'));
        			$plamtval = str_replace(',','',$this->input->post('plamtval'));
        			$plnetAmt = str_replace(',','',$this->input->post('plnetAmt'));
        			$acdatereceive = $this->input->post('acdatereceive');
        			$acamtReceive = str_replace(',','',$this->input->post('acamtReceive'));
        			//$accurr = $this->input->post('accurr');
        			$accommval = str_replace(',','',$this->input->post('accommval'));
        			$acamtval = str_replace(',','',$this->input->post('acamtval'));
        			//$acnetAmt = str_replace(',','',$this->input->post('acnetAmt'));
                    $nettoBankAmt = str_replace(',','',$this->input->post('nettoBankAmt'));
                    $crrAmt = str_replace(',','',$this->input->post('crrAmt'));
                    $additionalFees = str_replace(',','',$this->input->post('additionalFees'));
        			$uid = $this->input->post('userid');

                    $data['allPspIncome'] = $this->all_model->pspIncome($id);
                    //$acamtnetReceivebefore = $data['allPspIncome']->ActualNetAmt;
                    $acamtnetReceivebefore = $data['allPspIncome']->NetBankAmt;
                    /*echo 'acamtnetReceivebefore ' . $acamtnetReceivebefore;
                    echo '</br>';*/

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

                    if ($crrAmt != 0.00) { 
                        $isCrr = 1;
                    }else{
                        $isCrr = 0;
                    }
                    
                    /*if ($curr == 'USD') {
                        $cur = 'EUR';*/
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nettoBankAmt * $exchange_rate;
                        /*echo 'nettoBankAmt ' . $nettoBankAmt;
                        echo '</br>';
                        echo 'euro_amount' . $euro_amount;
                        echo '</br>';*/
                    /*}else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        //echo "rate EUR " . $rate;
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nettoBankAmt * $exchange_rate;
                    }*/

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
        				//'ActualNetAmt' => $acnetAmt,
                        //'EuroValue' => $acnetAmt,
                        'ActualNetAmt' => $nettoBankAmt,
                        'AdditionalFees' => $additionalFees,
                        //'EuroValue' => $nettoBankAmt,
                        'NetBankAmt' => $nettoBankAmt,
                        'AdditionalFees' => $additionalFees,
                        'ExchangeRate' => $exchange_rate,
                        'EuroValue' => $euro_amount,
                        'isCRR' => $isCrr,
        				//'CreatedBy' => $uid,
                        'ModifiedBy'=> $uid
        			);

                    $log = "ip:" . $_SERVER['REMOTE_ADDR'] . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Edit-PSP" . PHP_EOL
                    . "Edit-PSP-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($updatePspIncomeInfo) .PHP_EOL . "-------------------------" . PHP_EOL;
                    file_put_contents ( logger_url_psp, $log . "\n", FILE_APPEND );

                    $table = 'bankmaster';
                    $columns = 'BankName,Balance,MaxBalance';
                    $wherecol = 'BankId';
                    $data['getBankBal'] = $this->all_model->getbankData($table,$columns,$wherecol,$BankId);
                        
                //if ($data['getBankBal']->Balance > 0 ) {
                    $updatedBal1 = ($data['getBankBal']->Balance) - ($acamtnetReceivebefore);  //(10000-7071.17) = 2041.73
                    $updatedBal = ($updatedBal1)+($nettoBankAmt);                                // (2928.83+6187.272)
                   /* echo 'BAnk BAl' . $data['getBankBal']->Balance;
                    echo '</br>';
                    echo 'acamtnetReceivebefore ' . $acamtnetReceivebefore;
                    echo '</br>';
                    echo 'updatedBal1 ' . $updatedBal1;
                    echo '</br>';
                    echo 'NetBankAmt ' . $nettoBankAmt;
                    echo '</br>';
                    echo 'updatedBal ' . $updatedBal;
                    exit();*/

                    $this->db->where('BankId',$BankId);
                    $this->db->update('bankmaster',array('Balance'=>$updatedBal));


        			$this->db->where('TransId',$id);
	        		$user = $this->db->update('pspincome',$updatePspIncomeInfo);
                    
                    $data['allPspIncome'] = $this->all_model->pspIncome($id);
                    $date = date("Y-m-d");
                    $crrReceive =  date('Y-m-d', strtotime($date. ' + 180 days'));
                        
                        $crrDate = date("Y-m-d");
                        if ($data['allPspIncome']->isCRR == 0 && $data['allPspIncome']->CRRId != 0) {
                            /*$table = 'bankmaster';
                            $columns = 'BankName,Balance';
                            $wherecol = 'BankId';
                            $data['getBankBal'] = $this->all_model->getbankData($table,$columns,$wherecol,$BankId);

                            $data['allPspIncome'] = $this->all_model->pspIncome($id);
                            //$bankBal = ($data['getBankBal']->Balance) + ($nettoBankAmt);
                            $updatedBal = ($data['getBankBal']->Balance) - ($data['allPspIncome']->NetBankAmt);
                            $bankBal = ($updatedBal)+($nettoBankAmt);
                            print_r($bankBal);exit();*/
                            // update CRR Record start
                            $crrData = array( 
                            'PspId' => $pspid,
                            'BankId' => $BankId,
                            //'Description' => $desc,
                            'Currency' => $curr,
                            'ActualDate' => $crrReceive,
                            //'ActualAmt' => $crrAmt,
                            'PlannedAmt' => $plamtReceived,
                            //'isCRR' => $isCrr,
                            //'CRRId' => $crrId,
                            'ModifiedBy' => $uid
                            );

                            $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . "Edit-PSP" . PHP_EOL
                            . "Edit-PSP-Crr-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($crrData) .PHP_EOL . "-------------------------" . PHP_EOL;
                            file_put_contents ( logger_url_psp, $log . "\n", FILE_APPEND );

                            $this->db->where('CRRId',$id);
                            $this->db->update('pspincome',$crrData);


                            $table = 'bankmaster';
                            $columns = 'BankName,Balance,MaxBalance';
                            $wherecol = 'BankId';
                            $data['getBankBal'] = $this->all_model->getbankData($table,$columns,$wherecol,$BankId);

                            $data['allPspIncome'] = $this->all_model->pspIncome($id);
                            //$bankBal = ($data['getBankBal']->Balance) + ($nettoBankAmt);
                            $updatedBal = ($data['getBankBal']->Balance) - ($data['allPspIncome']->EuroValue);
                            $bankBal = ($updatedBal)+($euro_amount);

                            $this->db->where('BankId',$BankId);
                            $this->db->update('bankmaster',array('Balance'=>$bankBal));
                            // update CRR Record end
                            //if ($data['allPspIncome']->ActualDate == $crrDate) {
                                //to update psp balance of crr record start
                                $this->db->select('PspId,Balance');
                                $this->db->from('pspmaster');
                                $this->db->where('PspId',$_POST['psp']);

                                $pspBal['balance'] = $this->db->get()->row();

                                $this->db->select('TransId,PspId,ActualAmt,NetBankAmt');
                                $this->db->from('pspincome');
                                $this->db->where('TransId',$id);
                                $beforeActualAmount = $this->db->get()->row();

                                $pspBalance = ($pspBal['balance']->Balance)-($beforeActualAmount->ActualAmt);
                                
                                
                                //$neBalance = ($balance)+($acamtReceive);

                                $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Edit-PSP" . PHP_EOL
                                    . "Info: ". "Transaction ID:" . $transactionId  . ' - ' . "psp bal: " . $pspBal['balance']->Balance .','. 
                                    "before amount: ". $beforeActualAmount->ActualAmt .','."bank balance: ".$bankBalance .','."new balance: ".$neBalance. ','."actual amount: ".$acamtReceive. PHP_EOL . "-------------------------" . PHP_EOL;
                                    file_put_contents ( logger_url_psp , $log . "\n", FILE_APPEND );

                                $this->db->where('PspId',$pspid);
                                $this->db->update('pspmaster',array('Balance'=>$pspBalance));                                
                                
                                //to update psp balance of crr record end
                            //}

                            /*//to update crr record and update psp balance start
                            $this->db->select('PspId,Balance');
                            $this->db->from('pspmaster');
                            $this->db->where('PspId',$_POST['psp']);

                            $pspBal['balance'] = $this->db->get()->row();

                            $this->db->select('TransId,PspId,ActualAmt');
                            $this->db->from('pspincome');
                            $this->db->where('TransId',$id);
                            $beforeActualAmount = $this->db->get()->row();

                            $balance = ($pspBal['balance']->Balance)-($acamtReceive);

                            //$neBalance = ($balance)+($acamtReceive);

                            $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Edit-PSP" . PHP_EOL
                                . "Info: ". "Transaction ID:" . $transactionId  . ' - ' . "psp bal: " . $pspBal['balance']->Balance .','. 
                                "before amount: ". $beforeActualAmount->ActualAmt .','."balance: ".$balance .','."new balance: ".$neBalance. ','."actual amount: ".$acamtReceive. PHP_EOL . "-------------------------" . PHP_EOL;
                                file_put_contents ( logger_url_psp , $log . "\n", FILE_APPEND );

                            $this->db->where('PspId',$pspid);
                            $this->db->update('pspmaster',array('Balance'=>$balance));
                            //to update crr record and update psp balance end*/
                        }
                        
                        

	        		$_SESSION['pop_mes'] = "PSP Income Updated Successfully.";
                        $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Edit-PSP" . PHP_EOL
                            . "Edit-PSP-Info: ". "Transaction ID:" . $transactionId  . ' - ' . "Bank-Balance-Before: " . $data['getBankBal']->Balance .','. 
                            "ActualNetAmt-Before-Edit: ". $acamtnetReceivebefore .','."Bank-Balance-After: ".$updatedBal .','."Success-Message: ".$_SESSION['pop_mes']. PHP_EOL . "-------------------------" . PHP_EOL;
                            file_put_contents ( logger_url_psp , $log . "\n", FILE_APPEND );
                            if ($data['getBankBal']->Balance > $data['getBankBal']->MaxBalance) {
                                $_SESSION['bankId']=$data['getBankBal']->BankId;
                                $_SESSION['balance']=$data['getBankBal']->Balance;
                                $_SESSION['bankName']=$data['getBankBal']->BankName;
                                $_SESSION['MaxBalance']=$data['getBankBal']->MaxBalance;
                                $_SESSION['maxBal']="yes";
                            }
                            
	        		redirect('psp-income');
        		}else{
        			$_SESSION['pop_mes'] = "Token does not match.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . "Edit-PSP-POST" . PHP_EOL
                        . "Edit-PSP-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_psp, $log . "\n", FILE_APPEND );
					redirect('psp-income');
        		}
		}
	}
    public function get_popup_notification() {
        
        if (! isset ( $_SESSION ['logged_in'] )) {
            
            echo "loggedOut";
            
        } else {
            
            
            $date = date("Y-m-d");

             $this->db->select('TransId, ExpDate, PlannedAmt, Description');
               $this->db->from('pspincome');
               $this->db->where('isCRR', 0);
               $this->db->where('CRRId !=',0);
               //$this->db->where('Day(STR_TO_DATE(REPLACE(ExpDate , "/", ","),"%d,%m,%Y")) = day(NOW())');
               $this->db->where('ExpDate',$date);
               $query = $this->db->get ();
            $result = $query->result ();
              //$query4= $this->db->last_query();
            
            //$count = $result[0]->count;
            $notarra =array();
            foreach ( $result as $notif ) {
                //print_r($notif);
                $notarra[] = $notif;
            }
            
            echo json_encode($notarra);
            
            
            }
        
    }

}
