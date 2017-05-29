<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>

<html>
<head>
<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
<script>
function register(){

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
			if(stat==1) window.location = "login_form.php";
		};
	};
	document.getElementById('id_returnObject').innerHTML = '' ;
	document.getElementById('id_queryString').innerHTML = '' ;
	var reg_name = document.getElementById('id_RegName').value;
	var reg_email = document.getElementById('id_RegEmail').value;
	var reg_pw = document.getElementById('id_RegPassword').value;
	var reg_pw2 = document.getElementById('id_RegPassword2').value;
	var error_msg = '';

	if(!(reg_pw.length>=5 && reg_pw == reg_pw2)) error_msg += "Passwords don't match.\n";
	if(!(reg_name.length>=5)) error_msg += "Name not long enough.\n";
	if(!(reg_email.indexOf('@')>0 && reg_email.lastIndexOf('.')>0 && reg_email.indexOf('@'))) error_msg += "Email not valid.\n";
	if(error_msg != '') { alert(error_msg); } else
	{
		var query = "register_api.php?name="+reg_name+"&email="+reg_email+"&pw="+reg_pw;
		document.getElementById('id_queryString').innerHTML = query ;
		if(confirm("Are you sure you want to register?"))
		{
			document.getElementById('id_message').innerHTML = "Please wait processing request" ;
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

	<h1>Please Register</h1>
	<div class="form-group row">
		<label for="id_RegEmail" class="col-xs-2 form-control-label">Name: </label>
		<div class="col-xs-4">
			<input type="email" id="id_RegName" placeholder="Full name" class="form-control" >
		</div>
	</div>

	<div class="form-group row">
		<label for="id_RegEmail" class="col-xs-2 form-control-label">Email: </label>
		<div class="col-xs-4">
			<input type="email" id="id_RegEmail" placeholder="email@example.com" class="form-control" >
		</div>
	</div>

	<div class="form-group row">
		<label for="id_RegPassword" class="col-xs-2 form-control-label">Password: </label>
		<div class="col-xs-4">
			<input type="password" id="id_RegPassword" class="form-control" >
		</div>
	</div>

	<div class="form-group row">
		<label for="id_RegPassword2" class="col-xs-2 form-control-label">Confirm: </label>
		<div class="col-xs-4">
			<input type="password" id="id_RegPassword2" class="form-control" >
		</div>
	</div>

	<div class="form-group row">
		<div class="col-xs-offset-2 col-xs-4">
			<input type="button" value="Register Me" onclick="register()" class="btn btn-primary"></input>
		</div>
	</div>
</form>


<?php include_once('footer.php'); ?>

</body>
</html>