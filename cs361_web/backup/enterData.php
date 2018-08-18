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
      $userName = mysqli_real_escape_string($conn, $_POST['userName']);
		  $mood = mysqli_real_escape_string($conn, $_POST['mood']);
		  $sleep = mysqli_real_escape_string($conn, $_POST['sleep']);
		  $date = mysqli_real_escape_string($conn, $_POST['date']);
	
      
    $queryIn = "SELECT * FROM exerciseData where username = '$username' AND date='$date' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already an entry for exercise on $date<p>";
		} 
//    $queryIn = "SELECT * FROM moodData where username = '$username' AND date='$date' ";
//		$resultIn = mysqli_query($conn, $queryIn);
//    elseif(mysqli_num_rows($resultIn)> 0){
//      $msg ="<h2>Can't Add to Table</h2> There is already an entry for mood on $date<p>";
//    }
//    $queryIn = "SELECT * FROM sleepData where username = '$username' AND date='$date' ";
//		$resultIn = mysqli_query($conn, $queryIn);
//    elseif(mysqli_num_rows($resultIn)> 0){
//      $msg ="<h2>Can't Add to Table</h2> There is already an entry for sleep on $date<p>";
//    }
    else {
		
		// attempt insert query 
//			$query = "INSERT INTO sleepData (username, date, sleepHours, sleepQuality) VALUES ('$username', '$date', '$sleepHours', '$sleepQuality')";
//      $query = "INSERT INTO moodData (username, date, mood) VALUES ('$username', '$date', '$mood')";
      $query = "INSERT INTO exerciseData (username, date, exerciseType, exerciseTime) VALUES ('$username', '$date', '$exerciseType', exerciseTime)";
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
        <label for="userName">User Name:</label>
        <input type="text" class="required" name="username" id="username" >
    </p>
    <p>
        <label for="date">Date:</label>
        <input type="date" class="required" name="date" id="date">
    </p>
    <p>
        <label for="mood">Mood(1-5):</label>
        <input type="number" min=1 max = 5 class="required" name="mood" id="mood" >
    </p>
    
    <p>
        <label for="sleepHours">Sleep Count:</label>
        <input type="number" min=1 max = 24 class="required" name="sleepHours" id="sleepHours" >
    </p>
    <p>
        <label for="sleepQuality">Sleep Quality:</label>
        <input type="number" min=1 max = 24 class="required" name="sleepQuality" id="sleepQuality" >
    </p>
    <p>
        <label for="exerciseType">Exercise Type:</label>
        <input type="text" class="required" name="exerciseType" id="exerciseType" >
    </p>
    <p>
        <label for="exerciseTime">Exercise Time:</label>
        <input type="number" min=1 max = 24 class="required" name="exerciseTime" id="exerciseTime" >
    </p>
    

    
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>