<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_expenses extends CI_Controller {
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
    public function test(){
    	$data = array();
    	$des = array();
    	$this->db->select('NotificationId,VendorId,CallCenterExpId,PlannedDate');
                            $this->db->from('callcenternotification');
                            $this->db->where('NotificationId',20);
                            $query = $this->db->get();
                            $res = $query->row();
                            $res = explode(',', $res->CallCenterExpId);
                             $first = reset($res);
						    $last = end($res);

						    $data['first'] = $first;
						    $data['last'] = $last;
						    /*print_r($data);
						    exit();*/
                            foreach ($data as $value) {
                              //print_r($value);

                            $this->db->select('ExpId,ExpName,ExpAmount,ExpDate,ExpenseId');
                            $this->db->from('callcenterexpenses');
                            $this->db->where('ExpId',$value);
                            $query1 = $this->db->get();
                            $res1 = $query1->result();
                            foreach ($res1 as  $val) {
                              //print_r($val->ExpDate);
                              //$desc['desc'] = $val->ExpDate;
                              $des[] = $val->ExpDate;
                              //print_r($des);
                              //echo 'First Invoice Date - ' .$des['desc'] . 'Last Invoice Date - ' .$des['desc'] ;
                                //$description = $des;
                                //echo $description;
                                /*print_r($description);
                                echo '<br>';
                                echo 'First Invoice Date - ' .$description . 'Last Invoice Date - ' .$description ;
                                exit();*/
                            }
                            }
                            //print_r($des[1]);
                            echo 'First Invoice Date - ' .$des[0] . ' Last Invoice Date - ' .$des[1] ;


                            //$data = $res->CallCenterExpId;
                            //print_r($res->CallCenterExpId);



                            
    }
	public function allExpenses(){
		if (!isset($_SESSION['logged_in'])) {
			redirect('login');
		}
		//echo $_SESSION['user_role'];
		
		if ($_SESSION['user_role'] != "Call Center User") {
			
		$this->db->select('UserID,Name,RoleId,CallCenterVendorId,Active');
	      $this->db->from('usermaster');
	      $this->db->where('UserID',$_SESSION['userid']);
	      $this->db->where('Active',1);
	      $query = $this->db->get();
	      $VendorId = $query->row();
		// print_r($VendorId);

		}else{
			//echo "in";
			
			$this->db->select('u.UserID,u.Name,u.RoleId,u.CallCenterVendorId,u.Active,v.Currency,c.CurName');
			$this->db->from('usermaster u');
			$this->db->join('vendormaster v','v.VendorId = u.CallCenterVendorId','left');
			$this->db->join('currencymaster c','v.Currency = c.CurId','left');
			$this->db->where('u.UserID',$_SESSION['userid']);
			$this->db->where('u.Active',1);
			$query = $this->db->get();
			$VendorId = $query->row();
			//print_r($VendorId);
		}

			  
		$data['expenses'] = $this->all_model->getAllCallCenterExp($VendorId->CallCenterVendorId);
		$data['allexpenses'] = $this->all_model->getAllCallCenterVendor();
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar2');
		
			$this->load->view('templates/content');
		
		if ($_SESSION['user_role'] == "Call Center User") {
			$data['userdetails'] = $VendorId;
		}
	//	echo $_SESSION['user_role'];
		$this->load->view('callcenter/expenses',$data);
		$this->load->view('templates/footer');
	}
	public function callCenterExpenses(){
		$this->db->select('UserID,Name,RoleId,CallCenterVendorId,Active');
	      $this->db->from('usermaster');
	      $this->db->where('UserID',$_SESSION['userid']);
	      $this->db->where('Active',1);
	      $query = $this->db->get();
	      $VendorId = $query->row();


	      $this->db->select('u.UserID,u.Name,u.RoleId,u.CallCenterVendorId,u.Active,v.Currency,c.CurName');
			$this->db->from('usermaster u');
			$this->db->join('vendormaster v','v.VendorId = u.CallCenterVendorId');
			$this->db->join('currencymaster c','v.Currency = c.CurId');
			$this->db->where('u.UserID',$_SESSION['userid']);
			$this->db->where('u.Active',1);
			$query = $this->db->get();
			$res = $query->row();

			if ($_SESSION['user_role'] == "Call Center User") {
			$data['userdetails'] = $res;
		}
		$data['expenses'] = $this->all_model->getAllCallCenterExp($VendorId->CallCenterVendorId);
		//print_r($this->db->last_query());exit();
		$data['allexpenses'] = $this->all_model->getAllCallCenterVendor();
		//print_r($this->db->last_query());exit();
		$this->load->view('callcenter/expenses',$data);
	}
	
	public function callProfile(){
		  $this->db->select('v.VendorName,v.InvoiceType,v.Comments,c.CurName,v.BankAddress,v.IBAN,v.Comments,u.Email,u.Password,b.BankName,v.Active');
	      $this->db->from('vendormaster v');
		  $this->db->join('usermaster u','v.VendorId = u.CallCenterVendorId');
		  $this->db->join('bankmaster b','v.Bank = b.BankId','left');
		  $this->db->join('currencymaster c','v.Currency = c.CurId','left');
	      $this->db->where('u.UserID',$_SESSION['userid']);
	      $query = $this->db->get();
	      $VendorId = $query->row();
		  $data['Vendor_details'] = $VendorId;
		  
		  
		  
		if ($_SESSION['user_role'] != "Call Center User") {
			$this->load->view('templates/content');
		}
		$this->load->view('callcenter/profile_view',$data);
	}
	public function AddFundReuest(){
		$Vendorid = $this->input->post('VendorID');
		$Amount = $this->input->post('Amount');
		$Currency = $this->input->post('Currency');
	  $request = array(
					'VendorID' => $Vendorid,
					'RequestAmount'=> $Amount,
					'Currency' => $Currency
	  );
	$insert = $this->db->insert('callcenter_request',$request);
		if($insert == 1){
			$_SESSION['pop_mes'] = "Call Center Fund Request Added Successfully.";
			echo 1;
		}else{
			$_SESSION['pop_mes'] = "Call Center Fund Request Failed.";
			echo 0;
		}
	}
	
	 public function allRequestes() {
        
        if (! isset ( $_SESSION ['logged_in'] )) {
            
            echo "loggedOut";
            
        } else {
			$date = date("Y-m-d");
            $this->db->select('r.RequestId,r.VendorID,r.RequestAmount,c.CurName,v.VendorName as Name,r.CreatedOn');
			$this->db->from('callcenter_request r');
			$this->db->join('vendormaster v','v.VendorId = r.VendorID');
			$this->db->join('currencymaster c','r.Currency = c.CurId');
			$this->db->where('r.ReminderStatus',0);
			$this->db->where('DATE(r.CreatedOn)',$date);
			$callcenter_request= $this->db->get ()->result();
            $notarra =array();
            foreach ( $callcenter_request as $notif ) {
                $notarra[] = $notif;
            }
            echo json_encode($notarra);
            
      }
        
    }
	public function add_expense(){
		if (!isset($_SESSION['logged_in'])) {
			redirect('login');
		}
		//echo 'txtt';
		$this->form_validation->set_rules ('expName', 'Expense Name', 'trim|required' );
		$this->form_validation->set_rules ('expAmount', 'Expense Amount', 'trim|required' );
		$this->form_validation->set_rules ('expDate', 'Expense Date', 'trim|required');
        $this->form_validation->set_rules ('expPaymentType', 'Expense Payment Type', 'trim|required');

        if ($this->form_validation->run () === FALSE) {
        	$data['vendors'] = $this->all_model->getCallCenterVendorUser();
			$data['pspType'] = $this->all_model->allPspType();
			$data['expCat'] = $this->all_model->get_active_categories();
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar2');
			$this->load->view('templates/content');
			$this->load->view('callcenter/add-expenses',$data);
			$this->load->view('templates/footer');
		}else{
			//print_r($_POST);
			$token = $this->input->post('expense_token_add');
    		$session_token=null;
    		$session_token = $_SESSION['token_expense_add'];
    		if(!empty($token) == $session_token){	
				
				$config['upload_path'] = 'upload_document';
				$config['allowed_types'] = 'pdf|PDF|png|PNG|xlsx|XLSX|jpg';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('upload_file')) {
					$error = array('error' => $this->upload->display_errors());
					$upload_doc="";
				} else {
					$data = array('image_metadata' => $this->upload->data());
					$upload_doc =$data['image_metadata']['file_name'];
				}
			
    			$expName = $this->input->post('expName');
    			$Vendorid = $this->input->post('Vendorid');
				$vendor_currncy = $this->all_model->get_vendor_currency_byid($Vendorid);
				$V_Currency =$vendor_currncy->CurName;
    			$expAmount = str_replace(',','',$this->input->post('expAmount'));
    			$expDate = $this->input->post('expDate');
                $expPaymentType = $this->input->post('expPaymentType');
                $uid = $this->input->post('userid');

                $from = $expDate;
				 if($_SESSION['user_role'] == "Admin") {
						
					if($V_Currency == 'EUR'){
						$exchange_rate = 0.00;
						$EUR_Amount = $Converted_Amount = $expAmount;
					}else if($V_Currency == 'USD'){
						$base_currency = 'EUR';
						$EUR_Amount = $expAmount;
						$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$base_currency);
						$val=json_decode($val);
						$exchange_rate = $val->rates->USD;
						$Converted_Amount = $expAmount * $exchange_rate;
						
					}
		
				 }
				 if($_SESSION['user_role'] == "Call Center User"){
					 if($V_Currency == 'EUR'){
						$exchange_rate = 0.00;
						$EUR_Amount = $Converted_Amount = $expAmount;
					}else if($V_Currency == 'USD'){
						$base_currency = 'USD';
						$Converted_Amount = $expAmount;
						$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$base_currency);
						$val=json_decode($val);
						$exchange_rate = $val->rates->EUR;
						$EUR_Amount = $expAmount * $exchange_rate;
					}
				 }
				
		
            		$a = explode ( '/', $from );
            		$c = trim ( $a [2], " " );
            		$d = trim ( $a [0], " " );
            		$from = $c . '-' . $a [1] . '-' . $d;
            		

            		$expense = array(
            			'ExpName' => $expName,
            			'VendorId'=> $Vendorid,
            			'ExpAmount' => $Converted_Amount,
						'ExchangeRate' =>$exchange_rate,
						'EuroValue'=>$EUR_Amount,
            			'ExpDate' => $from,
            			'ExpPaymentType' => $expPaymentType,
            			'CreatedBy' => $uid,
						'DocumentPath' =>$upload_doc
            		);
            		$this->db->insert('callcenterexpenses',$expense);
					
					$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "callcenterexpenses data". PHP_EOL
                        . json_encode($expense) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					
					
					$this->db->select('Balance,EuroVal');
                    $this->db->from('vendormaster');
                    $this->db->where('VendorId',$Vendorid);
                    $Vendorbal = $this->db->get()->row();
					
					/*echo 'Vendorbal' + $Vendorbal->Balance;
					echo '<br>';
					echo 'Converted_Amount' + $Converted_Amount;
					echo '<br>';
					echo 'VendorEURbal' + $Vendorbal->EuroVal;
					echo '<br>';
					echo 'EUR_Amount' + $EUR_Amount;
					exit();*/
					
					$updatedBal = $Vendorbal->Balance-$Converted_Amount;
						$updatedeuroBal = $Vendorbal->EuroVal-$EUR_Amount;
					
					
					$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Vendorbal Balance data". PHP_EOL
                        . json_encode($Vendorbal) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					
					
					$vendordata = array( 
					'Balance'=> $updatedBal,
            			'EuroVal' => $updatedeuroBal,
            		);
					$this->db->where ( 'VendorId', $Vendorid );
		$this->db->update ( 'vendormaster', $vendordata );
		
		$log = "ip:" . get_client_ip () . ' - ' . date ( "F j, Y, g:i a" ) . "[INFO]" .' : ' . "Vendorbal Balance while updating data". PHP_EOL
                        . json_encode($vendordata) .PHP_EOL . "-------------------------" . PHP_EOL;
                        file_put_contents ( logger_url_exp, $log . "\n", FILE_APPEND );
					
					
            		$_SESSION['pop_mes'] = "Call Center Expenses Added Successfully."; 
            		redirect('all-expenses');
        	}else{
        		$_SESSION['pop_mes'] = "Token does not match.";
        		redirect('all-expenses');
        	}
		}
	}
	public function update($id){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
	    $this->form_validation->set_rules ('expName', 'Expense Name', 'trim|required' );
		$this->form_validation->set_rules ('expAmount', 'Expense Amount', 'trim|required' );
		$this->form_validation->set_rules ('expDate', 'Expense Date', 'trim|required');
        $this->form_validation->set_rules ('expPaymentType', 'Expense Payment Type', 'trim|required');
        if ($this->form_validation->run () === FALSE) {
        	$data['vendors'] = $this->all_model->getCallCenterVendorUser();
        	$data['pspType'] = $this->all_model->allPspType();
			$data['expCat'] = $this->all_model->get_active_categories();
        	$data['expenses'] = $this->all_model->editCallCenterExp($id);
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar2');
			$this->load->view('templates/content');
			$this->load->view('callcenter/edit-expenses',$data);
			$this->load->view('templates/footer');
        }else{
        		$token = $this->input->post('expense_token_edit');
        		$session_token=null;
        		$session_token = $_SESSION['token_expense_edit'];
        		unset($_SESSION['token_expense_edit']);
        		
        		if(!empty($token) == $session_token)
        		{
					
					$config['upload_path'] = 'upload_document';
					$config['allowed_types'] = 'Pdf|excel|png|PDF|PNG|XLSX|xlsx';
					$this->load->library('upload', $config);
					$getexpenses = $this->all_model->editCallCenterExp($id);
					if($getexpenses->DocumentPath == "")
					{
						if (!$this->upload->do_upload('upload_file')) {
							$error = array('error' => $this->upload->display_errors());
							$upload_doc="";
						} else {
							$data = array('image_metadata' => $this->upload->data());
							$upload_doc =$data['image_metadata']['file_name'];
						}
					}else{
						$upload_doc=$getexpenses->DocumentPath;
					}
					
        		$expName = $this->input->post('expName');
        		$Vendorid = $this->input->post('Vendorid');
				$vendor_currncy = $this->all_model->get_vendor_currency_byid($Vendorid);
				$V_Currency =$vendor_currncy->CurName;
    			$expAmount = str_replace(',','',$this->input->post('expAmount'));
    			$expDate = $this->input->post('expDate');
                $expPaymentType = $this->input->post('expPaymentType');
                $uid = $this->input->post('userid');
                $from = $expDate;
		
            		$a = explode ( '/', $from );
            		$c = trim ( $a [2], " " );
            		$d = trim ( $a [0], " " );
            		$from = $c . '-' . $a [1] . '-' . $d;
					
            	 if($_SESSION['user_role'] == "Admin") {
						
					if($V_Currency == 'EUR'){
						$exchange_rate = 0.00;
						$EUR_Amount = $Converted_Amount = $expAmount;
					}else if($V_Currency == 'USD'){
						$base_currency = 'EUR';
						$EUR_Amount = $expAmount;
						$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$base_currency);
						$val=json_decode($val);
						$exchange_rate = $val->rates->USD;
						$Converted_Amount = $expAmount * $exchange_rate;
						
					}
		
				 }
				 if($_SESSION['user_role'] == "Call Center User"){
					 if($V_Currency == 'EUR'){
						$exchange_rate = 0.00;
						$EUR_Amount = $Converted_Amount = $expAmount;
					}else if($V_Currency == 'USD'){
						$base_currency = 'USD';
						$Converted_Amount = $expAmount;
						$val=file_get_contents('https://openexchangerates.org/api/latest.json?app_id=ad149373bf4741148162546987ec9720&base='.$base_currency);
						$val=json_decode($val);
						$exchange_rate = $val->rates->EUR;
						$EUR_Amount = $expAmount * $exchange_rate;
					}
				 }

            		$expense = array(
            			'ExpName' => $expName,
            			'VendorId'=> $Vendorid,
            			'ExpAmount' => $Converted_Amount,
						'ExchangeRate' =>$exchange_rate,
						'EuroValue'=>$EUR_Amount,
            			'ExpDate' => $from,
            			'ExpPaymentType' => $expPaymentType,
            			'CreatedBy' => $uid,
						'DocumentPath' =>$upload_doc
            		);
            		$this->db->where('ExpId',$id);
	        		$this->db->update('callcenterexpenses',$expense);
	        		$_SESSION['pop_mes'] = "Call Center Expense Updated Successfully.";
					redirect('all-expenses');	
        		}else{
        			$_SESSION['pop_mes'] = "Token does not match.";
        			redirect('all-expenses');
        		}

        }

	}
	public function generateInvoice(){
		$invoice = $this->all_model->generateMonthlyInvoice();
		//print_r($_SESSION);exit();
		//print_r($invoice);exit();
 		$month = date('M');
		if (count($invoice) > 0) {
			$sum = 0;
			$data = array();
			$expdate = array();
			foreach ($invoice as $key => $value) {

				$sum+= $value->amount;
				$data[] = $value->ExpId;
				$expdate[] = $value->ExpDate;
			
			}
			$this->db->select('UserID,Name,RoleId,CallCenterVendorId,Active');
			$this->db->from('usermaster');
			$this->db->where('UserID',$_SESSION['userid']);
			$this->db->where('Active',1);
			$query = $this->db->get();
			$VendorId = $query->row();


			$ExpAmount = $sum;
			//$user_name = $_SESSION['user_name'];
			$userId = $VendorId->CallCenterVendorId;
			$plannedDate = date("Y-m-d", strtotime("+1 week"));
			//$ExpId= json_encode($data);
			$ExpId= json_encode($data);
			$uid = $_SESSION['userid'];

			$notification = array(
				'VendorId'=>$userId,
				'CallCenterExpId'=>implode(" , ", $data),
				'Amount'=>$sum,
				'PlannedDate'=>$plannedDate,
				'ExpId'=>"",
				'Status'=>'1',
				'CreatedBy'=>$uid,
			);
			$this->db->insert('callcenternotification',$notification);

			//update callcenterexpenses 
			foreach ($data as  $val) {
				$this->db->where('ExpId',$val);
				$this->db->update('callcenterexpenses',array('IsInvoiceGen'=>1));
			}
			
			
			$_SESSION['pop_mes'] = "Invoice Generated Successfully.";
			return 1;
			 
		}else{
			$_SESSION['pop_mes'] = "There are no pending expenses to generate invoice.";
			return 1;
		}
		


		//insert in callcenternotification



		/*$data['vendors'] = $this->all_model->vendors();
        $data['transType'] = $this->all_model->getTransferType();
        $data['expCat'] = $this->all_model->get_active_categories();
        $data['banks'] = $this->all_model->get_all_banks();
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('add-expenses',$data);
		$this->load->view('templates/footer');*/

		/*$this->db->insert('expenses',$expenses);
		$ExpenseId = $this->db->insert_id();

		//update callcenterexpenses 
		$this->db->where('IsInvoiceGen',0);
		$this->db->update('callcenterexpenses',array('IsInvoiceGen'=>1,'ExpenseId'=>$ExpenseId));
		$_SESSION['pop_mes'] = "Invoice Generated Successfully.";*/
	}
	public function generateInvoiceAdmin(){	
		$invoice = $this->all_model->generateMonthlyInvoiceAdmin();
		//print_r($invoice);exit();
		$month = date('M');
		if (count($invoice) > 0) {
			$VendorId = array();
			$sum = 0;
			$data = array();
			$expdate = array();
			foreach ($invoice as $key => $value) {	
				//print_r($value->ExpId);
				$VendorId[] = $value->VendorId;
				$sum+= $value->amount;
				$expdate[] = $value->ExpDate;
			
			}
			$vendorCount = array_unique($VendorId);
			if (count($vendorCount) > 1) { 
				return 1;
			 }/*else{
				return 2;
			}*/
			//print_r(count($test));
			/*$this->db->select('ExpId,ExpName,VendorId,IsInvoiceGen,IsDelete');
			$this->db->from('callcenterexpenses');
			$this->db->where('VendorId',$VendorId[0]);
			$this->db->where('IsInvoiceGen',0);
			$this->db->where('IsDelete',1);
			$expId = $this->db->get()->result_array();
			

			foreach ($expId as $val) {
				$data[] = $val['ExpId'];
			}
			$ExpAmount = $sum;
			$plannedDate = date("Y-m-d", strtotime("+1 week"));
			$ExpId= json_encode($data);
			$uid = $_SESSION['userid'];
			$notification = array(
				'VendorId'=>$VendorId[0],
				'CallCenterExpId'=>implode(" , ", $data),
				'Amount'=>$sum,
				'PlannedDate'=>$plannedDate,
				'ExpId'=>"",
				'Status'=>'1',
				'CreatedBy'=>$uid,
			);
			$this->db->insert('callcenternotification',$notification);

			//update callcenterexpenses 
			foreach ($data as  $val) {
				$this->db->where('ExpId',$val);
				$this->db->update('callcenterexpenses',array('IsInvoiceGen'=>1));
			}
			
			
			$_SESSION['pop_mes'] = "Invoice Generated Successfully.";
			return 1;
		}else{
			$_SESSION['pop_mes'] = "There Are No Pending Expenses To Generate Invoice.";
			return 1;
		}*/

		}
	}

	public function invoiceForVendor(){
		/*print_r($_POST['vendor'][0]);
		exit();
*/		/*$this->db->select('VendorId,VendorName,Active,IsDelete');
		$this->db->from('vendormaster');
		$this->db->where('VendorName',$_POST['vendor'][0]);
		$this->db->where('IsDelete',1);
		$res = $this->db->get()->row();*/

		$this->db->select('c.ExpId,c.VendorId,c.ExpName,sum(c.ExpAmount) as amount,sum(c.EuroValue) as amount_euro,c.CreatedOn,c.ExpDate,v.VendorId,v.VendorName');
		$this->db->from('callcenterexpenses c');
		$this->db->join('vendormaster v','v.VendorId = c.VendorId');
		$this->db->where('v.VendorName',$_POST['vendor'][0]);
		$this->db->where('c.IsInvoiceGen',0);
		$this->db->where('MONTH(c.ExpDate)=MONTH(CURRENT_DATE())');
		$this->db->group_by('c.ExpId');

		$res = $this->db->get()->result();
		$month = date('M');
		if (count($res) > 0) {
			$sum = 0;
			$data = array();
			$expdate = array();
			$vendorId = array();
			foreach ($res as $value) {
			
			$sum+= $value->amount_euro;
			$data[] = $value->ExpId;
			$expdate[] = $value->ExpDate;
			$vendorId[] = $value->VendorId;
			}

			//print_r($vendorId);exit();
		$ExpAmount = $sum;
		$plannedDate = date("Y-m-d", strtotime("+1 week"));
		$ExpId= json_encode($data);
		$uid = $_SESSION['userid'];
		foreach ($vendorId as $val) {
			//print_r($val);
			
		}
		//print_r($val);exit();
		$notification = array(
				'VendorId'=>$val,
				'CallCenterExpId'=>implode(" , ", $data),
				'Amount'=>$sum,
				'PlannedDate'=>$plannedDate,
				'ExpId'=>"",
				'Status'=>'1',
				'CreatedBy'=>$uid,
			);
			//print_r($notification);
			$this->db->insert('callcenternotification',$notification);

		//update callcenterexpenses 
			foreach ($data as  $val) {
				$this->db->where('ExpId',$val);
				$this->db->update('callcenterexpenses',array('IsInvoiceGen'=>1));
			}

			$_SESSION['pop_mes'] = "Invoice Generated Successfully.";
			return 1;
		}else{
			$_SESSION['pop_mes'] = "There are no pending expenses to generate invoice.";
			return 1;
		}


		
		//print_r($res);
		/*$id = array();
		$vendors = array();
		$expId[] = $_POST['expId'];
		foreach ($expId as $value) {
			//print_r($value);
			array_push($id,$value);
		}
		print_r($id);
		exit();*/

		/*foreach ($id as $val) {
			//print_r($val);
			array_push($vendors,$val);
		}
		print_r($vendors);
		exit();
		$vendorCount = array_unique($id);
		print_r($vendorCount);exit();
		$allvalues = array(TRUE, TRUE, TRUE);
		if(array_sum($id) == count($id)) {
		    echo 'all true';
		} else {
		    echo 'some false';
		}*/
		//print_r($vendorCount);
	}
	public function delete($id){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
	    $data = array(
	    	'IsDelete' => 0
	    );
	    $this->db->where('ExpId',$id);
	    $this->db->update('callcenterexpenses',$data);
	    $_SESSION['pop_mes'] = "Call Center Expense Deleted Successfully.";
	    redirect('all-expenses');
	}
	

}
