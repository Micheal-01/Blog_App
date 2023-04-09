<?php
session_start();
include "authenticate.php";
include "db.php";

if(isset($_GET['id'])){
	$blog_id = $_GET['id'];
	}else{
		header("Location:manage_blog.php");
		}
		
		
$statement = $conn->prepare("SELECT * FROM category");
$statement->execute();
$select = array();
while($row = $statement->fetch(PDO::FETCH_BOTH)){
	$select[] = $row;
}






$stmt = $conn->prepare("SELECT * FROM blog WHERE blog_id=:bid");
$stmt->bindParam(":bid",$blog_id);
$stmt->execute();

$record = $stmt->fetch(PDO::FETCH_BOTH);

if($stmt->rowCount() < 1){
	header("location:manage_blog.php");
	exit();
	}
	

if(isset($_POST['submit'])){
	$error = array();
	
if(empty($_POST['title'])){
	$error['title'] = "Enter Title";
	}
if(empty($_POST['author'])){
	$error['author'] = "Enter Author";
	}
if(empty($_POST['category'])){
	$error['category'] ="Select Category";
	}
if(empty($_POST['body'])){
	$error['body'] = "Enter Text";
	}
if(empty($error)){
	$statement = $conn->prepare("UPDATE blog SET title=:tt,author=:au,category=:cat,body=:bd WHERE blog_id=:bid");
	$statement->bindParam(":tt",$_POST['title']);
	$statement->bindParam(":au",$_POST['author']);
	$statement->bindParam(":cat",$_POST['category']);
	$statement->bindParam(":bd",$_POST['body']);
	$statement->bindParam(":bid",$blog_id);
	
	$statement->execute();
	
	header("Location:manage_blog.php");
	exit();
	}
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Content</title>
</head>

<body>
<br/>
<form action="" method="post">
	<input type="text" name="title" placeholder="Title" value="<?= $record['title']?>"/><br/>
    <input type="text" name="author" placeholder="Author" value="<?= $record['author']?>"/><br/>
    
    <select name="category">
    <?php foreach($select as $value): ?>
    <option value="<?= $value['category_id']?>"><?= $value['category_name']?></option>
    <?php endforeach; ?>
    </select>
    <br/>
    <textarea name="body"><?= $record['body']?></textarea>
    <br/>
    <input type="submit" name="submit" value="Update"/>
</form>
</body>
</html>