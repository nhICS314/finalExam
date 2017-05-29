<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php
$email = $_SESSION['email'];
$pw = $_SESSION['pw'];


$message='';
$status='';

$sql="SELECT * FROM CUSTOMER WHERE CustomerEmail='$email' AND CustomerPW='$pw'";
$returnQuery = mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

if($registration = mysql_fetch_assoc($returnQuery ))
{
	$name=$registration['CustomerName'];
?>
<html>
<head>
<title><?php echo $name; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
</head>
<body>
<?php include('menu.php'); ?>

<h1>Hello <?php echo $name; ?>!<BR></h1>
<p>Welcome to Campus Travel</p>

<h2><a class="btn btn-primary btn-lg" href="buy_seat_form.php">Click here to purchase a seat</a></h2>

<br><br>


<?php
	$logLink='Logout';
}
else
{
?>
<html>
<head>
<title>Not Logged In</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
</head>
<body>
<?php include('menu.php'); ?>

<h1>Welcome to Campus Travel!</h1>
<br><br>
<p>To purchase a seat please <a class="btn btn-secondary" href="register_form.php">register</a> or <a class="btn btn-primary" href="login_form.php">log in</a>.</p>
<?php

}

?>

<?php include_once('footer.php'); ?>

</body>
</html>