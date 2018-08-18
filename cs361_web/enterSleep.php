<!DOCTYPE html>
<?php
		$currentpage="enterSleep";
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
    $msg = "Enter Today's Data";
    include 'connectvars.php'; 
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	  
    if (!$conn) {
		  die('Could not connect: ' . mysql_error());
	  }
	  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Escape user inputs for security
      $username = mysqli_real_escape_string($conn, $_POST['username']);
		  $sleepHours = mysqli_real_escape_string($conn, $_POST['sleepHours']);
      $sleepQuality = mysqli_real_escape_string($conn, $_POST['sleepQuality']);
		  $date = mysqli_real_escape_string($conn, $_POST['date']);
	
    $queryIn = "SELECT * FROM sleepData where username = '$username' AND date='$date' ";
		$resultIn = mysqli_query($conn, $queryIn);
    if(mysqli_num_rows($resultIn)> 0){
      $msg ="<h2>Can't Add to Table</h2> There is already an entry for sleep on $date<p>";
    }
    else {
		
		// attempt insert query 
			$query = "INSERT INTO sleepData (username, date, sleepHours, sleepQuality) VALUES ('$username', '$date', '$sleepHours', '$sleepQuality')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
		}
    }
// close connection
mysqli_close($conn);
?>
<section>
    <h2> <?php echo $msg; ?> </h2>

<form method="post" id="addForm">
<fieldset>
	<legend>Personal Data: </legend>
     <p>
        <label for="username">User Name:</label>
        <input type="text" class="required" name="username" id="username" >
    </p>
    <p>
        <label for="date">Date:</label>
        <input type="date" class="required" name="date" id="date">
    </p>
    
    <p>
        <label for="sleepHours">Sleep Count:</label>
        <input type="number" min=1 max = 24 class="required" name="sleepHours" id="sleepHours" >
    </p>
    <p>
        <label for="sleepQuality">Sleep Quality:</label>
        <input type="number" min=1 max = 24 class="required" name="sleepQuality" id="sleepQuality" >
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