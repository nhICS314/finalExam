<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php

$email = $_SESSION['email'];

$agent= $_REQUEST['agent'];
$destination= $_REQUEST['destination'];
$date= $_REQUEST['date'];
$seatCount= $_REQUEST['seatCount'];

$customerKey= $_REQUEST['customerKey'];

$link = 'http://nicolemh.ics321.com/finalExam/buy_seat_api_call_sp.php?agent='
	. $agent
	. '&destination='.$destination
	.'&date=' . $date
	. '&customerKey='.$customerKey
	.'&seatCount='.$seatCount;

$emailMessage = "Please click link to confirm your booking: $link";
$message = "An email was sent to $email.  Please click the link to confirm your booking";
mail($email,"Your Booking Request on Campus Travel: Click to confirm",$emailMessage, "From: ICS321 Project <nicolemh@ics321.com>");
$status = 1;

$json = json_encode(["status" => $status, "message" => $message]);
echo $json;

?>