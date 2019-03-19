<?php
class Users extends CI_Controller {
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
		
		$query3 = $this->db->query("select * from usermaster limit 1");
		$data_1= $query3->result();
		echo '<pre/>';
		print_r($data_1);
		
	}


	public function index(){
	    //print_r($_SESSION);exit();
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar');
		$this->load->view('configuration/users');
		$this->load->view('templates/footer');
	}
	public function createUser()
	{	
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		//$this->form_validation->set_rules('date', 'Date', 'required');
//$this->form_validation->set_rules('time', 'Date', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
    	$this->form_validation->set_rules('status', 'status', 'required');	
    	if($this->form_validation->run() === FALSE)
    	{	
    		$data['title'] = 'Add New User';
    		
    		$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('configuration/users');
			$this->load->view('templates/footer');
    	}else{
    	    $token = $this->input->post('user_details');
    	    
    	    $session_token=null;
    	    
    	    $session_token = $_SESSION['new_user'];
    	    //unset($_SESSION['new_user']);
    	    
    	    if(!empty($token) == $session_token)
    	    {
    	        $date = $this->input->post('date');
    	        $time = $this->input->post('time');
    	        $name = $this->input->post('name');
    	        $password = $this->input->post('password');
    	        $email = $this->input->post('email');
    	        $role = $this->input->post('role');
    	        $uid = $this->input->post('userid');
    	        $status = $this->input->post('status');
    	        $userinfo = array(
    	            
    	            'Name' => $name,
    	            'Email' => $email,
    	            'Password' => $password,
    	            'CreatedOn' => $date.$time,
    	            'RoleId' => $role,
    	            'CreatedBy' => $uid,
					'Active' => $status
    	        );
    	        $user = $this->db->insert('usermaster',$userinfo);
    	        
    	           $_SESSION['pop_mes'] = "User Added Successfully."; 
    	           return 1;
    	        
    	    }else{
    	        $_SESSION['pop_mes'] = "Token does not match.";
    	            return 1;
    	    }
    			
    	}
	}
	public function editUser($id){
	    $data ['result'] = $this->all_model->get_user_details ( $id );
	    $this->load->view('configuration/edit_user',$data);
	}
	public function editUserdata($id){
	    /* $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('date1', 'Date', 'required');
	    $this->form_validation->set_rules('time1', 'Date', 'required');
	    $this->form_validation->set_rules('name1', 'Name', 'required');
	    $this->form_validation->set_rules('password1', 'Password', 'required|min_length[6]');
	    $this->form_validation->set_rules('email1', 'Email', 'required');
	    $this->form_validation->set_rules('role1', 'Role', 'required');
	    if($this->form_validation->run() === FALSE)
	    {
	        $data['title'] = 'Add New User';
	        
	        $this->load->view('templates/header');
	        $this->load->view('templates/left-sidebar');
	        $this->load->view('configuration/users');
	        $this->load->view('templates/footer');
	    }else{  */
	    $token = $this->input->post('edit_details');
	    
	    $session_token=null;
	    
	    $session_token = $_SESSION['edit_userdetails'];
	    unset($_SESSION['edit_userdetails']);
	    
	    if(!empty($token) == $session_token)
	    {
	        $userid = $this->input->post('userid');
	       // $date = $this->input->post('date1');
	    //    $time = $this->input->post('time1');
	        $name = $this->input->post('name1');
	        $password = $this->input->post('password1');
	        $email = $this->input->post('email1');
	        $role = $this->input->post('role1');
	        $status = $this->input->post('status');
	        $userinfo = array(
	            
	            'Name' => $name,
	            'Email' => $email,
	            'Password' => $password,
	            'CreatedOn' => $date.$time,
	            'RoleId' => $role,
				'Active' => $status
	        );
	        $this->db->where('UserID',$userid);
	        $this->db->update('usermaster',$userinfo);
	        //print_r($this->db->last_query());exit();
	        $_SESSION['pop_mes'] = "User data Saved.";
	        return 1;
	        //redirect('configuration/users');
	    }else{
	    	$_SESSION['pop_mes'] = "Token does not match.";
	       return 1;
	    }
	        
	   // }
	}
}
