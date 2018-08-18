<!DOCTYPE html>
<?php
		$currentpage="editMood";
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

    echo "<h3>Editing entry with username = ".$_GET["user"]. ", date = " . $_GET["date"] . ", exercise type = " . 
         $_GET["type"] . ", and exercise time = " . $_GET["time"] . "</h3>";

    $username = $_GET["user"];
    $date = $_GET["date"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    // get update data
        $exerciseType = mysqli_real_escape_string($conn, $_POST['exerciseType']);
        $exerciseTime = mysqli_real_escape_string($conn, $_POST['exerciseTime']);

    // attempt update query 
    $query = "UPDATE exerciseData
              SET exerciseType = '$exerciseType', exerciseTime = '$exerciseTime'
              WHERE username = '$username' AND date = '$date'";

		if(mysqli_query($conn, $query)){
			$msg =  "Entry edited successfully.<p>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
    }

    mysqli_close($conn); 
    
?>

<form method="post" id="addForm">
<fieldset>
	<legend>Personal Data: </legend>
    <p>
        <label for="exerciseType">Exercise Type:</label>
        <input type="text" required name="exerciseType" id="exerciseType" >
    </p>
    <p>
        <label for="exerciseTime">Exercise Time:</label>
        <input type="number" min=1 max = 24 required name="exerciseTime" id="exerciseTime" >
    </p>
    
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>