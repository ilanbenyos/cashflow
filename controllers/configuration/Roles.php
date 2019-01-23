<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
    public function __construct() {
        parent::__construct ();
        
        $this->load->helper ( 'url_helper' );
        $this->load->helper ( 'url' );
        $this->load->helper('form');
        $this->load->library('form_validation');
        //$this->load->model('all_model');
        $this->load->database();
        $this->load->helper('prodconfig');
        
    }
	public function index()
	{	
	    $this->load->view('templates/header');
	    $this->load->view('templates/left-sidebar');
	    $this->load->view('configuration/roles');
	    $this->load->view('templates/footer');
		
	}
	public function createRole(){
	    if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
	    $token = $this->input->post('edit_details');
	    
	    $session_token=null;
	    
	    $session_token = $_SESSION['edit_userdetails'];
	    unset($_SESSION['edit_userdetails']);
	    
	    if(!empty($token) == $session_token)
	    {
	        $rolename = $this->input->post('rolename');
	        
	        if(isset($_POST['Configuration']) == 'on'){
	            $conf = 1;
	        }else{
	            $conf = 0;
	        }
	        if(isset($_POST['PlannedExp']) == 'on'){
	            $plnexp = 1;
	        }else{
	            $plnexp = 0;
	        }
	        if(isset($_POST['ActualExp']) == 'on'){
	            $actexp = 1;
	        }else{
	            $actexp = 0;
	        }
	        if(isset($_POST['Deposits']) == 'on'){
	            $deposit = 1;
	        }else{
	            $deposit = 0;
	        }
	        if(isset($_POST['Reports']) == 'on'){
	            $reports = 1;
	        }else{
	            $reports = 0;
	        }
	        $active = 1;
	        $data = array(
	            'RoleName' => $rolename,
	            'Configuration' => $conf,
	            'PlannedExp' => $plnexp,
	            'ActualExp' => $actexp,
	            'Deposits' => $deposit,
	            'Reports' => $reports,
	            'Active' => $active
	        );
	        $addrole = $this->db->insert('rolemaster',$data);
	        if($addrole){
	            $_SESSION ['pop_mes'] = "Role created successfully";
	            popup2();
	        }else{
	            $_SESSION ['pop_mes'] = "Try again";
	            popup2();
	        }
	    }else{
	        redirect('configuration/roles');
	    }
	    
	    /* foreach($role as $roles ){
	        print_r($roles);
	    }   */
	}
	public  function editrole(){
	    echo 'hi';
	}
}
