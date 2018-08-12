<!DOCTYPE html>
<?php
		$currentpage="deleteExercise";
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

    $username = $_GET["user"];
    $date = $_GET["date"];

    // attempt delete query 
    $query = "DELETE FROM exerciseData
              WHERE username = '$username' AND date = '$date'";

		if(mysqli_query($conn, $query)){
			$msg =  "Entry successfully deleted.<p>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}


    mysqli_close($conn); 
    
?>
</body>
</html>