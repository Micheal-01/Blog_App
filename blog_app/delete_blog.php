<?php
session_start();
include"authenticate.php";
include"db.php";

if(!isset($_GET['id'])){
	header("Location:manage_blog.php");
	exit();
	}
	
	
$statement = $conn->prepare("DELETE FROM blog WHERE blog_id=:bid");
$statement->bindParam(":bid",$_GET['id']);
$statement->execute();

header("location:manage_blog.php");
exit();
?>