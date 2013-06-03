<section>
	<!-- <div></div>
	<div></div> -->
	<div>
		<?php if (isset($error)) $error->display();?>
		<form action="<?php echo SERVER.'index.php/Profile/doPass';?>" method="POST">
			<fieldset>
				<legend>Change Password</legend>
				<input type="password" name="passwd" placeholder="Old Password" required autofocus autocomplete="off">
				<br /><br />
				<input type="password" name="newPasswd" placeholder="New Password" required autocomplete="off"><br />
				<input type="password" name="confirm" placeholder="Confirm New Password" required autocomplete="off"><br />
				<input  id="Submit" type="submit" value="Submit">
			</fieldset>
		</form>
	</div>
</section>