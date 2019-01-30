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

		 echo $query1 = $this->db->query("ALTER TABLE `currencymaster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);
ALTER TABLE `currencymaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3");
	

		
	
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
		$data['vendors'] = $Vendors;
		//$data['categories'] = $Categories;
		$data['banks'] = $Banks;
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
    	        $Amount = $this->input->post('Amount');
    	        $sBankName = $this->input->post('BankName');
				$Status= $this->input->post('Status');
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
    	            'Amount' => $Amount,
    	            'BankName' => $sBankName,
					'Active' => $Status,
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
		//	$data['categories'] = $Categories;
			$data['banks'] = $Banks;
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
    	        $Amount = $this->input->post('Amount');
    	        $sBankName = $this->input->post('BankName');
				$Status= $this->input->post('Status');
    	       	$Comments= $this->input->post('Comments');
			   $aVendorInfo = array(
    	            
    	            'VendorName' => $sVname,
    	         //   'CategoryId' => $ExpCatID,
    	            'InvoiceType' => $sInvoiceType,
    	            'Amount' => $Amount,
    	            'BankName' => $sBankName,
					'Comments' => $Comments,
					'Active' => $Status
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