<section>
		<div id="gear">
			<img src="<?php echo __IMAGE__.'bg.jpg';?>"> 
			<img id="gear1" src="<?php echo __IMAGE__.'g1.png';?>">
			<img id="gear2" src="<?php echo __IMAGE__.'g2.png';?>"> 
			<img id="gear3" src="<?php echo __IMAGE__.'g3.png';?>"> 
			<img id="gear4" src="<?php echo __IMAGE__.'g4.png';?>">
		</div>
		<div>
			<!-- For Sign in -->
			<?php
			if (isset($notify))
				$notify->display();
			?>
			<form action="<?php echo SERVER.'index.php/SignIn';?>" method="post">
				<fieldset>
					<legend>Your information</legend>
					<!-- placeholder for display text default -->
					<input id="username" type="email" name="email" placeholder="Email address" 
						required autocomplete="off" autofocus /><br /> 
					<input id="password" type="password"name="password" placeholder="Password" 
						required autocomplete="off" /><br />
					<!-- <input type="checkbox" name="remember" checked />Remember ?<br /> -->
					<input style="display: inline;" type="checkbox" name="remember" />
					<span style="margin-left: 6px; color: #363D43;">Remember</span>
					<input id="Submit" type="submit" value="Sign in">
				</fieldset>
			</form>
		</div>
		<div>
			<!-- For Sign Up -->
		</div>
	</section>