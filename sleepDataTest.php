<?php
require "initTest.php";
 //edit later for android script
$username = "Kevin";
$date = date("Y-m-d h:i:sa");
$sleep_hours = "5";
$sleep_quality = "3";


$sql_query = "insert into sleep_data values('$username', '$date', '$sleep_hours', '$sleep_quality');";

if(mysqli_query($conn, $sql_query))
{
	echo"<h3> Data saved</h3>";
}

else
{
	echo "error.. " .mysqli_error($conn);
}
?>