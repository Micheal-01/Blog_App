<?php
define("DBNAME","blog_app");
define("DBUSER","root");
define("DBPASS","");

try{
	
	
$conn = new PDO("mysql:host=localhost;dbname=".DBNAME,DBUSER,DBPASS);

$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo $e->getMessage(); 
		
		}



if(isset($_POST['submit'])){
	
	$error = array();
	
	if(empty($_POST['fullname'])){
		
		$error[] = "Please Enter Fullname";
		}else{
			$fullname = $_POST['fullname'];
			}
			
	if(empty($_POST['email'])){
		$error[] = "Please Enter Email";
		}else{
			$email = $_POST['email'];
			}
	if(empty($_POST['password'])){
		$error[] = "Please Enter Password";
		
		}else{
			$password = $_POST['password'];
			}
	if(empty($_POST['confirm_password'])){
		$empty[] = "Please Confirm Password";
		}elseif($_POST['confirm_password']!==$_POST['password']){
			$error[] = "Password Mismatch";
			}else{
				$confirm_password = $_POST['confirm_password'];
				}
			
	if(empty($error)){

	$encrypted = password_hash($password,PASSWORD_BCRYPT);
		
		
	$statement = $conn->prepare("INSERT INTO users VALUES(NULL,:nm,:em,:ps,NOW(),NOW() )");
	$statement->bindParam(":nm",$fullname);
	$statement->bindParam(":em",$email);
	$statement->bindParam(":ps",$encrypted);
	
	$statement->execute();
		
	header("Location:user_signup.php?message=Dear $fullname, You have successfully registered and a confirmation mail would be sent to $email");
		
		
		}else{
		foreach($error as $key => $value) {
			echo $value. "<br>";
			}
			}
	}