<?php
//header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
/*
	
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$addr = $_POST['address'];
$pin = $_POST['pincode'];

if(($fname==null) ||($lname==null)||($addr==null)||($pin==null))
{
echo "Error, please enter firstname,lastname,address,pincode.";
}
else
{
	$data2->firstname = $fname;
	$data2->lastname= $lname;
	$data2->address= $addr;
	$data2->pincode= $pin;
	
	
	$data[] = $data2;
	
	$obj_result = new \stdclass();
	$obj_result->data = $data;
//	$obj_result->is_success = true;
	echo $result = json_encode($obj_result);
	
//	echo "Firstname:".$fname." Lastname:".$lname." Address".$addr." Pincode".$pin;
	$myfile = fopen("test_api_output.txt", "a") or die("Unable to open file!");
	//$data=json_encode($_REQUEST);
	fwrite($myfile,$result);
}
*/	

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$addr = $_POST['address'];
$pin = $_POST['pincode'];

if(($fname==null) ||($lname==null)||($addr==null)||($pin==null))
{
	//echo "Error, please enter firstname,lastname,address,pincode.";
	response($fname,$lname,$addr,$pin,"Invalid Request");
}
else
{
	response($fname, $lname, $addr,$pin,"success");
}

function response($fname,$lname,$addr,$pin,$success){
	$response['firstname'] = $fname;
	$response['lastname'] = $lname;
	$response['address'] = $addr;
	$response['pincode'] = $pin;
	$response['success'] = $success;
	
	$json_response = json_encode($response);
	echo $json_response;
	
	$myfile = fopen("test_api_output.txt", "a") or die("Unable to open file!");
	//$data=json_encode($_REQUEST);
	fwrite($myfile,$json_response);
	fclose($myfile);
}
?>