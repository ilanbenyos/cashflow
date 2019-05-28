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
		$this->load->view('templates/left-sidebar2');
        $this->load->view('templates/content');
		$this->load->view('expenses',$data);
		$this->load->view('templates/footer');
	}
    public function allExpenses(){
        $data['getallExpenses'] = $this->all_model->getallExpenses();
        $this->load->view('expenses',$data);
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
			}elseif(!empty($_SESSION['callCenterUser'])){
                $notificationID = $_SESSION['callCenterUser'];
                $data['callCenter'] = $this->all_model->callCenterVendor($notificationID);
                if (isset($data['callCenter']->VendorId)) {
                    $vendorID = $data['callCenter']->VendorId;
                 $data['vendors_first']=$this->all_model->GET_vendors($vendorID);
                 unset($_SESSION['callCenterUser']);
                }
            }elseif(!empty($_SESSION['callCenterUserReqFund'])){
                $requestId = $_SESSION['callCenterUserReqFund'];
                //$reqAmout = $_SESSION['euro_val'];
                $data['callCenterReq'] = $this->all_model->getCallCenterFunds($requestId);
                $data['callCenterReq']->reqAmt = $_SESSION['euro_val'];
                //print_r($data['callCenterReq']);exit();
                if (isset($data['callCenterReq']->VendorID)) {
                    $vendorid = $data['callCenterReq']->VendorID;
                 $data['vendors_first']=$this->all_model->GET_vendors($vendorid);
                 //unset($_SESSION['callCenterUserReqFund']);
            }
        }else{
			   $data['vendors_first']="";
			}
			$data['currency'] = $this->all_model->getAllCurrency();
			$data['description'] = $this->all_model->callCenterNoti();
			$data['vendors'] = $this->all_model->vendors();
            $data['transType'] = $this->all_model->getTransferType();
            $data['expCat'] = $this->all_model->get_active_categories();
            $data['banks'] = $this->all_model->get_all_banks();
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('add-expenses',$data);
			$this->load->view('templates/footer');
		}else{
			
				$config['upload_path'] = 'upload_document';
				$config['allowed_types'] = 'pdf|PDF|png|PNG|xlsx|XLSX';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('upload_file')) {
					$error = array('error' => $this->upload->display_errors());
					$upload_doc="";
				} else {
					$data = array('image_metadata' => $this->upload->data());
					$upload_doc =$data['image_metadata']['file_name'];
				}
				
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
                    $callCenterNotiId = $this->input->post('callCenterNotiId');
                    $callCenterReqId = $this->input->post('callCenterReqId');
                    
                    /*if (!empty($callCenterNotiId)) {
                        $notiId = $callCenterNotiId;
                    }*/
                    /*if (!empty($callCenterReqId)) {
                        $reqId = $callCenterReqId;
                    }*/

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
                        'ModifiedBy' => $uid,
						'DocumentPath' =>$upload_doc
                    );
                        //print_r($expenses);exit();
                        $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Exp". PHP_EOL
                        . "Add-Exp-Data-Array: ". "Transaction ID:" . $transactionId  . json_encode($expenses) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
                        $this->db->insert('expenses',$expenses);
                        $callCenterUserId = $this->db->insert_id();
                        if (!empty($callCenterNotiId)) {
							//echo 'callCenterNoti';
							//check whether vendor is call center userName
							$this->db->select('IsCallCenter,Currency');
                    $this->db->from('vendormaster');
                    $this->db->where('VendorId',$vendor);
                    $IsCallCenter = $this->db->get()->row();
					//print_r($IsCallCenter);exit();
					$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Exp". PHP_EOL
                        . "Is vendor IsCallCenter : ". $IsCallCenter .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
						
						if($IsCallCenter == 1)
						{
							$callcenter_expense_details = array(
                        'expense_id' => $callCenterUserId,
                        'createdon' => date('Y-m-j H:i:s'),
                        'ActualAmt' => $acamtReceive,
                        'NetFromBank' => $nfb,
                        'NetFromBankEuroVal' => $euro_amount,
                        'vendor_id' => $vendor,
						'currency' => $curr,
						'ActualDate' => $to,
                    );
					$this->db->insert('callcenter_expense_details',$callcenter_expense_details);
							
						}
							
							//if (!empty($callCenterNotiId)) {
                            ///check whether vendor is call center user
                            
                            
                            $this->db->where('NotificationId',$callCenterNotiId);
                            $this->db->update('callcenternotification',array('ExpId'=>$callCenterUserId,'Status'=>2));

                            $this->db->select('NotificationId,VendorId,CallCenterExpId');
                            $this->db->from('callcenternotification');
                            $this->db->where('NotificationId',$callCenterNotiId);
                            $query = $this->db->get();
                            $res = $query->row();
                            //$res = $res->CallCenterExpId;
                            /*$data = array();
                            foreach ($res as $val) {
                                $data = $val;
                            }*/
                            $res = explode(',', $res->CallCenterExpId);
                            foreach ($res as $value) {
                                $this->db->where('ExpId',$value);
                                $this->db->update('callcenterexpenses',array('IsInvoiceGen'=>2,'ExpenseId'=>$callCenterUserId));
                            }
                        //}
                        }elseif (!empty($callCenterReqId)) {

                      $this->db->select('IsCallCenter,Currency');
                    $this->db->from('vendormaster');
                    $this->db->where('VendorId',$vendor);
                    $IsCallCenter = $this->db->get()->row();
                           $curr = 'EUR';
                        $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $exchange_rate = $val->rates->USD;
                           if ($IsCallCenter->Currency == 1) {
                               $amount = $acamtReceive * 1;
                           }else{
                                $amount = $acamtReceive * $exchange_rate;
                           }

                            $callcenter_fund_details = array(
                        'expense_id' => $callCenterUserId,
                        'createdon' => date('Y-m-j H:i:s'),
                        'ActualAmt' => $amount,
                        'NetFromBank' => $nfb,
                        'NetFromBankEuroVal' => $euro_amount,
                        'vendor_id' => $vendor,
                        'currency' => $IsCallCenter->Currency,
                        'ActualDate' => $to,
                    );
                            //print_r($callcenter_fund_details);
                    $this->db->insert('callcenter_fund_details',$callcenter_fund_details);
                            
                        }
                        

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
                            if ($bal->Balance < $bal->MinBalance) {
                                $_SESSION['bankId']=$bal->BankId;
                                $_SESSION['balance']=$bal->Balance;
                                $_SESSION['bankName']=$bal->BankName;
                                $_SESSION['MinBalance']=$bal->MinBalance;
                                $_SESSION['minBal']="yes";
                            }
					redirect('expenses');
        		}else{
        			//$_SESSION['pop_mes'] = "Token does not match.";
                    $_SESSION['session_exp'] = "Session Expired. Please Login To Continue.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Exp". PHP_EOL
                        . "Add-Exp-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					redirect('expenses');
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
			
				
			
					$config['upload_path'] = 'upload_document';
					$config['allowed_types'] = 'pdf|PDF|png|PNG|xlsx|XLSX';
					$this->load->library('upload', $config);
					$getexpenses = $this->all_model->getexpenses($id);
					//print_r($getexpenses);
					if($getexpenses->DocumentPath == "")
					{
						if (!$this->upload->do_upload('upload_file')) {
							$error = array('error' => $this->upload->display_errors());
							$upload_doc="";
						} else {
							$data = array('image_metadata' => $this->upload->data());
							$upload_doc =$data['image_metadata']['file_name'];
						}
					}
					else{
						$upload_doc=$getexpenses->DocumentPath;
					}
					
					
					
					
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

                    $this->db->select('BankId,BankName,Balance,MinBalance');
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
						'DocumentPath' =>$upload_doc
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
						
						
						
						
						//check whether vendor is call center userName
							$this->db->select('IsCallCenter');
                    $this->db->from('vendormaster');
                    $this->db->where('VendorId',$vendor);
                    $IsCallCenter = $this->db->get()->row();
					
					$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Add-Exp". PHP_EOL
                        . "Is vendor IsCallCenter : ". $IsCallCenter .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
						
						if($IsCallCenter == 1)
						{ 
					if($beforeBal->NetFromBank != $nfb)
						{
							 $this->db->select('*');
                        $this->db->from('callcenter_expense_details');
                        $this->db->where('expense_id',$id);
                        $callstatus = $this->db->get()->row();
						if(count($callstatus) != 1)
						{
							$callcenter_expense_details = array(
                        'expense_id' => $callCenterNotiId,
                        'createdon' => date('Y-m-j H:i:s'),
                        'NetFromBank' => $nfb,
                        'NetFromBankEuroVal' => $euro_amount,
                        'vendor_id' => $vendor,
						'currency' => $curr,
						'ActualDate' => $to,
                    );
					$this->db->insert('callcenter_expense_details',$callcenter_expense_details);
							
						}
							
						}
							
							
							
							
						}
							
							
							///check whether vendor is call center user
						
						
						
						
						
                    /*}else{
                        $_SESSION['pop_mes'] = "Not Sufficient Balance.";
                    redirect('expenses');
                    }*/

	        		$_SESSION['pop_mes'] = "Expenses Updated Successfully.";
                    if ($bal->Balance < $bal->MinBalance) {
                                $_SESSION['bankId']=$bal->BankId;
                                $_SESSION['balance']=$bal->Balance;
                                $_SESSION['bankName']=$bal->BankName;
                                $_SESSION['MinBalance']=$bal->MinBalance;
                                $_SESSION['minBal']="yes";
                            }
                        /*$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" . ' : ' . "Edit-Exp" . PHP_EOL
                            . "Edit-Exp-Info: ". "Transaction ID:" . $transactionId  . ' - ' . "Bank-Balance-Before: " . $bal->Balance .','
                            ."Bank-Balance-After: ".$updatedBal .','."Success-Message: ".$_SESSION['pop_mes']. PHP_EOL . "-------------------------" . PHP_EOL;
                            file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );*/
	        		redirect('expenses');
        		}else{
        			//$_SESSION['pop_mes'] = "Token does not match."; 
                    $_SESSION['session_exp'] = "Session Expired. Please Login To Continue.";
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Exp". PHP_EOL
                        . "Edit-Exp-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					redirect('expenses');
        		}
		}
	}

    public function updateCallCenterExp($id){
        if(!isset($_SESSION['logged_in']))
        {
            redirect('login');
        }
        $_SESSION['callCenterUser'] =$id;
        redirect('Expenses/addExpenseDetails');
    }
    public function updateCallCenterReqFund($id){
        if(!isset($_SESSION['logged_in']))
        {
            redirect('login');
        }
        //print_r($_SESSION['euro_amt'.$id]);exit();
        $_SESSION['euro_val'] = $_SESSION['euro_amt'.$id];
        $_SESSION['callCenterUserReqFund'] =$id;
        //print_r($_SESSION['callCenterUserReqFund']);exit();
        redirect('Expenses/addExpenseDetails');
    }
	
	public function updateCallCenterExpDetails($id){
        if(!isset($_SESSION['logged_in']))
        {
            redirect('login');
        }
		if($_SESSION['user_role'] == "Admin") {
			$expense = array(
            			'adminread' => 1,
            		);
            		$this->db->where('id',$id);
	        		$this->db->update('callcenter_expense_details',$expense);
			
		}
	    $this->form_validation->set_rules ( 'userid', 'userid Name', 'trim|required' );
		 $this->form_validation->set_rules ( 'editexpense_token', 'editexpense_token Name', 'trim|required' );
		if ($this->form_validation->run () === FALSE) {
            $this->db->select('*');
		$this->db->from('callcenter_expense_details pt');
		$this->db->where('pt.id',$id);
		$callcenter_expense_details =  $this->db->get()->row();
            $data['callcenter_expense_details'] = $callcenter_expense_details;
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('updateCallCenterExp',$data);
			$this->load->view('templates/footer');
		}
		else{
		$token = $this->input->post('editexpense_token');
        		$session_token=null;
        		$session_token = $_SESSION['token_edit-expenses'];
        		//unset($_SESSION['token_pspincome']);
        		if(!empty($token) == $session_token)
        		{ 
			//print_r($_POST);
			//exit();
			$receivedamount = str_replace(',','',$this->input->post('receivedamount'));
			$received = $this->input->post('received');
			$addedamount = $this->input->post('addedamount');
			$userid = $this->input->post('userid');
			$callcenterid = $this->input->post('callcenterid');
			$vendor_id = $this->input->post('vendor_id');
			
			 $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-CallCenterExpenses". PHP_EOL
                        . json_encode($_POST) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
			
			$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $receivedamount * $exchange_rate;
						
						if ($received == 'on') {
					$received = 1;
					
						}
						else{
							$received = 0;
						}
						
						
			
			$expense = array(
            			'Amount_Received' => $receivedamount,
            			'Amount_ReceivedEuroVal'=> $euro_amount,
            			'status' => $received,
						'user_id' =>$_SESSION['userid'],
						'modifiedon' =>date('Y-m-j H:i:s'),
            		);
            		$this->db->where('id',$callcenterid);
	        		$this->db->update('callcenter_expense_details',$expense);
					
					$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-CallCenterExpenses Update Call data". PHP_EOL
                        . json_encode($expense) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					
					if ($received == 1) {
						
						$this->db->select('CallCenterCashBalance,EuroVal');
                    $this->db->from('vendormaster');
                    $this->db->where('VendorId',$vendor_id);
                    $Vendorbal = $this->db->get()->row();
					
					
					$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Vendorbal Balance data". PHP_EOL
                        . json_encode($Vendorbal) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					
						$updatedBal = $Vendorbal->CallCenterCashBalance+$receivedamount;
						$updatedeuroBal = $Vendorbal->EuroVal+$euro_amount;
						
						$vendorbaldata = array('CallCenterCashBalance'=>$updatedBal,'EuroVal'=>$updatedeuroBal);
							$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Vendormaster Update Balance data". PHP_EOL
                        . json_encode($vendorbaldata) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
						
						$this->db->where('VendorId',$vendor_id);
                        $this->db->update('vendormaster',$vendorbaldata);
						
					}
			redirect('all-expenses');
			
				}
				
				else{
        			$_SESSION['pop_mes'] = "Token does not match."; 
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Exp". PHP_EOL
                        . "Edit-Exp-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					redirect('all-expenses');
        		}
	}
				
		
    }
    public function updateCallCenterFundDetails($id){
        if(!isset($_SESSION['logged_in']))
        {
            redirect('login');
        }
        if($_SESSION['user_role'] == "Admin") {
            $expense = array(
                        'adminread' => 1,
                    );
                    $this->db->where('id',$id);
                    $this->db->update('callcenter_fund_details',$expense);
            
        }
        $this->form_validation->set_rules ( 'userid', 'userid Name', 'trim|required' );
         $this->form_validation->set_rules ( 'editfund_token', 'editfund_token Name', 'trim|required' );
        if ($this->form_validation->run () === FALSE) {
            $this->db->select('*');
        $this->db->from('callcenter_fund_details pt');
        $this->db->where('pt.id',$id);
        $callcenter_expense_details =  $this->db->get()->row();
            $data['callcenter_fund_details'] = $callcenter_expense_details;
            $this->load->view('templates/header');
            $this->load->view('templates/left-sidebar');
            $this->load->view('updateCallCenterFund',$data);
            $this->load->view('templates/footer');
        }
        else{
        $token = $this->input->post('editfund_token');
                $session_token=null;
                $session_token = $_SESSION['token_edit-fund'];
                //unset($_SESSION['token_pspincome']);
                if(!empty($token) == $session_token)
                { 
            /*print_r($_POST);
            exit();*/
            $receivedamount = str_replace(',','',$this->input->post('receivedamount'));
            $received = $this->input->post('received');
            $addedamount = $this->input->post('addedamount');
            $userid = $this->input->post('userid');
            $callcenterid = $this->input->post('callcenterid');
            $vendor_id = $this->input->post('vendor_id');
            
            //$curr = $this->input->post('currency');
            //print_r($curr);exit();
             $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-CallCenterFund". PHP_EOL
                        . json_encode($_POST) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
            
            $curr = "EUR";
            $val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$curr);
                                
                        $val=json_decode($val);
                        $exchange_rate = $val->rates->EUR;
                        $euro_amount = $receivedamount * $exchange_rate;
                        //print_r($euro_amount);exit();
                        if ($received == 'on') {
                    $received = 1;
                    
                        }
                        else{
                            $received = 0;
                        }
                        
                        
            
            $expense = array(
                        'Amount_Received' => $receivedamount,
                        'Amount_ReceivedEuroVal'=> $euro_amount,
                        'status' => $received,
                        'user_id' =>$_SESSION['userid'],
                        'modifiedon' =>date('Y-m-j H:i:s'),
                    );
                    $this->db->where('id',$callcenterid);
                    $this->db->update('callcenter_fund_details',$expense);
                    
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-CallCenterExpenses Update Call data". PHP_EOL
                        . json_encode($expense) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
                    
                    if ($received == 1) {
                        
                        $this->db->select('CallCenterCashBalance,EuroVal');
                    $this->db->from('vendormaster');
                    $this->db->where('VendorId',$vendor_id);
                    $Vendorbal = $this->db->get()->row();
                    
                    
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Vendorbal Balance data". PHP_EOL
                        . json_encode($Vendorbal) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
                    
                        $updatedBal = $Vendorbal->CallCenterCashBalance+$receivedamount;
                        $updatedeuroBal = $Vendorbal->EuroVal+$euro_amount;
                        
                        $vendorbaldata = array('CallCenterCashBalance'=>$updatedBal,'EuroVal'=>$updatedeuroBal);
                            $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Vendormaster Update Balance data". PHP_EOL
                        . json_encode($vendorbaldata) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
                        
                        $this->db->where('VendorId',$vendor_id);
                        $this->db->update('vendormaster',$vendorbaldata);
                        
                    }
            redirect('all-expenses');
            
                }
                
                else{
                    $_SESSION['pop_mes'] = "Token does not match."; 
                    $log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Edit-Exp". PHP_EOL
                        . "Edit-Exp-Error-Message: ". "Transaction ID:" . $transactionId  . ' - ' . $_SESSION['pop_mes'] .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
                    redirect('all-expenses');
                }
    }
                
        
    }

}
