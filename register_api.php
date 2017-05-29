<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php
$name= $_REQUEST['name'];
$email= $_REQUEST['email'];
$pw= $_REQUEST['pw'];

$message='';
$status='';

$sql="SELECT * FROM CUSTOMER WHERE CustomerEmail='$email'";
$returnQuery = mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

if($registration = mysql_fetch_assoc($returnQuery ))
{
	$CustomerName=$registration['CustomerName'];
	$message = "$CustomerName with email $email is already registered at Campus Travel.";
	$status = 0;
}
else
{
      if(strlen($name)>=5 && strlen($pw)>=5 && strlen($email)>=5)
      {
	$sql="INSERT INTO CUSTOMER SET CustomerName='$name', CustomerEmail='$email', CustomerPW='$pw'";
	$insertQuery=mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');
	$message = "$name with email $email is now registered with Campus Travel.";
	$status = 1;
	mail("nicolemh@hawaii.edu","$name Registered",$message, "From: $name <$email>");
        $_SESSION['name']=$name;
	$_SESSION['email']=$email;
	$_SESSION['pw']=$pw;
      }else{
          $status=0; $message='Quit fooling around.';
      }
	
}
$json = json_encode(["status" => $status, "message" => $message]);
echo $json;

?>