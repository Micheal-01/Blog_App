<?php
session_start();
include 'db.php';

$single_blog = $conn->prepare("SELECT * FROM blog WHERE blog_id=:bid");
$single_blog->bindParam(":bid",$_GET['id']);
$single_blog->execute();

$row = $single_blog->fetch(PDO::FETCH_BOTH);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $row['title']?></title>
<style>
.center{
	text-align:center
	
	}
</style>
</head>

<body style="background-color:#3c9">
<?php include 'user_header.php'; ?>
<h1 class="center"><?= $row['title']?></h1>
<p class="center"> by<?= ucwords($row['author'])?></p>
<p class="center">Posted on: <?= $row['date_created']?></p>
<hr />
<p><?= $row['body']?></p>
</body>
</html>