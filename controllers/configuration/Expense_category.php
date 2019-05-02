<?php
class Expense_category extends CI_Controller {
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
	public function index(){
		if(!isset($_SESSION['logged_in']))
	    {
	        redirect('login');
	    }
		$data['allCat'] = $this->all_model->getAllCategories();
		$this->load->view('templates/header');
		$this->load->view('templates/left-sidebar2');
		$this->load->view('templates/content');
		$this->load->view('configuration/expense_category',$data);
		$this->load->view('templates/footer');
	}
	public function allExpCategory(){
		$data['allCat'] = $this->all_model->getAllCategories();
		$this->load->view('configuration/expense_category',$data);
	}
	public function addNewCategory(){
		if(!isset($_SESSION['logged_in'])){
			redirect('login');
		}
		$this->form_validation->set_rules ( 'category', 'Category Name', 'trim|required' );
		if ($this->form_validation->run () === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('configuration/add_expense_category');
			$this->load->view('templates/footer');
		}else{
			$token = $this->input->post('category_token');
        		$session_token=null;
        		$session_token = $_SESSION['new_category'];
        		if(!empty($token) == $session_token){	
        			$date = date('Y-m-d H:i:s');
        			$category = $this->input->post('category');
        			$uid = $this->input->post('userid');
        			//$desc = $this->input->post('desc');
        			$addCat = array(
        				'Category' => $category,
        				'CreatedBy' => $uid,
        				'CreatedOn' =>$date
        			);
        			$this->db->insert('expcategory',$addCat);
        			$_SESSION['pop_mes'] = "Expense Category Added Successfully."; 
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
	    $this->form_validation->set_rules ( 'category', 'Category Name', 'trim|required' );
	    if ($this->form_validation->run () === FALSE) {
	    	$data['cat'] = $this->all_model->getcategory($id);
			//$this->load->view('templates/header');
			//$this->load->view('templates/left-sidebar');
			$this->load->view('configuration/edit_expense_category',$data);
			//$this->load->view('templates/footer');
		}else{
			$token = $this->input->post('editcategory_token');
        		$session_token=null;
        		$session_token = $_SESSION['edit_category'];
        		if(!empty($token) == $session_token){
        			$category = $this->input->post('category');
        			$uid = $this->input->post('userid');

        			$updateCat = array(
        				'Category' => $category,
        				'ModifiedBy' => $uid
        			);
        			$this->db->where('CatId',$id);
        			$this->db->update('expcategory',$updateCat);
        			$_SESSION['pop_mes'] = "Expense Category Updated Successfully."; 
					return 1;
        		}else{
        			$_SESSION['pop_mes'] = "Token does not match."; 
					return 1;
        		}

		}

	}
}