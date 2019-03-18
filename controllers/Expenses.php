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
    /*public function transferAmt($id){
        $data['transferAmt'] = $this->all_model->getTransferTypeAmount($id);
        echo json_encode($data);
    }*/
    public function transferAmt1(){

        /*$this->db->select('bt.BankTransferId,bt.BanktransferName,bt.Active,bc.BankTransferId,bc.BankId,bc.Amount,b.BankId,b.CurId,b.OctComP,c.CurId,c.CurName');
        $this->db->from('banktransfertype bt');
       $this->db->join('banktransfercharges bc','bc.BankTransferId = bt.BankTransferId');
       $this->db->join('bankmaster b','b.BankId = bc.BankId');
       $this->db->join('currencymaster c','b.CurId = c.CurId');
       $this->db->where('bc.BankId',$_POST['bankid']);
       $this->db->where('bc.BankTransferId',$_POST['transType']);
       $data['result'] = $this->db->get()->row();
      echo json_encode($data);
        exit;*/
        $this->db->select('bt.BankTransferId,bt.BanktransferName,bt.Active,bc.BankTransferId,bc.BankId,bc.Amount,b.CurId,b.OctComP,c.CurId,c.CurName');
        $this->db->from('banktransfertype bt');
        $this->db->join('banktransfercharges bc','bc.BankTransferId = bt.BankTransferId');
        $this->db->join('bankmaster b','b.BankId = bc.BankId');
        $this->db->join('currencymaster c','b.CurId = c.CurId');
        $this->db->where('bc.BankId',$_POST['bankid']);
        $this->db->where('bc.BankTransferId',$_POST['transType']);
        $data['result'] = $this->db->get()->row();
        echo json_encode($data);
    exit;
    }
    public function transferAmt(){

        $this->db->select('bt.BankTransferId,bt.BanktransferName,bt.Active,bc.BankTransferId,bc.BankId,bc.Amount');
        $this->db->from('banktransfertype bt');
        $this->db->join('banktransfercharges bc','bc.BankTransferId = bt.BankTransferId');
        $this->db->where('bc.BankId',$_POST['bankid']);
        $this->db->where('bc.BankTransferId',$_POST['transType']);
        $data['result'] = $this->db->get()->row();
        echo json_encode($data);
    exit;
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
			if(!empty($_SESSION['vendor_id'])){
				$vendorID = $_SESSION['vendor_id'];
				$data['vendors_first']=$this->all_model->GET_vendors($vendorID);
				unset($_SESSION['vendor_id']);
			}else{
			   $data['vendors_first']="";
			}
			   
			$data['vendors'] = $this->all_model->vendors();
            $data['transType'] = $this->all_model->getTransferType();
            $data['expCat'] = $this->all_model->get_active_categories();
            $data['banks'] = $this->all_model->get_all_banks();
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('add-expenses',$data);
			$this->load->view('templates/footer');
		}else{
                $this->db->select('UserID,Name');
                $this->db->from('usermaster');
                $this->db->where('UserID',$this->input->post('userid'));
                $userName = $this->db->get()->row();
                $userName = $userName->Name;

                $transactionId = guidv4 ( openssl_random_pseudo_bytes ( 16 ) );
                $log = "Transaction ID:" . $transactionId  .' : ' . "Add-Exp" .' - ' . "Created By: ". $userName . PHP_EOL . ''. PHP_EOL.
                "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Exp". PHP_EOL
                . "Add-Exp-POST-REQUEST: " ."Transaction ID:" . $transactionId  . json_encode($_POST).PHP_EOL . "-------------------------" . PHP_EOL;
                file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );

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
        			$plamtReceived = str_replace(',','',$this->input->post('plamtReceived'));
        			$curr = $this->input->post('plcurr');

        			$shares = str_replace(',','',$this->input->post('shareP'));
                    $acdatereceive = $this->input->post('acdatereceive');
                    $acamtReceive = str_replace(',','',$this->input->post('acamtReceive'));
                    $fbc = str_replace(',','',$this->input->post('fbc'));
                    $nfb = str_replace(',','',$this->input->post('nfb'));
        			$uid = $this->input->post('userid');

                    $shareAmount = str_replace(',','',$this->input->post('shareAmount'));
                    $BankOutCommAmount = str_replace(',','',$this->input->post('BankOutCommAmount'));
                    $transferCommP = str_replace(',','',$this->input->post('transferCommP'));
                    $TransferCommAmount = str_replace(',','',$this->input->post('TransferCommAmount'));
                    $outCommP = str_replace(',','',$this->input->post('outCommP'));

                  
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
                    
                    //if ($curr == 'USD') {
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nfb * $exchange_rate;
                        /*echo 'nfb ' . $nfb;
                        echo '<br>';
                        echo 'exchange_rate ' . $exchange_rate;
                        echo '<br>';
                        echo 'euro_amount ' . $euro_amount;
                        echo '<br>';*/

                       
                    //}
                    /*else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        //echo "rate EUR " . $rate;
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nfb * $exchange_rate;
                    }*/
                    /*echo 'exchange_rate ' . $exchange_rate;
                    echo 'euro_amount ' . $euro_amount;
                    exit();*/

                    $this->db->select('BankId,BankName,Balance');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$BankId);
                    $bal = $this->db->get()->row();
                   
                    //if ($bal->Balance >= $nfb) {

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
                        'ExchangeRate' => $exchange_rate,
                        'EuroValue' => $euro_amount,
                        'Active' => 1,
                        'CreatedBy' => $uid,
                        'CreatedOn' => $date,
                        'ModifiedBy' => $uid
                    );

                        $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Exp". PHP_EOL
                        . "Add-Exp-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($expenses) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
                        $this->db->insert('expenses',$expenses);
                        $UpdatedBal = ($bal->Balance-$euro_amount);
                        /*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
                        . "Bank-Balance-Before: ". "Transaction ID:" . $transactionId  . ' - ' . $bal->Balance .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( 'Logs/expenses.txt', $log . "\n", FILE_APPEND );

                        $UpdatedBal = ($bal->Balance-$nfb);

                        $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . PHP_EOL
                        . "Bank-Balance-After: ". "Transaction ID:" . $transactionId  . ' - ' . $UpdatedBal .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( 'Logs/expenses.txt', $log . "\n", FILE_APPEND );*/

                        $this->db->where('BankId',$BankId);
                        $this->db->update('bankmaster',array('Balance'=>$UpdatedBal));
                    /*}else{
                        $_SESSION['pop_mes'] = "Not Sufficient Balance"; 
                    return 1;
                    }*/
                    

        			$_SESSION['pop_mes'] = "Expenses Added Successfully."; 

                        $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Add-Exp" . PHP_EOL
                            . "Add-Exp-Info: ". "Transaction ID:" . $transactionId  . ' - ' . "Bank-Balance-Before: " . $bal->Balance .','
                            ."Bank-Balance-After: ".$UpdatedBal .','."Success-Message: ".$_SESSION['pop_mes']. PHP_EOL . "-------------------------" . PHP_EOL;
                            file_put_contents (logger_url_exp, $log . "\n", FILE_APPEND );
					return 1;
        		}else{
        			$_SESSION['pop_mes'] = "Token does not match.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Exp". PHP_EOL
                        . "Add-Exp-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
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
                $this->db->select('UserID,Name');
                $this->db->from('usermaster');
                $this->db->where('UserID',$this->input->post('userid'));
                $userName = $this->db->get()->row();
                $userName = $userName->Name;
                $transactionId = guidv4 ( openssl_random_pseudo_bytes ( 16 ) );
               /* $log = "Transaction ID:" . $transactionId  . ' : ' . "Edit-Exp" . ' - ' . "Created By: ". $userName .PHP_EOL . ''. PHP_EOL.
                "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Exp" . PHP_EOL
                . "Edit-Exp-POST-REQUEST: " ."Transaction ID:" . $transactionId  . json_encode($_POST).PHP_EOL . "-------------------------" . PHP_EOL;
                file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );*/

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
                    $plamtReceived = str_replace(',','',$this->input->post('plamtReceived'));
                    $curr = $this->input->post('plcurr');

                    $shares = str_replace(',','',$this->input->post('shareP'));
                    $acdatereceive = $this->input->post('acdatereceive');
                    $acamtReceive = str_replace(',','',$this->input->post('acamtReceive'));
                    $fbc = str_replace(',','',$this->input->post('fbc'));
                    $nfb = str_replace(',','',$this->input->post('nfb'));
                    $uid = $this->input->post('userid');

                    $shareAmount = str_replace(',','',$this->input->post('shareAmount'));
                    $BankOutCommAmount = str_replace(',','',$this->input->post('BankOutCommAmount'));
                    $transferCommP = str_replace(',','',$this->input->post('transferCommP'));
                    $TransferCommAmount = str_replace(',','',$this->input->post('TransferCommAmount'));
                    $outCommP = str_replace(',','',$this->input->post('outCommP'));
                    

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


                    /*if ($curr == 'USD') {
                        $cur = 'EUR';*/
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nfb * $exchange_rate;
                    /*}else{
                        $cur = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$cur);
                                
                        $val=json_decode($val);
                        $rate = $val->rates->EUR;
                        //echo "rate EUR " . $rate;
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $nfb * $exchange_rate;
                    }*/

                    $this->db->select('BankId,BankName,Balance');
                    $this->db->from('bankmaster');
                    $this->db->where('BankId',$BankId);
                    $bal = $this->db->get()->row();
                    //if($bal->Balance >= $nfb){

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
                        'ExchangeRate' => $exchange_rate,
                        'EuroValue' => $euro_amount,
                        'Active' => 1,
                        'ModifiedBy' => $uid,
                        'CreatedBy' => $uid,
                    );
                        /*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Exp" . PHP_EOL
                        . "Edit-Exp-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($expenses) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );*/
                        

                        $this->db->select('TransId,NetFromBank,EuroValue');
                        $this->db->from('expenses');
                        $this->db->where('TransId',$id);
                        $beforeBal = $this->db->get()->row();
                       // $beforeBal = $beforeBal->NetFromBank;

                        if ($curr == 'EUR') {
                            $Bal = ($bal->Balance)+($beforeBal->NetFromBank);  
                            $updatedBal = ($Bal)-($euro_amount);  
                        }

                        if ($curr == 'USD') {
                             $Bal = ($bal->Balance)+($beforeBal->EuroValue);  
                            $updatedBal = ($Bal)-($euro_amount);  
                        }
                        /*$Bal = ($bal->Balance)+($beforeBal);  //(7,599.51 + 1270.49) = 8870
                        $updatedBal = ($Bal)-($euro_amount);  // (8870-1124.325) = 7745.675*/
                        /*print_r($bal->Balance);
                        echo '<br>';
                        print_r($beforeBal);
                        echo '<br>';
                        print_r($Bal);
                        echo '<br>';
                        print_r($nfb);
                        echo '<br>';
                        print_r($updatedBal);
                        exit();*/


                        //$UpdatedBal = ($bal->Balance-$nfb);

                        $this->db->where('BankId',$BankId);
                        $this->db->update('bankmaster',array('Balance'=>$updatedBal));

                        $this->db->where('TransId',$id);
                        $this->db->update('expenses',$expenses);  
                    /*}else{
                        $_SESSION['pop_mes'] = "Not Sufficient Balance.";
                    redirect('expenses');
                    }*/
                    

	        		$_SESSION['pop_mes'] = "Expenses Updated Successfully.";
                        /*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Edit-Exp" . PHP_EOL
                            . "Edit-Exp-Info: ". "Transaction ID:" . $transactionId  . ' - ' . "Bank-Balance-Before: " . $bal->Balance .','
                            ."Bank-Balance-After: ".$updatedBal .','."Success-Message: ".$_SESSION['pop_mes']. PHP_EOL . "-------------------------" . PHP_EOL;
                            file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );*/
	        		redirect('expenses');
        		}else{
        			$_SESSION['pop_mes'] = "Token does not match."; 
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Exp". PHP_EOL
                        . "Edit-Exp-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					redirect('expenses');
        		}
		}
	}

}
