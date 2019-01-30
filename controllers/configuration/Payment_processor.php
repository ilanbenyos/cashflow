<?php
class Payment_processor extends CI_Controller {
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


/*public function que()
	{
		
		$query3 = $this->db->query("select * from usermaster limit 1");
		$data_1= $query3->result();
		echo '<pre/>';
		print_r($data_1);
		
	}*/
	public function index(){
		    if(!isset($_SESSION['logged_in']))
		    {
		        redirect('login');
		    }
		    $data['banks'] = $this->all_model->get_all_banks();
		    $data['all_psp'] = $this->all_model->get_all_psp();
            $data['pspType'] = $this->all_model->allPspType();

			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('configuration/payment_processor',$data);
			$this->load->view('templates/footer');
		}
	public function addPsp(){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$this->form_validation->set_rules('psp_name', 'PSP Name', 'required');
		$this->form_validation->set_rules('bank', 'Bank', 'required');
    	if($this->form_validation->run() === FALSE)
    	{	
    		$data['title'] = 'Add Payment Provider';
    		
    		$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('configuration/payment_processor');
			$this->load->view('templates/footer');
    	}else{
    		$token = $this->input->post('new_psp');
    	    
    	    $session_token=null;
    	    
    	    $session_token = $_SESSION['add_psp'];
    	    
    	    if(!empty($token) == $session_token)
    	    {	
    	    	$psp_name = $this->input->post('psp_name');
    	        $BankId = $this->input->post('bank');
    	        $pspType = $this->input->post('psp_type');
    	        $PayTerm = $this->input->post('payment_terms');
    	        $crr = $this->input->post('crc');
    	        $commision = $this->input->post('commision');
    	        $message = $this->input->post('message');

    	        $status = $this->input->post('status');
    	        $uid = $this->input->post('userid');

    	        $pspinfo = array(
    	            
    	            'PspName' => $psp_name,
    	            'BankId' => $BankId,
    	            'Comments' => $message,
    	            //'PspType' => $pspType,
                    'TypeId' => $pspType,
    	            'PayTerm' => $PayTerm,
    	            'crr' => $crr,
    	            'Commission' => $commision,
    	            'CreatedBy' => $uid,
					'Active' => $status
    	        );
    	        $psp = $this->db->insert('pspmaster',$pspinfo);
    	        $_SESSION['pop_mes'] = "Payment Provider Added Successfully."; 
    	           return 1;
    	    }else{
    	    	$_SESSION['pop_mes'] = "Token does not matched.";
    	            return 1;
    	    }
    	}
	}
	public function editpsp($id){
		$data['banks'] = $this->all_model->get_all_banks();
		$data['getpsp'] = $this->all_model->get_psp($id);
		$data['all_psp'] = $this->all_model->get_all_psp();
        $data['pspType'] = $this->all_model->allPspType($id);
		$this->load->view('configuration/edit_psp',$data);
	}
	public function editpspData($id){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$this->form_validation->set_rules('psp_name1', 'PSP Name', 'required');
		$this->form_validation->set_rules('bank1', 'Bank', 'required');
    	if($this->form_validation->run() === FALSE)
    	{	
    		$data['title'] = 'Edit Payment Provider';
    		
    		$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('configuration/payment_processor');
			$this->load->view('templates/footer');
    	}else{
    		$token = $this->input->post('edit_pspdetails');
    	    
    	    $session_token=null;
    	    
    	    $session_token = $_SESSION['edit_psp'];
    	    
    	    if(!empty($token) == $session_token)
    	    {
    	    	$psp_name = $this->input->post('psp_name1');
    	        $BankId = $this->input->post('bank1');
    	        $pspType = $this->input->post('psp_type1');
    	        $PayTerm = $this->input->post('payment_terms1');
    	        $crr = $this->input->post('crc1');
    	        $commision = $this->input->post('commision1');
    	        $message = $this->input->post('message1');
    	        $status = $this->input->post('status1');
    	        $uid = $this->input->post('userid');

    	        $pspinfo = array(
    	            
    	            'PspName' => $psp_name,
    	            'BankId' => $BankId,
    	            'Comments' => $message,
    	            //'PspType' => $pspType,
                    'TypeId' => $pspType,
    	            'PayTerm' => $PayTerm,
    	            'crr' => $crr,
    	            'Commission' => $commision,
    	            'CreatedBy' => $uid,
					'Active' => $status
    	        );
    	        $this->db->where('PspId',$id);
	        	$this->db->update('pspmaster',$pspinfo);
	        	$_SESSION['pop_mes'] = "Payment Provider Updated Successfully.";
	        		return 1;
    	    }else{
    	    	$_SESSION['pop_mes'] = "Token does not matched.";
    	            return 1;
    	    }
    	}
	}
}
