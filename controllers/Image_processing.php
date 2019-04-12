<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_processing extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->helper(array('url'));
		$this->load->model('all_model');
		$this->load->helper('prodconfig');
	}

	public function index(){

		$this->load->helper('form');
		$this->load->helper('url');
		$config['upload_path'] = realpath(APPPATH . '../upload_document');
		$config['allowed_types'] = 'jpg|png|JPG|JPEG|PNG';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userfile', 'lang:Re-Enter Password', 'trim|required');

		/*if($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('templates/left-sidebar');
			$this->load->view('image_processing');
			$this->load->view('templates/footer');
		}else{*/
			

			$userfile= $this->input->post('userfile');
			$applicationId = 'TEST_RRR_OCR_APP';
		  	$password = '6l/LpOBrANQr4tCx8b53b76s';
		  	$fileName = 'invoice.pdf';

		  	$serviceUrl = 'https://cloud.ocrsdk.com';

		  	$local_directory=realpath(APPPATH . '../upload_document');

  			$filePath = $local_directory.'/'.$fileName;


  			if(!file_exists($filePath))
			  {
			    die('File '.$filePath.' not found.');
			  }
			  if(!is_readable($filePath) )
			  {
			     die('Access to file '.$filePath.' denied.');
			  }
			  //$url = $serviceUrl.'/processTextField?language=Russian,English&region=50,300,2170,3300&textType=normal';
			  $url = $serviceUrl.'/processImage?language=English,Russian&profile=documentConversion&imageSource=Photo&exportFormat=xml';
			  //$url = $serviceUrl.'/processTextField?language=english&region=407,300,2030,600';350,150,2030,2050,150,300,2070,3500,330,306,844,334,50,300,5000,3500
			  //$url = $serviceUrl.'/processCheckmarkField?region=324,5,411,13&checkmarkType=empty';124,290,190,300
			  $curlHandle = curl_init();
			  curl_setopt($curlHandle, CURLOPT_URL, $url);
			  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
			  curl_setopt($curlHandle, CURLOPT_POST, 1);
			  curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
			  curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);

			  $post_array = array();
			  if((version_compare(PHP_VERSION, '5.5') >= 0)) {
			    $post_array["my_file"] = new CURLFile($filePath);
			  } else {
			    $post_array["my_file"] = "@".$filePath;
			  }
			  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post_array); 
			  $response = curl_exec($curlHandle);
			  if($response == FALSE) {
			    $errorText = curl_error($curlHandle);
			    curl_close($curlHandle);
			    die($errorText);
			  }
			  $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
			  curl_close($curlHandle);
			  $xml = simplexml_load_string($response);
			  if($httpCode != 200) {
			    if(property_exists($xml, "message")) {
			       die($xml->message);
			    }
			    die("unexpected response ".$response);
			  }

			  $arr = $xml->task[0]->attributes();
			  $taskStatus = $arr["status"];
			  if($taskStatus != "Queued") {
			    die("Unexpected task status ".$taskStatus);
			  }
			  $taskid = $arr["id"];
			  $url = $serviceUrl.'/getTaskStatus';
			  if(empty($taskid) || (strpos($taskid, "00000000-0") !== false)) {
			   die("Invalid task id used when preparing getTaskStatus request");
			  }

			  $qry_str = "?taskid=$taskid";

			  while(true)
			  {
			    sleep(5);
			    $curlHandle = curl_init();
			    curl_setopt($curlHandle, CURLOPT_URL, $url.$qry_str);
			    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			    curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
			    curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
			    curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
			    $response = curl_exec($curlHandle);
			    $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
			    curl_close($curlHandle);
			  
			    // parse xml
			    $xml = simplexml_load_string($response);
			    if($httpCode != 200) {
			      if(property_exists($xml, "message")) {
			        die($xml->message);
			      }
			      die("Unexpected response ".$response);
			    }
			    $arr = $xml->task[0]->attributes();
			    $taskStatus = $arr["status"];
			    if($taskStatus == "Queued" || $taskStatus == "InProgress") {
			      // continue waiting
			      continue;
			    }
			    if($taskStatus == "Completed") {
			      // exit this loop and proceed to handling the result
			      break;
			    }
			    if($taskStatus == "ProcessingFailed") {
			      die("Task processing failed: ".$arr["error"]);
			    }
			    die("Unexpected task status ".$taskStatus);
			  }
			  $url = $arr["resultUrl"];
			  $curlHandle = curl_init();
			  curl_setopt($curlHandle, CURLOPT_URL, $url);
			  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
			  $response = curl_exec($curlHandle);
			  curl_close($curlHandle);
			  /*$xml1 = simplexml_load_string($response);
			  $temp = json_encode($xml1);
			  $temp1 = json_decode($temp,TRUE);*/
			  header('Content-type: application/xml');
  			  header('Content-Disposition: attachment; filename="file.xml"');
  			  echo $response;
			  //print_r($temp1['page'][0]['block'][0]['text']['par']);exit();
			  /*foreach ($temp1['page'][0]['block'][0]['text']['par'] as $value) {
			  	print_r($value['line']);*/
			  	/*foreach ($value as $value1) {
			  		//print_r($value1->text->par->line);
			  		foreach ($value1->text as $value2) {
			  			print_r($value2);
			  		}
			  	}*/
			  //}
			  // Let user donwload rtf result
			  /*header('Content-type: application/xml');
  header('Content-Disposition: attachment; filename="file.xml"');
  echo json_encode($response);*/
		//}
		
	}
	public function test(){
		$applicationId = 'TEST_RRR_OCR_APP';
		  	$password = '6l/LpOBrANQr4tCx8b53b76s';
		  	$fileName = 'invoice.pdf';

		  	$serviceUrl = 'https://cloud.ocrsdk.com';

		  	$local_directory=realpath(APPPATH . '../upload_document');

  			$filePath = $local_directory.'/'.$fileName;
		  // URL of the processing service. Change to http://cloud-westus.ocrsdk.com
		  // if you created your application in US location
		  
		  $filePath = $local_directory.'/'.$fileName;
		  if(!file_exists($filePath))
		  {
		    die('File '.$filePath.' not found.');
		  }
		  if(!is_readable($filePath) )
		  {
		     die('Access to file '.$filePath.' denied.');
		  }
		  // Recognizing with English language to rtf
		  // You can use combination of languages like ?language=english,russian or
		  // ?language=english,french,dutch
		  // For details, see API reference for processImage method
		  $url = $serviceUrl.'/processTextField?language=english,Russian&region=660,306,844,334&oneWordPerTextLine=false&oneTextLine=false&placeholdersCount=1';
		  //$url = $serviceUrl.'/processTextField?language=english,Russian&region=650,300,2030,2050&oneWordPerTextLine=false&oneTextLine=false&placeholdersCount=1';
		  
		  // Send HTTP POST request and ret xml response
		  $curlHandle = curl_init();
		  curl_setopt($curlHandle, CURLOPT_URL, $url);
		  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
		  curl_setopt($curlHandle, CURLOPT_POST, 1);
		  curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
		  curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
		  $post_array = array();
		  if((version_compare(PHP_VERSION, '5.5') >= 0)) {
		    $post_array["my_file"] = new CURLFile($filePath);
		  } else {
		    $post_array["my_file"] = "@".$filePath;
		  }
		  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post_array); 
		  $response = curl_exec($curlHandle);
		  if($response == FALSE) {
		    $errorText = curl_error($curlHandle);
		    curl_close($curlHandle);
		    die($errorText);
		  }
		  $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
		  curl_close($curlHandle);
		  // Parse xml response
		  $xml = simplexml_load_string($response);
		  if($httpCode != 200) {
		    if(property_exists($xml, "message")) {
		       die($xml->message);
		    }
		    die("unexpected response ".$response);
		  }
		  $arr = $xml->task[0]->attributes();
		  $taskStatus = $arr["status"];
		  if($taskStatus != "Queued") {
		    die("Unexpected task status ".$taskStatus);
		  }
		  
		  // Task id
		  $taskid = $arr["id"];  
		  
		  // 4. Get task information in a loop until task processing finishes
		  // 5. If response contains "Completed" staus - extract url with result
		  // 6. Download recognition result (text) and display it
		  $url = $serviceUrl.'/getTaskStatus';
		  // Note: a logical error in more complex surrounding code can cause
		  // a situation where the code below tries to prepare for getTaskStatus request
		  // while not having a valid task id. Such request would fail anyway.
		  // It's highly recommended that you have an explicit task id validity check
		  // right before preparing a getTaskStatus request.
		  if(empty($taskid) || (strpos($taskid, "00000000-0") !== false)) {
		    die("Invalid task id used when preparing getTaskStatus request");
		  }
		  $qry_str = "?taskid=$taskid";
		  // Check task status in a loop until it is finished
		  // Note: it's recommended that your application waits
		  // at least 2 seconds before making the first getTaskStatus request
		  // and also between such requests for the same task.
		  // Making requests more often will not improve your application performance.
		  // Note: if your application queues several files and waits for them
		  // it's recommended that you use listFinishedTasks instead (which is described
		  // at https://ocrsdk.com/documentation/apireference/listFinishedTasks/).
		  while(true)
		  {
		    sleep(5);
		    $curlHandle = curl_init();
		    curl_setopt($curlHandle, CURLOPT_URL, $url.$qry_str);
		    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
		    curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
		    curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
		    $response = curl_exec($curlHandle);
		    $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
		    curl_close($curlHandle);
		  
		    // parse xml
		    $xml = simplexml_load_string($response);
		    if($httpCode != 200) {
		      if(property_exists($xml, "message")) {
		        die($xml->message);
		      }
		      die("Unexpected response ".$response);
		    }
		    $arr = $xml->task[0]->attributes();
		    $taskStatus = $arr["status"];
		    if($taskStatus == "Queued" || $taskStatus == "InProgress") {
		      // continue waiting
		      continue;
		    }
		    if($taskStatus == "Completed") {
		      // exit this loop and proceed to handling the result
		      break;
		    }
		    if($taskStatus == "ProcessingFailed") {
		      die("Task processing failed: ".$arr["error"]);
		    }
		    die("Unexpected task status ".$taskStatus);
		  }
		  // Result is ready. Download it
		  $url = $arr["resultUrl"];  
		  //print_r($url);exit();
		  $curlHandle = curl_init();
		  curl_setopt($curlHandle, CURLOPT_URL, $url);
		  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		  // Warning! This is for easier out-of-the box usage of the sample only.
		  // The URL to the result has https:// prefix, so SSL is required to
		  // download from it. For whatever reason PHP runtime fails to perform
		  // a request unless SSL certificate verification is off.
		  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
		  $response = curl_exec($curlHandle);
		  curl_close($curlHandle);
		  $temp = json_encode($response);
		  $date = json_decode($temp,TRUE);
		 //print_r($date);exit();
		  // Let user donwload rtf result
		  /*header('Content-type: application/xml');
		  header('Content-Disposition: attachment; filename="file.xml"');
		  echo $response;*/

		  ///////// to get amount start 
		  //$url = $serviceUrl.'/processTextField?language=english,Russian&region=660,306,844,334&oneWordPerTextLine=false&oneTextLine=false&placeholdersCount=1';
		  $url = $serviceUrl.'/processTextField?language=english,Russian&region=826,546,969,565&oneWordPerTextLine=true&oneTextLine=true&placeholdersCount=1';
		  
		  // Send HTTP POST request and ret xml response
		  $curlHandle = curl_init();
		  curl_setopt($curlHandle, CURLOPT_URL, $url);
		  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
		  curl_setopt($curlHandle, CURLOPT_POST, 1);
		  curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
		  curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
		  $post_array = array();
		  if((version_compare(PHP_VERSION, '5.5') >= 0)) {
		    $post_array["my_file"] = new CURLFile($filePath);
		  } else {
		    $post_array["my_file"] = "@".$filePath;
		  }
		  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post_array); 
		  $response = curl_exec($curlHandle);
		  if($response == FALSE) {
		    $errorText = curl_error($curlHandle);
		    curl_close($curlHandle);
		    die($errorText);
		  }
		  $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
		  curl_close($curlHandle);
		  // Parse xml response
		  $xml = simplexml_load_string($response);
		  if($httpCode != 200) {
		    if(property_exists($xml, "message")) {
		       die($xml->message);
		    }
		    die("unexpected response ".$response);
		  }
		  $arr = $xml->task[0]->attributes();
		  $taskStatus = $arr["status"];
		  if($taskStatus != "Queued") {
		    die("Unexpected task status ".$taskStatus);
		  }
		  
		  // Task id
		  $taskid = $arr["id"];  
		  
		  // 4. Get task information in a loop until task processing finishes
		  // 5. If response contains "Completed" staus - extract url with result
		  // 6. Download recognition result (text) and display it
		  $url = $serviceUrl.'/getTaskStatus';
		  // Note: a logical error in more complex surrounding code can cause
		  // a situation where the code below tries to prepare for getTaskStatus request
		  // while not having a valid task id. Such request would fail anyway.
		  // It's highly recommended that you have an explicit task id validity check
		  // right before preparing a getTaskStatus request.
		  if(empty($taskid) || (strpos($taskid, "00000000-0") !== false)) {
		    die("Invalid task id used when preparing getTaskStatus request");
		  }
		  $qry_str = "?taskid=$taskid";
		  // Check task status in a loop until it is finished
		  // Note: it's recommended that your application waits
		  // at least 2 seconds before making the first getTaskStatus request
		  // and also between such requests for the same task.
		  // Making requests more often will not improve your application performance.
		  // Note: if your application queues several files and waits for them
		  // it's recommended that you use listFinishedTasks instead (which is described
		  // at https://ocrsdk.com/documentation/apireference/listFinishedTasks/).
		  while(true)
		  {
		    sleep(5);
		    $curlHandle = curl_init();
		    curl_setopt($curlHandle, CURLOPT_URL, $url.$qry_str);
		    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($curlHandle, CURLOPT_USERPWD, "$applicationId:$password");
		    curl_setopt($curlHandle, CURLOPT_USERAGENT, "PHP Cloud OCR SDK Sample");
		    curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
		    $response = curl_exec($curlHandle);
		    $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
		    curl_close($curlHandle);
		  
		    // parse xml
		    $xml = simplexml_load_string($response);
		    if($httpCode != 200) {
		      if(property_exists($xml, "message")) {
		        die($xml->message);
		      }
		      die("Unexpected response ".$response);
		    }
		    $arr = $xml->task[0]->attributes();
		    $taskStatus = $arr["status"];
		    if($taskStatus == "Queued" || $taskStatus == "InProgress") {
		      // continue waiting
		      continue;
		    }
		    if($taskStatus == "Completed") {
		      // exit this loop and proceed to handling the result
		      break;
		    }
		    if($taskStatus == "ProcessingFailed") {
		      die("Task processing failed: ".$arr["error"]);
		    }
		    die("Unexpected task status ".$taskStatus);
		  }
		  // Result is ready. Download it
		  $url = $arr["resultUrl"];  
		  $curlHandle = curl_init();
		  curl_setopt($curlHandle, CURLOPT_URL, $url);
		  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		  // Warning! This is for easier out-of-the box usage of the sample only.
		  // The URL to the result has https:// prefix, so SSL is required to
		  // download from it. For whatever reason PHP runtime fails to perform
		  // a request unless SSL certificate verification is off.
		  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
		  $response11 = curl_exec($curlHandle);
		  curl_close($curlHandle);
		  $data = simplexml_load_string($response11);
		  $temp1 = json_encode($data);
		  print_r($response11);exit();
		 /* $temp1 = json_encode($response1);
		  $phone_number = json_decode($temp1,TRUE);*/
		  //print_r($response1->value1 .);

	}
	
}