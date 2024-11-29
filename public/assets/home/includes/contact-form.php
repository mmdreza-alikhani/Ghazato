<?php
	$string = file_get_contents("config.json");
	$option = json_decode($string);
	define("MAIL_HOST", $option->MAIL_HOST);
	define("MAIL_TITLE", $option->MAIL_TITLE);
	if (isset($_POST['name']))
	    $name = $_POST['name'];
	else
	    $name = "unknown";

	if (isset($_POST['message']))
	    $message = nl2br($_POST['message']);
	else
	    $message = "unknown";

	if (isset($_POST['phone']))
	    $phone =  $_POST['phone'];
	else
	    $phone = "unknown";

	if (MAIL_HOST != null) {
	    $to = MAIL_HOST;
	} else {
	    $to = "tungldqn@gmail.com";
	}
	$from = $email;
	if (MAIL_TITLE != null) {
	    $subject = MAIL_TITLE;
	} else {
	    $subject = '[Umber] Contact Form Message';
	}
	$message =  '<b>Name:</b> ' . $name . '<br><b>Phone:</b> ' . $phone . '<br><b>Message:</b> ' . $message;
	$headers = "From: $from\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	if( mail($to, $subject, $message, $headers) ) {
	    $serialized_data = '{"type":"success", "message":"Contact form successfully submitted. Thank you, I will get back to you soon!"}';
	    echo $serialized_data;
	} else {
	    $serialized_data = '{"type":"danger", "message":"Contact form failed. Please send again later!"}';
	    echo $serialized_data;
	}
?>