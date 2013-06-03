<?php
require_once 'config/Env.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo __CSS__.'home.css';?>">
<link rel="stylesheet" type="text/css" href="<?php echo __CSS__.'link.css';?>">
<link rel="stylesheet" type="text/css" href="<?php echo __CSS__.'form.css';?>">
<link rel="stylesheet" type="text/css" href="<?php echo __CSS__.'notify.css';?>">
<title>Home For Web StudentGroup</title>
</head>
<body>
	<header>
		<a href="<?php echo SERVER.'index.php';?>"><img src="<?php echo __IMAGE__.'HTML5_Badge_64.png';?>"></a> 

<!-- 		<nav> -->
<!-- 			<ul> -->
<!-- 				<li>Home</li> -->
<!-- 				<li>Menu</li> -->
<!-- 				<li>Contact</li> -->
<!-- 			</ul> -->
<!-- 		</nav> -->
		<?php if (isset($_SESSION['name'])) {
			echo '<a class="top" href="'. SERVER .'index.php">'. $_SESSION['name'] . '</a>';
			echo '<a class="top" href="'. SERVER . 'index.php/Profile/show">Profile</a>';
			echo '<a class="good" href="'. SERVER .'index.php/SignOut">Sign Out</a>';
		} else {
			echo '<a class="good" href="'.SERVER. 'index.php/SignUp/view">Register</a>';
		}
		?>
	</header>