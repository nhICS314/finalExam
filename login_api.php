<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php

$email= $_REQUEST['email'];
$pw= $_REQUEST['pw'];

$message='';
$status='';

$sql="SELECT * FROM CUSTOMER WHERE CustomerEmail='$email' AND CustomerPW='$pw'";
$returnQuery = mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

if($customerRow = mysql_fetch_assoc($returnQuery ))
{
	$_SESSION['email']=$email;
	$_SESSION['pw']=$pw;
	$_SESSION['name']=$customerRow['CustomerName'];
    $_SESSION['id']=$customerRow['CustomerID'];
    $message = "Login Successful!";
	$status = 1;
}
else
{
	$message = "Sorry, $email isn't registered with Campus Travel or your password was incorrect.";
	$status = 0;
}
$json = json_encode(["status" => $status, "message" => $message]);
echo $json;

?>