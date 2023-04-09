<?php
session_start();
include'db.php';

$blogs = $conn->prepare("SELECT * FROM blog");
$blogs->execute();
$records = array();

while($row = $blogs->fetch(PDO::FETCH_BOTH)){
	$records[] = $row;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
</head>

<body>
<h1>Welcome to the Homepage</h1>

<?php include 'user_header.php';?>
<?php foreach($records as $value): ?>

<a href="view_blog.php?id=<?= $value['blog_id']?>"><h3> <?= $value['title']?> by <?= $value['author'] ?></h3></a>

<?php endforeach; ?>
 
</body>
</html>