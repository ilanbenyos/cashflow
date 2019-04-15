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
		$this->db->select('UserID,Name,RoleId,CallCenterVendorId,Active');
	      $this->db->from('usermaster');
	      $this->db->where('UserID',$_SESSION['userid']);
	      $this->db->where('Active',1);
	      $query = $this->db->get();
	      $VendorId = $query->row();
		$data['expenses'] = $this->all_model->getAllCallCenterExp($VendorId->CallCenterVendorId);
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('callcenter/expenses',$data);
		$this->load->view('templates/footer');
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
			$data['pspType'] = $this->all_model->allPspType();
			$data['expCat'] = $this->all_model->get_active_categories();
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('callcenter/add-expenses',$data);
			$this->load->view('templates/footer');
		}else{
			$token = $this->input->post('expense_token_add');
    		$session_token=null;
    		$session_token = $_SESSION['token_expense_add'];
    		if(!empty($token) == $session_token){	
    			$expName = $this->input->post('expName');
    			$Vendorid = $this->input->post('Vendorid');
    			$expAmount = str_replace(',','',$this->input->post('expAmount'));
    			$expDate = $this->input->post('expDate');
                $expPaymentType = $this->input->post('expPaymentType');
                $uid = $this->input->post('userid');

                $from = $expDate;
		
            		$a = explode ( '/', $from );
            		$c = trim ( $a [2], " " );
            		$d = trim ( $a [0], " " );
            		$from = $c . '-' . $a [1] . '-' . $d;
            		

            		$expense = array(
            			'ExpName' => $expName,
            			'VendorId'=> $Vendorid,
            			'ExpAmount' => $expAmount,
            			'ExpDate' => $from,
            			'ExpPaymentType' => $expPaymentType,
            			'CreatedBy' => $uid
            		);
            		$this->db->insert('callcenterexpenses',$expense);
            		$_SESSION['pop_mes'] = "Expenses Added Successfully."; 
            		return 1;
        	}else{
        		$_SESSION['pop_mes'] = "Token does not match.";
        		return 1;
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
        	$data['pspType'] = $this->all_model->allPspType();
			$data['expCat'] = $this->all_model->get_active_categories();
        	$data['expenses'] = $this->all_model->editCallCenterExp($id);
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('callcenter/edit-expenses',$data);
			$this->load->view('templates/footer');
        }else{
        		$token = $this->input->post('expense_token_edit');
        		$session_token=null;
        		$session_token = $_SESSION['token_expense_edit'];
        		unset($_SESSION['token_expense_edit']);
        		
        		if(!empty($token) == $session_token)
        		{
        		$expName = $this->input->post('expName');
        		$Vendorid = $this->input->post('Vendorid');
    			$expAmount = str_replace(',','',$this->input->post('expAmount'));
    			$expDate = $this->input->post('expDate');
                $expPaymentType = $this->input->post('expPaymentType');
                $uid = $this->input->post('userid');
                $from = $expDate;
		
            		$a = explode ( '/', $from );
            		$c = trim ( $a [2], " " );
            		$d = trim ( $a [0], " " );
            		$from = $c . '-' . $a [1] . '-' . $d;
            		

            		$expense = array(
            			'ExpName' => $expName,
            			'VendorId'=> $Vendorid,
            			'ExpAmount' => $expAmount,
            			'ExpDate' => $from,
            			'ExpPaymentType' => $expPaymentType,
            			'CreatedBy' => $uid
            		);
            		$this->db->where('ExpId',$id);
	        		$this->db->update('callcenterexpenses',$expense);
	        		$_SESSION['pop_mes'] = "Expense Updated Successfully.";
					redirect('all-expenses');	
        		}else{
        			$_SESSION['pop_mes'] = "Token does not match.";
        			redirect('all-expenses');
        		}

        }

	}
	public function generateInvoice(){
		$invoice = $this->all_model->generateMonthlyInvoice();
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
			 
		}/*else{
			$_SESSION['pop_mes'] = "Current month Invoice not found. ";
			return 1;
		}*/
		


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
	

}
