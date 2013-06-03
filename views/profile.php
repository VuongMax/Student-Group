<section>
	<div>
		<?php if (isset($message)) echo '<h4 style=" color: #419E94; ">'.$message.'</h4>';?>

		<h3>Thong tin ca nhan</h3>
		<strong>Name: </strong><?php echo $_SESSION['name']; ?><br />
		<strong>Email: </strong><?php echo $_SESSION['email']; ?><br />
		<strong>Group: </strong><?php echo $_SESSION['group']; ?><br />
		<strong>Phone: </strong><?php if (isset($phone)) echo $phone; ?><br />
		<strong>ID: </strong><?php if (isset($id)) echo $id; ?><br />
		<strong>Address: </strong><?php if (isset($address)) echo $address; ?><br />
		<strong>Birthday: </strong><?php if (isset($birthday)) echo $birthday; ?><br />
		<strong>Date SignUp: </strong><?php if (isset($dateCreated)) echo $dateCreated; ?><br />
		<?php if (isset($class)) echo '<strong>Class: </strong>'.$class.'<br />'; ?>
		<?php if (isset($specialized)) echo '<strong>Specialized: </strong>'.$specialized.'<br />'; ?>
		<?php if (isset($department)) echo '<strong>Department: </strong>'.$department.'<br />'; ?>
		<?php if (isset($level)) echo '<strong>Level: </strong>'.$level.'<br />'; ?>
		<br /><a class="good" id="profile" 
			href="<?php echo SERVER.'index.php/Profile/show/1'; ?>">Edit Profile</a>
		<a class="good" id="passwd" href="<?php echo SERVER.'index.php/Profile/passForm';?>">Edit Password</a>
	</div>

	<div>
	</div>
</section>