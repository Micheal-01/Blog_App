<?php

if(!isset($_SESSION['id'])&&!isset($_SESSION['name'])){
	header("Location:login.php?error=You are not logged in. This page requires a login access");
	}
$categories = $conn->prepare("SELECT * FROM category");	
$categories->execute();
$categories_records = array();

while($category_row = $categories->fetch(PDO::FETCH_BOTH)){
	$categories_records[] = $category_row;
	
	}


?>
<a href="home.php">Home</a>
<?php foreach($categories_records as $value): ?>

<a href="blog_category.php?category_id=<?= $value['category_id']?>"><?= $value['category_name'] ?></a>

<?php endforeach; ?>

<a href="logout.php">Log Out</a>
<br/>

<?php
echo "ID:".$_SESSION['id']."<br>";
echo "Name:".$_SESSION['name']."<br>";
?>
