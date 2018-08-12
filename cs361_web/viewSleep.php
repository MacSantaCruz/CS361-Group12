<!DOCTYPE html>
<?php
		$currentpage="viewSleep";
		include "pages.php";
		
?>
<html>
	<head>
		<title>Submit Data</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>

<body>


<?php
    include "header.php";
    include 'connectvars.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

// query to select all information from supplier table
	$query = "SELECT * FROM sleepData ";

	
// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
// get number of columns in table	
	$fields_num = mysqli_num_fields($result);
	echo "<h1>sleepData Table</h1>";
	echo "<table id='t01' border='1'><tr>";
	
// printing table headers
	for($i=0; $i<$fields_num; $i++) {	
		$field = mysqli_fetch_field($result);	
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
			echo '<td> <a href="editSleep.php?user='.$row[0].'&date='.$row[1].'&hours='.$row[2].'&quality='.$row[3].'">EDIT </a> </td>';
			echo '<td> <a href="deleteSleep.php?user='.$row[0].'&date='.$row[1].'">DELETE </a> </td>';
		echo "</tr>\n";
	}

	mysqli_free_result($result);
	mysqli_close($conn); 
?>

</body>
</html>