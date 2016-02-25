<?php
include "dbVars.php";//inloggegevens
$resultArray = array();// array voor de query output


$search = $_GET['q']; //let op niet beschermd tegen SQL injectie!!!
$type = $_GET['type']; //let op niet beschermd tegen SQL injectie!!!

$con = mysqli_connect($servername,$uid,$pwd,$database);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
	exit();
}
mysqli_select_db($con,"world");
//dubbele wildcard
//$sql = "SELECT * FROM country WHERE name LIKE '%$search%' LIMIT 4";

//enkele wildcard
$sql = "SELECT * FROM Country WHERE name LIKE '$search%' ";
if ($type == "list"){
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)) {
		array_push($resultArray, $row['Name']);
	}
	echo json_encode($resultArray);
}
if ($type == "answer"){
	$result = mysqli_query($con,$sql);
	echo "<table border = '1'>";
	echo "<tr><td>Country</td><td>Continent</td><td>Region</td><td>Surface Area</td><td>Year independent</td><td>Population</td><td>Capital</td><td>Head of state</td></tr>";
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo "<tr>";
			echo "<td>" . $row["Name"] . "</td>";
			echo "<td>" . $row["Continent"] . "</td>";
			echo "<td>" . $row["Region"] . "</td>";
			echo "<td>" . $row["SurfaceArea"] . "</td>";
			echo "<td>" . $row["IndepYear"] . "</td>";
			echo "<td>" . $row["Population"] . "</td>";
			echo "<td>" . $row["Capital"] . "</td>";
			echo "<td>" . $row["HeadOfState"] . "</td>";
		echo "</tr>";
		}
	echo "</table>";
}
mysqli_close($con);
?>

 