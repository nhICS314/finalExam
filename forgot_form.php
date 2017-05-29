<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php
session_unset();
session_destroy(); 
?>
<html>
<head>
<title>Forgot</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">

<script>
function forgot(){
	var ajaxRequest;
	try{ajaxRequest = new XMLHttpRequest();} catch (e){try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");} catch (e){alert("Your browser does not support ajax."); return false;}}};
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var returnObject = ajaxRequest.responseText;
			document.getElementById('id_returnObject').innerHTML = returnObject ;
			var json_object = JSON.parse(returnObject.trim());
		};
	};
	document.getElementById('id_returnObject').innerHTML = '' ;
	document.getElementById('id_queryString').innerHTML = '' ;
	var reg_email = document.getElementById('id_RegEmail').value;
	var error_msg = '';

	if(!(reg_email.indexOf('@')>0 && reg_email.lastIndexOf('.')>reg_email.indexOf('@'))) error_msg += "Email not valid.\n";
	if(error_msg != '') { alert(error_msg); } else
	{
		var query = "forgot_api.php?email="+reg_email;
		document.getElementById('id_queryString').innerHTML = query ;
		if(confirm("Are you sure you want to send an email to "+reg_email+"?"))
		{
			ajaxRequest.open("GET", query, true);
			ajaxRequest.send(null); 
		}
	}
};
</script>
</head>
<body>
<?php include('menu.php'); ?>

<form style="margin-left:20px;">

	<h1>Email me my password.</h1>
	<div class="form-group row">
		<label for="id_RegEmail" class="col-xs-2 form-control-label">Email </label>
		<div class="col-xs-4">
			<input type="email" id="id_RegEmail" autocomplete="off" placeholder="Enter email" class="form-control" >
		</div>
	</div>
	<div class="form-group row">
		<div class="col-xs-offset-2 col-xs-4">
			<input type="button" value="Email My Password" onclick="forgot()" class="btn btn-primary"></input>
		</div>
	</div>
</form>



<?php include_once('footer.php'); ?>

</body>
</html>