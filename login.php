<?php
	session_start();
	require_once 'conn.php';
	
	if(ISSET($_POST['login'])){
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
        //$username= htmlspecialchars($username);
		//$username = mysqli_real_escape_string($conn,$username);//escapes special characters in a string Mysql
		//$username = sqlite_escape_string($username);//is deprecated in php 5.4
		//$password=sqlite_escape_string($password);

		//echo $username;
		//echo $password;
		//die();

	    //only comment bellow 2 lines to fix and decomment fixed area
        $query="SELECT * FROM member where username='".$username."' and password='".$password."'" ;
		$statement = $conn->query($query) ;

		//fixed area prepared statment for sqlI and XSS
		// $query="SELECT * FROM member where username=:username and password= :password" ;
		// $statement = $conn->prepare($query);
		// $statement->bindParam(':username', $username);
		// $statement->bindParam(':password', $password);
		// $statement->execute();

		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row){
					
				$row = (object) $row;
				$my_id=$row->mem_id;
				
			}
		
             $_SESSION['username']=$username;
			 $_SESSION['user_id']=$my_id;
			 header("location:profile.php?user_id=".$my_id);

	}

?>
<!DOCTYPE html>

<html lang="en">
	<head>
	
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
<nav class="navbar navbar-default">
		 <div class="container-fluid">
			<a class="navbar-brand" href="">Hsoub Acadimy</a>
		</div> 
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary"> Login To Weather App</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<a href="index.php">Not a member yet? Register here...</a>
		<br style="clear:both;"/><br />
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="POST" action="login.php">	
				<div class="alert alert-info">Login</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required="required"/>
				</div>
				<?php
					if(ISSET($_SESSION['error'])){
				?>
					<div class="alert alert-danger"><?php echo $_SESSION['error']?></div>
				<?php
					session_unset($_SESSION['error']);
					}
				?>
				<button class="btn btn-primary btn-block" name="login"><span class="glyphicon glyphicon-log-in"></span> Login</button>
			</form>	
		</div>
	</div>
</body>
</html>