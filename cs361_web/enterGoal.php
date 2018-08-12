<!DOCTYPE html>
<?php
		$currentpage="enterGoal";
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

      
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $goal = mysqli_real_escape_string($conn, $_POST['goal']);
		
		// attempt insert query 
			$query = "INSERT INTO goalData (username, goal) VALUES ('$username', '$goal')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} 
      else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
		
    }

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
        <label for="goal">Goal:</label>
        <input type="text"  class="required" name="goal" id="goal" >
    </p>
    

    
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>