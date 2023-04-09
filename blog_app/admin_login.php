<?php
session_start();
include "db.php";

if(isset($_POST['submit'])){
	$error = array();
	if(empty($_POST['email'])){
		$error['email'] = "Enter Email";
		}
	if(empty($_POST['hash'])){
		$error['hash'] = "Enter Password";
		}
	if(empty($error)){
		$stmt = $conn->prepare("SELECT * FROM admin WHERE email=:em");
		$stmt->bindParam(":em",$_POST['email']);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);
		
		if($stmt->rowCount() > 0 && password_verify($_POST['hash'],$row['hash'])){
			$_SESSION['admin_id'] = $row['admin_id'];
			$_SESSION['admin_name'] = $row['admin_username'];
			header("location:admin_home.php");
			exit();
			}else{
				header("location:admin_login.php?error=Either Email or Password Incorrect");
				}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<?php
if(isset($_GET['message'])){
	echo $_GET['message'];
	}
if(isset($_GET['error'])){
	echo $_GET['error'];
	}
?>

<form action="" method="post">

<?php
if(isset($error['email'])){
echo "<p style='color:red' >".$error['email']."</p>";	
	}
?>
<input type="email" name="email" placeholder="Email"/><br/>
<?php
if(isset($error['hash'])){
	echo "<p style='color:red'>".$error['hash']."</p>";
	}
?>
<input type="password" name="hash" placeholder="Password"/><br/>
<input type="submit" name="submit" value="submit"/>
</form>
</body>
</html>