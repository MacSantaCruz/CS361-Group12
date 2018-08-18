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


    <h2> Uh Oh...  there has been an error </h2>
    <p> Please help improve our application by submitting an error report</p>
    
<button onclick="dataSent()">Submit</button>
<button onclick="dataNotSent()">Do not submit</button>






<?php include("footer.php"); ?>


<script LANGUAGE='JavaScript'>
function dataSent() {
          window.alert('Succesfully submitted, thank you');
          window.location.href='enterData.php';
}

function dataNotSent() {
	      window.alert('System restarted');
          window.location.href='enterData.php';
}
       </script>



</body>
</html>