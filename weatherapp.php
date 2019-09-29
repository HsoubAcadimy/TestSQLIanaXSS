
<?php
  include("auth.php");

 require_once 'conn.php';

 if(ISSET($_POST['comments'])){
    $username = $_SESSION['username'];
    $comment_text = $_POST['comment'];
    //$comment_text = trim($_POST['comment']);
    //trim() for user login "  entesar " == "entesar"
    //equal to mysqli_real_escape_string() in mySQL fixed SQLI
    //htmlspecialchars() || strip_tags() fixed xss convert < to &lt; and so on.. 2ed remove the tag
    //strip_tags(mysql_real_escape_string(trim($variable))); mixed

    //prepared statment fixed xss and SQLI
    // $query="INSERT into `comment` (username, comment_text) VALUES (':username', ':comment_text')" ;
    // $statement = $conn->prepare($query);
    // $statement->bindParam(':username', $username);
    // $statement->bindParam(':comment_text', $comment_text);
    // $statement->execute();

        $query = "INSERT into `comment` (username, comment_text) VALUES ('$username', '$comment_text')";
        $stmt = $conn->prepare($query);

        if($stmt->execute()){
			$_SESSION['success'] = "Successfully created an account";
			header('location: weatherapp.php');
        }
        else
        echo "error";


 }
 
?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Weather App</title>    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/weather.js"></script>
</head>
<body dir="rtl">
<nav class="navbar navbar-default">
<div style="float:left">
			<a class="navbar-brand" >Hsoub Acadimy </a>
		</div> 
		 <div class="container-fluid"  style="float:right">
			<a class="navbar-brand" >Weather App</a>
		</div>
        
	</nav>
 <div class="container" style="height:650px;">
    <div class="row" >
        <div class="col-md-12" style="margin-bottom:10px;">
            <h3 class="text-center text-primary">أدخل اسم المدينة</h3>
            <span id="error" class="text-center"></span>
        </div>
        
        <div class="row form-group form-inline" id="cityDiv">
           
            <input type="text" name="city" id="city" class="form-control" placeholder="Enter city name" >
            <button id="submitCity" class="btn btn-primary">Search City</button>
        </div>

    </div>  
    <div style="margin-bottom:5%" id="showWeather"></div>
    <hr>
    <div style="text-align:right " class="row form-group form-inline">
    <form method="POST" action="weatherapp.php">
    <h4  class=" text-primary">أراء مستخدمي التطبيق</h4>
    <h5><?php echo $_SESSION["username"]; ?></h5>

    <textarea type="text" name="comment" id="comment" class="form-control" placeholder="Enter your comment" ></textarea>
    <button style="text-align:left " id="comments" name="comments" class="btn btn-primary">submit</button>
    </form>
    </div>
    <div style="text-align:right " class="row form-group form-inline">
<?php

$query="SELECT * from comment " ;
$result = $conn->query($query) ;
while($row=$result->fetch(PDO::FETCH_ASSOC)){
 $row = (object) $row;
 
 echo "<h5><strong>$row->username<strong></h5>";
 echo "<h6>$row->comment_text</h6>";
 
 }
?>
</div>   
</body>
</html>
