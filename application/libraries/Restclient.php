<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Restclient{
	function regApi($method, $path = NULL, $data = NULL, $header = NULL, $multipart = FALSE) {
		$url   	  = 'https://dummyapi.io/data/v1/';
		$header_static = array(
		  'app-id: 627dec5214376b6201264787',
		  'Content-Type: application/json'
		);

		$header_array = array();
		foreach($header_static as $item) {
		  $header_array[] = "$item";
		}

		if($header !== NULL && !empty($header)) {
		  foreach($header as $key => $item) {
		    $header_array[] = "$key: $item";
		  }
		}

		if($path === NULL) return json_encode(array('code' => '400', 'message' => 'Bad Request'));

		switch ($method) {
		  case 'GET':
		    $curl = curl_init();
		    curl_setopt_array($curl, array(
		        CURLOPT_URL => $url . $path,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        CURLOPT_TIMEOUT => 0,
		        CURLOPT_FOLLOWLOCATION => true,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_HTTPHEADER =>  $header_array,
		        CURLOPT_CUSTOMREQUEST => "GET"
		    ));
		    $response = curl_exec($curl);
		    $err = curl_error($curl);
		    if($response) {
		      return json_decode($response, TRUE);
		    } else {
		      echo $err;
		    }
		    break;

		  case 'POST':
		    $curl = curl_init();
		    curl_setopt_array($curl, array(
		        CURLOPT_URL => $url . $path,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        CURLOPT_TIMEOUT => 0,
		        CURLOPT_FOLLOWLOCATION => true,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_HTTPHEADER =>  $header_array,
		        CURLOPT_CUSTOMREQUEST => "POST",
		        CURLOPT_POSTFIELDS     => $multipart ? $data : json_encode($data)
		    ));
		    $response = curl_exec($curl);
		    $err = curl_error($curl);
		    if($response) {
		      return json_decode($response, TRUE);
		    } else {
		      echo $err;
		    }
		    break;

		  case 'PUT':
		    $curl = curl_init();
		    curl_setopt_array($curl, array(
		        CURLOPT_URL => $url . $path,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        CURLOPT_TIMEOUT => 0,
		        CURLOPT_FOLLOWLOCATION => true,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_HTTPHEADER =>  $header_array,
		        CURLOPT_CUSTOMREQUEST => "PUT",
		        CURLOPT_POSTFIELDS     => $multipart ? $data : json_encode($data)
		    ));
		    $response = curl_exec($curl);
		    $err = curl_error($curl);
		    if($response) {
		      return json_decode($response, TRUE);
		    } else {
		      echo $err;
		    }
		    break;

		  case 'delete':
		    $curl = curl_init();
		    curl_setopt_array($curl, array(
		        CURLOPT_URL => $url . $path,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        CURLOPT_TIMEOUT => 0,
		        CURLOPT_FOLLOWLOCATION => true,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_HTTPHEADER =>  $header_array,
		        CURLOPT_CUSTOMREQUEST => "DELETE"
		    ));
		    $response = curl_exec($curl);
		    $err = curl_error($curl);
		    if($response) {
		      return json_decode($response, TRUE);
		    } else {
		      echo $err;
		    }
		    break;

		  default:
		    return json_encode(array('code' => '405', 'message' => 'Method Not Allowed'));
		    break;
		}
	}
}