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

    echo "<h3>Editing entry with username = ".$_GET["user"]. ", date = " . $_GET["date"] . ", and mood = " . $_GET["mood"] . "</h3>";

    $username = $_GET["user"];
    $date = $_GET["date"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $mood = mysqli_real_escape_string($conn, $_POST['mood']);

    // attempt insert query 
    $query = "UPDATE moodData
              SET mood = '$mood'
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
        <label for="mood">Mood(1-5):</label>
        <input type="number" min=1 max = 5 required name="mood" id="mood" >
    </p>
    


</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>