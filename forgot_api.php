<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php
$email= $_REQUEST['email'];

$message='';
$status='';

$sql="SELECT * FROM CUSTOMER WHERE CustomerEmail='$email'";
$returnQuery = mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

if($registration = mysql_fetch_assoc($returnQuery ))
{
	$pw=$registration['CustomerPW'];
	$emailMessage = "Your requested information is: $pw";
	$message = "An email was sent to $email.";
	mail($email,"Requested Information",$emailMessage, "From: ICS321 Project <nicolemh@ics321.com>");
	$status = 1;
}
else
{
	$message = "Sorry, $email isn't registered with Campus Travel.";
	$status = 0;
}
$json = json_encode(["status" => $status, "message" => $message]);
echo $json;

?>