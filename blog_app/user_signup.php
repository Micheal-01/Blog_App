<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Signup</title>
</head>

<body>
<h1>Please Create Your Account</h1>
<form action="signup_process.php" method="POST">
<?php 

if(isset($_GET['message'])){
	
	echo $_GET['message'];
	}

?>
<p>Name: <input type="text" name="fullname"/></p>
<p>Email: <input type="text" name="email"/></p>
<p>Password: <input type="passsword" name="password" /></p>
<p>Confirm Password: <input type="password" name="confirm_password" /></p>
<input type="submit" name="submit" value="submit" />


</form>
</body>
</html>