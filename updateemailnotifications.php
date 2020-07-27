<?php
//process.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
	$servername = "localhost";
	$username = "cen4010s2020_g08";
	$password = "faueng2020";
	$dbname = "cen4010s2020_g08";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
  	die("Connection failed: " . $conn->connect_error);
	}

        $email = $_POST["user_email"];

	$sql = "UPDATE accounts SET notify=1 WHERE email='$email'";

	if ($conn->query($sql) === TRUE) {
	  header("Location: emailnotifications.php?message=You have successfully subscribed to email notifications!");
	} else {
  	  echo "Error updating record: " . $conn->error;
	}

}
?>