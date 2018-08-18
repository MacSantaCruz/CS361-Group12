<!DOCTYPE html>
<?php
		$currentpage="enterMood";
		include "pages.php";
		
?>
<html>
	<head>
		<title>Submit Sleep Data</title>
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
	  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Escape user inputs for security
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $mood = mysqli_real_escape_string($conn, $_POST['mood']);
	
      // attempt insert query 
			$query = "INSERT INTO settingData (username, moodcheck) VALUES ('$username', '$mood')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
		
    }
// close connection
mysqli_close($conn);
?>
<section>
    <h2> Settings </h2>

<form method="post" id="addForm">
<fieldset>
	<legend>Account Settings: </legend>
     <p>
        <label for="userName">User Name:</label>
        <input type="text" class="required" name="username" id="username" >
    </p>
    <p>
        <label for="mood">Mood Check Per Day:</label>
        <input type="number" min=1 max = 16 class="required" name="mood" id="mood" >
    </p>
    

    
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
<?php include("footer.php"); ?>
</body>
</html>