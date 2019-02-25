<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//include_once 'test2.php';

//$database = new Database();
//$db = $database->getConnection();

//$product = new Product($db);

// get posted data
class data
{

	public $Symbol;
	public $Ctm;
	public $Bid;
	public $Ask;

}

//$data = json_decode(file_get_contents("php://input"));
$data = file_get_contents("php://input");

$request = new data();
$request->Symbol= $_POST['Symbol'];
$request->Ctm= $_POST['Ctm'];
$request->Bid= $_POST['Bid'];
$request->Ask= $_POST['Ask'];

// make sure data is not empty
if(
		!empty($request->Symbol) &&
		!empty($request->Ctm) &&
		!empty($request->Bid) &&
		!empty($request->Ask)
		){
			
			// set product property values
			$product->Symbol= $data->Symbol;
			$product->Ctm= $data->Ctm;
			$product->Bid= $data->Bid;
			$product->Ask= $data->Ask;
			
		
				
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
?>