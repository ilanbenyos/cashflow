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

	public $name;
	public $description;
	public $price;
	public $category_id;
	public $created;
}

//$data = json_decode(file_get_contents("php://input"));
$data = file_get_contents("php://input");

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
?>