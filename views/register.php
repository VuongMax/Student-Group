<?php
require_once 'config/Env.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo __CSS__.'home.css';?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __CSS__.'form.css';?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __CSS__.'notify.css';?>">
	<style type="text/css">
		form {
			position: relative;
			top: 0px;
		}
	</style>
	<title>Register Page</title>
</head>
<body>
	<header>
		<a href="<?php echo SERVER.'index.php';?>"><img src="<?php echo __IMAGE__.'HTML5_Badge_64.png';?>"></a> 
	</header>
	<section style=" height: 100%;">
		<!-- <div></div>
		<div></div> -->
		<div>
		<?php if (isset($notify)) { 
				$notify->display(); } 
		?>
			<form action="<?php echo SERVER.'index.php/SignUp';?>" method="POST">
				<fieldset>
					<legend>Register Info</legend>
					<input type="text" name="name" placeholder="Username" 
					<?php if (isset($name)) 
						echo 'value="'.$name.'" ';
					?>
					required autocomplete="off"><br />
					<input type="email" name="email" placeholder="Email Address" 
					<?php if (isset($email))
						echo 'value="'.$email.'" ';
					?> 
					required autocomplete="off"><br />
					<!-- <input type="text" name="id" placeholder="ID" required autocomplete="off"><br /> -->
					<!-- <input type="text" name="class" placeholder="Class" required autocomplete="off"><br /> -->
					<input type="password" name="password" placeholder="Password" 
					<?php if (isset($password))
						echo 'value="'.$password.'" ';
					?>
					required autocomplete="off"><br />
					<input type="password" name="confirm" placeholder="Password Confirm" required autocomplete="off"><br />
					<input  id="Submit" type="submit" value="Register">
				</fieldset>
			</form>
		</div>
	</section>
	<footer></footer>
</body>