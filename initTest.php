<?php
$servername = "classmysql.engr.oregonstate.edu";
$username = "cs361_gwinnk";
$password = "6168";
$db_name = "cs361_gwinnk";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if (!$conn)
{
	echo "erro0r";
}
echo "Connected successfully";
?>