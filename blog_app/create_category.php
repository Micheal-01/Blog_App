<?php
session_start();
include 'authenticate.php';
include 'db.php';

if(array_key_exists('submit',$_POST)){
	
	$error = array();
if(empty($_POST['category_name'])){
	$error['category_name'] = "Enter Category Name";
	}
if(empty($error)){
	$stmt = $conn->prepare("INSERT INTO category VALUE(NULL,:cn,:cb,NOW(),NOW() )");
	$stmt->bindParam(":cn",$_POST['category_name']);
	$stmt->bindParam(":cb",$_SESSION['id']);
	$stmt->execute();
	
	header("location:create_category.php");
	exit();
	}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Category</title>
</head>

<body>
<?php include('header.php');?>
<form action="" method="post">
<h5>Create your blog categories below</h5>
<input type="text" name="category_name" placeholder="Category Name" />
<input type="submit" name="submit" value="Create" />

</form>
<table border="2">
<tr>
	<th>Category Name</th>
    <th>Admin ID</th>
    <th>Date Created</th>
    <th>Time Created</th>
</tr>
<?php
$select = $conn->prepare("SELECT * FROM category");
$select->execute();
while($row = $select->fetch(PDO::FETCH_BOTH)){
	echo "<tr>";
	echo "<td>".$row['category_name']."</td>";
	echo "<td>".$row['created_by']."</td>";
	echo "<td>".$row['date_created']."</td>";
	echo "<td>".$row['time_created']."</td>";
	echo "</tr>";
	}

?>

</table>


</body>
</html>