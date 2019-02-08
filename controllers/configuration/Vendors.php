<?php
class Vendors extends CI_Controller {
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


public function que()
	{
echo '<pre/>';
		   $query1 = $this->db->query("select * from `psptype`  ");
		print_r($query1->result());
		
		
		//$fields = $this->db->list_fields('pspmaster');
		//print_r($fields);
	}
	public function curr($id){
		/*$this->db->select('b.BankId,b.BankName,b.CurId,v.Currency,v.BankId,c.CurId,c.CurName');
		$this->db->from('bankmaster b');
		$this->db->join('vendormaster v','v.Currency = b.CurId');
		$this->db->join('currencymaster c','c.CurId = b.CurId');
		$this->db->where('b.BankId',$id);
		$this->db->where('b.Active',1);
		$query = $this->db->get();
		$res = $query->row();*/
		$this->db->select('b.BankId,b.CurId,cm.CurId,cm.CurName');
		$this->db->from('bankmaster b');
		$this->db->join('currencymaster cm','cm.CurId = b.CurId');
		$this->db->where('b.BankId',$id);
		$query = $this->db->get();
		$res = $query->row();
		$data['currency'] = $res;
		echo json_encode($data);
	}


	public function index(){
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$data['title'] = ' Vendors';
		$Vendors = $this->all_model->get_vendor_details();
	//	$Categories = $this->all_model->get_active_categories();
		$Banks = $this->all_model->get_all_banks();
		$data['currency'] = $this->all_model->getAllCurrency();
		$data['vendors'] = $Vendors;
		//$data['categories'] = $Categories;
		//$data['banks'] = $Banks;
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('configuration/vendors',$data);
		$this->load->view('templates/footer');
	}
	
	public function createVendor()
	{	

	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
			
    	    $token = $this->input->post('vendor_details');
    	    $session_token=null;
    	    $session_token = $_SESSION['vendor_details'];
    	    unset($_SESSION['vendor_details']);
    	    
    	    if(!empty($token) == $session_token)
    	    {
    	        $date = date('Y-m-d H:i:s');
				
    	        $sVname = $this->input->post('Vname');
    	       // $ExpCatID = $this->input->post('ExpCatID');
    	        $sInvoiceType = $this->input->post('InvoiceType');
    	        $Currency = $this->input->post('Currency');
    	        //$BankId = $this->input->post('BankId');
				$Status= $this->input->post('Status');
				$uid = $this->input->post('userid');

				if(	$this->input->post('Comments') 	!= ""){
						$Comments= $this->input->post('Comments');
				}else{ 
				$Comments=" ";
				}
    	        $aVendorInfo = array(
    	            
    	            'VendorName' => $sVname,
    	            //'CategoryId' => $ExpCatID,
					'Comments' => $Comments,
    	            'InvoiceType' => $sInvoiceType,
    	            'Currency' => $Currency,
    	            //'BankId' => $BankId,
					'Active' => $Status,
					'CreatedBy' => $uid,
					'CreatedOn' =>$date
    	        );
					
    	        $user = $this->db->insert('vendormaster',$aVendorInfo);
				
                $_SESSION['pop_mes'] = "VendorInfo Added Successfully."; 
    	       redirect('configuration/vendors');
    	    }else{
    	        $_SESSION['pop_mes'] = "Token does not matched.";
    	      redirect('configuration/vendors');
    	    }
    			
    	
	}
	
	
		public function update($id){
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		    $this->form_validation->set_rules ( 'Vname', 'Vendor Name', 'trim|required' );
			$this->form_validation->set_rules ( 'InvoiceType', 'Invoice Type', 'trim|required' );
			$this->form_validation->set_rules ( 'Status', 'Status', 'trim|required' );
		
		if ($this->form_validation->run () === FALSE) {
			$data ['title'] = 'Update Vendor Details';
			$Vendor_details = $this->all_model->get_vendor_details_byid($id);
		//	$Categories = $this->all_model->get_active_categories();
			$Banks = $this->all_model->get_all_banks();
			$data['Vendor_details'] = $Vendor_details;
			$data['currency'] = $this->all_model->getAllCurrency();
			$data['currencyId'] = $this->all_model->getCurrency($id);
		//	$data['categories'] = $Categories;
			//$data['banks'] = $Banks;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/left-sidebar', $data);
			$this->load->view('configuration/edit-vendor', $data);
			$this->load->view('templates/footer');
			}
		else
		{
		
		$token = $this->input->post('vendor_details');
        		
        		$session_token=null;
        		
        		$session_token = $_SESSION['vendor_details'];
        		unset($_SESSION['vendor_details']);
        		
        		if(!empty($token) == $session_token)
        		{
				$sVname = $this->input->post('Vname');
    	     //   $ExpCatID = $this->input->post('ExpCatID');
    	        $sInvoiceType = $this->input->post('InvoiceType');
    	        $Currency = $this->input->post('Currency');
    	        //$BankId = $this->input->post('BankId');
				$Status= $this->input->post('Status');
    	       	$Comments= $this->input->post('Comments');
    	       	$uid = $this->input->post('userid');
			   $aVendorInfo = array(
    	            
    	            'VendorName' => $sVname,
    	         //   'CategoryId' => $ExpCatID,
    	            'InvoiceType' => $sInvoiceType,
    	            'Currency' => $Currency,
    	            //'BankId' => $BankId,
					'Comments' => $Comments,
					'Active' => $Status,
					'ModifiedBy' => $uid
    	        );
			 $this->db->where('VendorId',$id);
	        $user = $this->db->update('vendormaster',$aVendorInfo);
    	       
				$_SESSION['pop_mes'] = "Vendor Details Updated Successfully."; 
				
				redirect('configuration/vendors');
				
					
				}
				else{
					$_SESSION['pop_mes'] = "Token does not matched."; 
				
					redirect('configuration/vendors');
					
				}
		
			
		}
	}
}
