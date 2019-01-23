<?php
require_once(APPPATH.'libraries/requestparam.php');
class Trade extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		
	}

public function InsertTrades()
{

	//$data = json_decode(file_get_contents("php://input"));
	$data = file_get_contents("php://input");
	print_r($data);
	
	$myfile = fopen("test_api_output.txt", "a") or die("Unable to open file!");
	//$data=json_encode($_REQUEST);
	fwrite($myfile,json_encode($data));
	fclose($myfile);
	/*
	$request = new data();
	$request->name= $_POST['name'];
	$request->description= $_POST['description'];
	$request->price= $_POST['price'];
	$request->category_id= $_POST['category_id'];
	
	// make sure data is not empty
	if(
			!empty($request->name) &&
			!empty($request->price) &&
			!empty($request->description) &&
			!empty($request->category_id)
			){
				
				// set product property values
				$product->name = $data->name;
				$product->price = $data->price;
				$product->description = $data->description;
				$product->category_id = $data->category_id;
				$product->created = date('Y-m-d H:i:s');
				
				
				
				// set response code - 201 created
				http_response_code(201);
				
				// tell the user
				echo json_encode(array("message" => "Product was created."));
				
				$myfile = fopen("test_api_output.txt", "a") or die("Unable to open file!");
				//$data=json_encode($_REQUEST);
				fwrite($myfile,json_encode($product));
				fclose($myfile);
				
	}
	
	// tell the user data is incomplete
	else{
		
		// set response code - 400 bad request
		http_response_code(400);
		
		// tell the user
		echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
	}
	
	*/
}

}