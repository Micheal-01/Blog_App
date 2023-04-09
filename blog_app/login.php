<?php
session_start();
define("DATABASE_NAME","blog_app");
define("DATABASE_USER","root");
define("DATABASE_PASSWORD","");

try {
	$conn = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME,DATABASE_USER,DATABASE_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
}catch(PDOException $e){
	echo $e->getmessage();
}


	if(isset($_POST['submit'])){
		
		$error = array();
		
		if(empty($_POST['email'])){
			$error[] = "Please enter email";	
		}else{
			$email = $_POST['email'];	
		}
		
		if(empty($_POST['password'])){
			$error[] = "Enter Password"	;
		}else{
			$password = $_POST['password'];	
		}
		
		if(empty($error)){
			
			$statement = $conn->prepare("SELECT * FROM users WHERE email=:em");
			$statement->bindParam(":em",$email);
			$statement->execute();
			
			$row = $statement->fetch(PDO::FETCH_BOTH);
		
			
			
			if($statement->rowCount() > 0  && password_verify($password,$row['password'] )){
			$_SESSION['id'] = $row['user_id'];
			$_SESSION['name'] = $row['name'];
			
			header("Location:home.php");
			}else{
				echo "Either Email or Password Incorrect";	
			}
			
			
			

			
			
			
			
				
		}else{
			foreach($error as $key=>$value)	{
				echo $value."<br>";
			}
		}
		
	
	
		
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>
</head>

<body>
<?php

if(isset($_GET['error'])){
echo $_GET['error'];
}
?>

<h1>Login Here</h1>

<form action="" method="post">
<input type="	text" name="email" placeholder="Email" />
<br />
<input type="password" name="password" placeholder="Password"/>
<br />
<input type="submit" name="submit" value="Login"  />
</form>



</body>
</html>