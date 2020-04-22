<?php
$username = $_POST['username'];
$password = $_POST['password'];
$invite_code = $_POST['invite_code'];

if (!empty($username) || !empty($password) || !empty($invite_code)) {
	$host = "localhost";
	$dbUsername = "id13380637_helldatabase";
	$dbPassword = "hellcrackerdb1445Cslaoz(";
	$dbname = "id13380637_helldb";

	// Connection
	$conn = new mysqli($host , $dbUsername, $dbPassword, $dbname);

	if (mysqli_connect_error()) {
		die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
	} else {
		$SELECT = "SELECT username from register where username = ? limit 1";
		$INSERT = "INSERT into register (username, password) values(?,?)";

		// Preparing Statement
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($username);
		$stmt->store_result();
		$rnum = $stmt->num_rows;

		if ($rnum==0) {
			$stmt->close();
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("ss", $username, $password);
			$stmt->execute();
			echo "Registered Sucessfully";	
		} else {
			echo "someone already registered with this username...";
		}
		$stmt->close();
		$conn->close();
	}
} else {
	echo "All fields are required";
	die();
}
?>