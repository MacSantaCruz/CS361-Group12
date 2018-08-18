<!DOCTYPE html>
<?php
		$currentpage="graphMood";
		include "pages.php";
		
?>
<html>
<head>
		<title>Graph Mood</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 

<?php
    include "header.php";
    include 'connectvars.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
    }	

// query to select all information from supplier table
	$query = "SELECT date, mood FROM moodData ";

// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to retrieve graph data from table failed");
	}
    
// create array data
    $dataPoints = array();

	while($row = mysqli_fetch_row($result)) {	
        $data_sub = substr($row[0], 0, -9);
        array_push($dataPoints, array ("y" => $row[1], "label" => $data_sub) );
    }

	mysqli_free_result($result);
    mysqli_close($conn); 
    
?>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Mood Over Time"
	},
	axisY: {
		title: "Mood Rating"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>

<body>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>