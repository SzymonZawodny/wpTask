<?php
//function to validate the email address
function checkEmail($email){

	if(eregi("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]", $email)){
		return FALSE;
	}

	list($Username, $Domain) = split("@",$email);

	if(@getmxrr($Domain, $MXHost)){
		return TRUE;

	} else {
		if(@fsockopen($Domain, 25, $errno, $errstr, 30)){
			return TRUE;
		} else {

			return FALSE;
		}
	}
}



//response array
$response_array = array();

//validate the post form

if(empty($_POST['name'])){

	$response_array['status'] = 'error';
	$response_array['message'] = 'Name is blank';

} elseif(!checkEmail($_POST['email'])) {

	$response_array['status'] = 'error';
	$response_array['message'] = 'Email is blank or invalid';

} elseif(empty($_POST['message'])) {

	$response_array['status'] = 'error';
	$response_array['message'] = 'Message is blank';


//send email
} else {

	$body = $_POST['name'] . " sent you a message\n";
	$body .= "Details:\n\n" . $_POST['message'];
	mail($_POST['email'], "SUBJECT LINE", $body);

	$response_array['name'] = $_POST['name'];
	$response_array['email'] = $_POST['email'];
	$response_array['message'] = $_POST['message'];

}

header('Content-Type: application/json');
echo json_encode($response_array);

