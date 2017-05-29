<?php session_start();
session_unset();
session_destroy(); 
?>
<html>
<head>
<title>Login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
	<script>
function login(){

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
			if(stat==1) window.location = "mainPage.php";
		};
	};
	document.getElementById('id_returnObject').innerHTML = '' ;
	document.getElementById('id_queryString').innerHTML = '' ;
	var reg_email = document.getElementById('id_RegEmail').value;
	var reg_pw = document.getElementById('id_RegPassword').value;
	var error_msg = '';

	if(!(reg_email.indexOf('@')>0 && reg_email.lastIndexOf('.')>0 && reg_email.indexOf('@'))) error_msg += "Email not valid.\n";
	if(error_msg != '') { alert(error_msg); } else
	{
		document.getElementById('id_message').innerHTML = "Please wait processing request" ;
		var query = "login_api.php?email="+reg_email+"&pw="+reg_pw;
		document.getElementById('id_queryString').innerHTML = query ;
		ajaxRequest.open("GET", query, true);
		ajaxRequest.send(null); 
	}
};
</script>
</head>
<body>

<?php include('menu.php'); ?>

<form style="margin-left:20px;">

	<h1>Please Log In to Campus Travel</h1>
	<p>If you just registered, your login information is needed again.
		If you have not registered, please <a  class="btn btn-secondary" href="register_form.php">Register now</a></p>
	<hr/>
	<div class="form-group row">
		<label for="id_RegEmail" class="col-xs-2 form-control-label">Email </label>
		<div class="col-xs-4">
		<input type="email" id="id_RegEmail" autocomplete="off" placeholder="Enter email" class="form-control" >
		</div>
		</div>


	<div class="form-group row">
		<label for="id_RegPassword" class="col-xs-2 form-control-label">Password</label>
		<div class="col-xs-4">
		<input type="password" id="id_RegPassword" autocomplete="off"  class="form-control" >
		</div>
	</div>
	<div class="form-group row">
		<div class="col-xs-offset-2 col-xs-4">
		<input type="button" value="Log In" onclick="login()" class="btn btn-primary"></input>
		</div>
		</div>
	</form>

	


<?php include_once('footer.php'); ?>

</body>
</html>