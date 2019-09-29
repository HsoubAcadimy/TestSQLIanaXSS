<?php
	session_start();
	require_once 'conn.php';
	
	if(ISSET($_POST['register'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		


		$query = "INSERT into `member` (username, password, firstname, lastname) VALUES ('$username', '".$password."', '$firstname', '$lastname')";
		$stmt = $conn->prepare($query);
		// $stmt->bindParam(':username', $username);
		// $stmt->bindParam(':password', $password);
		// $stmt->bindParam(':firstname', $firstname);
		// $stmt->bindParam(':lastname', $lastname);
		
		if($stmt->execute()){
			$_SESSION['success'] = "Successfully created an account";
			header('location: index.php');
		}

	}
?>