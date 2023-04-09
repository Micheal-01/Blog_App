<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>ID: <?php echo $_SESSION['admin_id']?></p>
<p>Name: <?php echo $_SESSION['admin_name']?></p>
<hr/>
<a href="create_category.php">Create Category</a>
<a href="add_blog.php">Create Blog</a>
<a href="manage_blog.php">Manage Blog</a>
<a href="admin_logout.php">Logout</a>
</body>
</html>