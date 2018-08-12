<!DOCTYPE html>
<?php
		$currentpage="enterData";
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
    $msg = "Enter Today's Data";
    include 'connectvars.php'; 
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	  
    if (!$conn) {
		  die('Could not connect: ' . mysql_error());
	  }
	  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Escape user inputs for security
		  $mood = mysqli_real_escape_string($conn, $_POST['mood']);
		  $sleep = mysqli_real_escape_string($conn, $_POST['sleep']);
		  $date = mysqli_real_escape_string($conn, $_POST['date']);
	
      // See if pid is already in the table
    $queryIn = "SELECT * FROM userData where date='$date' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already an entry for date, $date<p>";
		} else {
		
		// attempt insert query 
			$query = "INSERT INTO userData (mood, sleep, date) VALUES ('$mood', '$sleep', '$date')";
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
        <label for="sID">Sleep Count:</label>
        <input type="number" min=1 max = 24 class="required" name="sleep" id="sleep" >
    </p>
    <p>
        <label for="Name">Mood(1-5):</label>
        <input type="number" min=1 max = 5 class="required" name="mood" id="mood" >
    </p>

    <p>
        <label for="Color">Date:</label>
        <input type="number" min=1 max = 555 class="required" name="date" id="date">
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>