<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php


if(!isset($_SESSION['id'])){
header("Location: http://nicolemh.ics321.com/finalExam/login_form.php");
exit();
}

$CustomerID=$_SESSION['id'];
$CustomerName=$_SESSION['name'];

$email = $_SESSION['email'];
$pw = $_SESSION['pw'];


$message='';
$status='';

$sql="SELECT * FROM CUSTOMER WHERE CustomerEmail='$email' AND CustomerPW='$pw'";
$returnQuery = mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

if($registration = mysql_fetch_assoc($returnQuery ))
{
	$name=$registration['CustomerName'];
	}
?>
<html>
<head>
<title>Buy Seats</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
	<script>
function sendConfirmEmail(){
	var ajaxRequest;
	try{ajaxRequest = new XMLHttpRequest();} catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} catch (e){alert("Your browser does not support ajax."); return false;}}};
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var returnObject = ajaxRequest.responseText;
			document.getElementById('id_returnObject').innerHTML = returnObject ;
			var json_object = JSON.parse(returnObject.trim());
			var msg = json_object.message;
			document.getElementById('id_message').innerHTML = msg ;
			var stat = json_object.status;

		};
	};
	document.getElementById('id_returnObject').innerHTML = '' ;
	document.getElementById('id_queryString').innerHTML = '' ;
	var destination = document.getElementById('id_Destination').value;
	var agent = document.getElementById('id_Agent').value;
	var date = document.getElementById('id_date').value;
	var customerKey= <?php echo $CustomerID; ?>;
	var seatCount = document.getElementById('id_SeatCount').value;

	document.getElementById('id_message').innerHTML = "Please wait processing request. (May take 10-15 seconds)." ;
	var error_msg = '';
        var query = "buy_seat_api.php?destination="+destination+"&agent="+agent+"&date="+date+"&customerKey="+customerKey+"&seatCount="+seatCount;
	document.getElementById('id_queryString').innerHTML = query ;
        ajaxRequest.open("GET", query, true);
	ajaxRequest.send(null); 
};
</script>
</head>
<body>
<?php include('menu.php'); ?>


<form style="margin-left:20px;">

	<h1>Travel Booking Form</h1>

	<div class="form-group row">
		<label for="id_Name" class="col-xs-2 form-control-label">Customer Name: </label>
		<div class="col-xs-4">
			<label id="id_name"  class="form-control-label" > <?php echo $CustomerName; ?></label>
		</div>
	</div>

	<div class="form-group row">
		<label for="id_Destination" class="col-xs-2 form-control-label">Destination </label>
		<div class="col-xs-4">
			<?php

			$query = mysql_query("SELECT DestinationName, DestinationID FROM DESTINATION ORDER BY DestinationName");

			echo '<select name="Destinations" id= "id_Destination" class="c-select form-control">';

			while ($row = mysql_fetch_array($query)) {
				echo '<option value="'.$row['DestinationID'].'">'.$row['DestinationName'].'</option>';
			}

			echo '</select>';
			?>
		</div>
	</div>

	<div class="form-group row">
	<label for="id_Agent" class="col-xs-2 form-control-label">Agent </label>
		<div class="col-xs-4">
			<?php

			$query = mysql_query("SELECT AgentName, AgentID FROM AGENT ORDER BY AgentName");

			echo '<select name="Agents" id="id_Agent" class="c-select form-control">';

			while ($row = mysql_fetch_array($query)) {
				echo '<option value="'.$row['AgentID'].'">'.$row['AgentName'].'</option>';
			}

			echo '</select>';
			?>
		</div>
	</div>

	<div class="form-group row">
		<label for="id_date" class="col-xs-2 form-control-label">Order Date: </label>
		<div class="col-xs-4">
			<input type="date" id="id_date" value ="<?php echo date('Y-m-d'); ?>" class="form-control">
		</div>
	</div>

	<div class="form-group row">
		<label for="id_SeatCount" class="col-xs-2 form-control-label">Number of Seats </label>
		<div class="col-xs-4">
			<input type="text" id="id_SeatCount" class="form-control" >
		</div>
	</div>

	<div class="form-group row">
		<div class="col-xs-offset-2 col-xs-4">
			<input type="hidden" id="CustomerID" value = "<?php echo $CustomerID; ?>">
			<input type="button" value="Send Confirmation Email" onclick="sendConfirmEmail()" class="btn btn-primary"></input>
		</div>
	</div>
</form>




<?php include_once('footer.php'); ?>

</body>
</html>