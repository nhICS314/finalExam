<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>
<?php
if(!isset($_SESSION['id'])){
header("Location: http://nicolemh.ics321.com/finalExam/login_form.php");
exit();
}

$CustomerID=$_SESSION['id'];
$name=$_SESSION['name'];
?>

<html>
<head>
<title>View Tickets for: <?php echo $name; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
</head>
<body>
<?php include('menu.php'); ?>


	<h1>View Tickets for: <?php echo $name; ?>, Customer <?php echo $CustomerID; ?></h1>

	<?php



		$sqlSales="select SaleDate,AgentName,Amount,DestinationName,SeatCount, Confirmed from SALE  JOIN AGENT ON SALE.AgentKey = AGENT.AgentID JOIN DESTINATION ON SALE.DestinationKey = DESTINATION.DestinationID where SALE.CustomerKey = ".$CustomerID." ORDER BY CONFIRMED DESC;";

		$returnQuerySale = mysql_query($sqlSales, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

		if ($sales = mysql_fetch_assoc($returnQuerySale )) {
			echo '<table class="table  table-striped table-bordered table-condensed">';
			echo '<thead class="thead-inverse">';
			echo "<tr>";
			echo "<th>Destination</th>";
			echo "<th>Sale Date</th>";
			echo "<th>Agent</th>";
			echo "<th>Amount</th>";
			echo "<th>Seat Count</th>";
			echo "<th>Confirmation</th>";
			echo	"</tr>";
			echo "</thead>";

			echo	"<tr>";
			echo "<td>".$sales['DestinationName']."</td>";
			echo "<td>".$sales['SaleDate']."</td>";
			echo "<td>".$sales['AgentName']."</td>";
			echo "<td>".$sales['Amount']."</td>";
			echo "<td>".$sales['SeatCount']."</td>";
			echo "<td>".$sales['Confirmed']."</td>";
			echo	"</tr>";

			while ($sales = mysql_fetch_assoc($returnQuerySale )) {
				echo	"<tr>";
				echo "<td>".$sales['DestinationName']."</td>";
				echo "<td>".$sales['SaleDate']."</td>";
				echo "<td>".$sales['AgentName']."</td>";
				echo "<td>".$sales['Amount']."</td>";
				echo "<td>".$sales['SeatCount']."</td>";
				echo "<td>".$sales['Confirmed']."</td>";
				echo	"</tr>";
			}

			echo "</table>";
		} else {
			echo "<em>No sales to report</em><br/><br/>";
		}


	?>


<?php include('footer.php'); ?>
</body>
</html>