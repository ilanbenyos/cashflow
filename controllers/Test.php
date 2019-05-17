<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
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
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        //$this->load->view('test/test');
        //$this->load->view('templates/footer1');
    }
    public function test1(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test2(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test3(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test4(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test5(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
    public function test6(){
        $this->load->view('templates/header1');
        $this->load->view('templates/left-sidebar2');
        $this->load->view('templates/footer1');
    }
	
	 public function upload_test(){
        $this->load->view('test_upload');
    }
	public function Upload() {
       $config['upload_path'] = realpath(APPPATH . '../upload_document');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());

            print_r($error);
        } else {
            $data = array('image_metadata' => $this->upload->data());
            print_r($data);

        }
    }


}
