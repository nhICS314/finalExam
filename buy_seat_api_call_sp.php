<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>

	<html>
	<head>
		<title>Booking Confirmation</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
	</head>
<body>
<?php include('menu.php'); ?>

	<h1>Booking confirmation result</h1>

<?php



$agent= $_REQUEST['agent'];
$destination= $_REQUEST['destination'];
$date= $_REQUEST['date'];
$customerKey= $_REQUEST['customerKey'];
$seatCount= $_REQUEST['seatCount'];

$message='';
$status='';
$seatsLeft='';

$sql="call ADDMULTIPLESALES($agent,$destination,
	STR_TO_DATE('$date', '%Y-%m-%d'),$customerKey,$seatCount,@Success,@SeatsLeft)";
$returnQuery = mysql_query($sql, $conn) or
	die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

$returnQuery = mysql_query( 'SELECT @Success AS successMessage, @SeatsLeft AS seatsLeft' );


if($output = mysql_fetch_assoc($returnQuery ))
{
	$message = $output['successMessage'];
	$status = 1;
	$seatsLeft = $output['seatsLeft'];
}
else
{
	$status=0;
	$message='Database update failed please contact technical support.';
	$seatsLeft='N/A';
}



$json = json_encode(["status" => $status, "message" => $message]);
echo '<h2>'.$message.'</h2>';
echo 'There are '.$seatsLeft.' seats left for this destination';

?>

<?php include('footer.php'); ?>
</body></html>
