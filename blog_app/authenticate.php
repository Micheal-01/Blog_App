<?php

if(!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_name'])){
	header("Location:admin_login.php?error=The page you visited requires login");
	exit();
	}