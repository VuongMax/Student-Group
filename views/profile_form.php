<section style="height: 100%;">
	<div>
	</div>
	<div>
		<form action="<?php echo SERVER.'index.php/Profile/update'; ?>" method="POST">
			<fieldset>
				<legend>Your Information</legend>
				Username:<br />
				<input type="text" name="name" placeholder="Username" 
				<?php if (isset($name)) echo 'value="'.$name.'" '; ?>
				required autocomplete="off"><br />
				Email:<br />
				<input type="email" name="email" placeholder="Email Address" 
				<?php if (isset($email)) echo 'value="'.$email.'" '; ?>
				required autocomplete="off"><br />
				ID:<br />
				<input type="text" name="id" placeholder="ID" 
				<?php if (isset($id)) echo 'value="'.$id.'" '; ?>
				autocomplete="off"><br />
				Phone:<br />
				<input type="text" name="phone" placeholder="Phone" 
				<?php if (isset($phone)) echo 'value="'.$phone.'" '; ?>
				autocomplete="off"><br />
				Address:<br />
				<input type="text" name="address" placeholder="Address" 
				<?php if (isset($address)) echo 'value="'.$address.'" '; ?> /><br />
				Brithday:<br />
				<input type="date" name="birthday" placeholder="Y-M-D"
				<?php if (isset($birthday)) echo 'value="'.$birthday.'" '; ?> /><br />
					<?php 
					if (isset($class))
						echo 'Class:<br /><input type="text" name="class" 
							value="'.$class.'" autocomplete="off" /><br />';
					if (isset($specialized))
						echo 'Specialized:<br /><input type="text" name="specialized"
							value="'.$specialized.'" autocomplete="off" /><br />';
					if (isset($department))
						echo 'Department:<br /><input type="text" name="department"
							value="'.$department.'" autocomplete="off" /><br />';
					if (isset($level))
						echo 'Level:<br /><input type="text" name="level"
							value="'.$level.'" autocomplete="off" /><br />';
				?>

				<input  id="Submit" type="submit" value="Update Info"><br />
			</fieldset>
		</form>
	</div>

	<div>
	</div>
</section>