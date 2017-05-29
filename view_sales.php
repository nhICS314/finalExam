<?php  session_start(); ?>
<?php include_once('dbConnection.php'); ?>

<html>
<head>
<title>View Sales</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
</head>
<body>
<?php include('menu.php'); ?>

<h1>Sales Summary Grouped By Destination</h1>

<?php

$sql="select DestinationID, DestinationName  from DESTINATION order by DestinationName;";
$returnQuery = mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');


$sqlSummary="SELECT DestinationID, DestinationName, COUNT(Amount) as SalesCount, SUM(Amount) as TotalSales, SUM(SeatCount) as SeatsSold from DESTINATION JOIN SALE ON SALE.DestinationKey = DESTINATION.DestinationID GROUP BY DestinationID, DestinationName ORDER BY DestinationName;";

	$summaryResults = mysql_query($sqlSummary, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');


		echo '<table class="table table-striped table-bordered table-condensed">';
		echo '<thead class="thead-inverse">';
		echo "<tr>";
		echo "<th >ID</th>";
		echo "<th >Name</th>";
		echo "<th >Sales Count</th>";
		echo "<th >Total Sales</th>";
		echo "<th >Total Seats</th>";
		echo	"</tr>";
		echo "</thead>";
		echo "<tbody>";



		while ($summary = mysql_fetch_assoc($summaryResults )) {
			echo	"<tr>";
			echo "<td>".$summary['DestinationID']."</td>";
			echo "<td>".$summary['DestinationName']."</td>";
			echo "<td>".$summary['SalesCount']."</td>";
			echo "<td>".$summary['TotalSales']."</td>";
			echo "<td>".$summary['SeatsSold']."</td>";
			echo	"</tr>";
		}

		echo "</tbody>";

		echo "</table>";



?>

	<h1>Sales By Destination</h1>

	<?php

	$sql="select DestinationID, DestinationName  from DESTINATION order by DestinationName;";
	$returnQuery = mysql_query($sql, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

	while($destinations = mysql_fetch_assoc($returnQuery ))
	{
		echo '<h2>' . $destinations['DestinationName']. '</h2>';

		$destinationID = $destinations['DestinationID'];

		$sqlSales="select SaleDate,AgentName,Amount,CustomerName,SeatCount from SALE  JOIN AGENT ON SALE.AgentKey = AGENT.AgentID JOIN CUSTOMER ON SALE.CustomerKey = CUSTOMER.CustomerID where DestinationKey = ".$destinationID.";";


		$returnQuerySale = mysql_query($sqlSales, $conn) or die("Couldn't perform query $sql (".__LINE__."): " . mysql_error() . '.');

		if($sales = mysql_fetch_assoc($returnQuerySale )){
			echo '<table class="table  table-striped table-bordered table-condensed">';
			echo '<thead class="thead-inverse" style="background-color:#dd4814; color:white;">';
			echo "<tr>";
			echo "<th >Sale Date</th>";
			echo "<th >Agent</th>";
			echo "<th >Amount</th>";
			echo "<th >Customer</th>";
			echo "<th >Seat Count</th>";
			echo	"</tr>";
			echo "</thead>";

			echo	"<tr>";
			echo "<td>".$sales['SaleDate']."</td>";
			echo "<td>".$sales['AgentName']."</td>";
			echo "<td>".$sales['Amount']."</td>";
			echo "<td>".$sales['CustomerName']."</td>";
			echo "<td>".$sales['SeatCount']."</td>";
			echo	"</tr>";

			while ($sales = mysql_fetch_assoc($returnQuerySale )) {
				echo	"<tr>";
				echo "<td>".$sales['SaleDate']."</td>";
				echo "<td>".$sales['AgentName']."</td>";
				echo "<td>".$sales['Amount']."</td>";
				echo "<td>".$sales['CustomerName']."</td>";
				echo "<td>".$sales['SeatCount']."</td>";
				echo	"</tr>";
			}

			echo "</table>";
		} else {
			echo "<em>No sales to report</em><br/><br/>";
		}

	}
	?>


<?php include('footer.php'); ?>
</body>
</html>