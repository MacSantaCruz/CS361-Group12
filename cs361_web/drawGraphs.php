<!DOCTYPE html>
<?php
		$currentpage="drawGraphs";
		include "pages.php";
		
?>
<html>
	<head>
		<title>Pick a Graph</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>

<body>

<?php
include "header.php";
include 'connectvars.php';

?>

<h2>
   <div> <a href="graphSleep.php">View Sleep Graph</a> </div>
    <div> <a href="graphMood.php">View Mood Graph</a> </div>
    <div> <a href="graphExercise.php">View Exercise Graph</a> </div>
</h2>

</body>
</html>