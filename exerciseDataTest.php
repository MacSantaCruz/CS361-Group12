<?php
require "initTest.php";
 //edit later for android script
$username = "Kevin";
$date = date("Y-m-d h:i:sa");
$exercise_type = "run";
$exercise_minutes = "30";


$sql_query = "insert into exercise_data values('$username', '$date', '$exercise_type', '$exercise_minutes');";

if(mysqli_query($conn, $sql_query))
{
	echo"<h3> Data saved</h3>";
}

else
{
	echo "error.. " .mysqli_error($conn);
}
?>