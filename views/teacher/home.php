<section>
	<div>
		<h3>Cac lop dang quan ly</h3>
		<?php
		foreach ($arrClass as $class) {
			echo '<a href="'.SERVER.'index.php/'.$class->getClassID().'">'.$class->getClassName().'</a><br/>';
		}
		?>
		
		<br />
		<a href="<?php echo SERVER.'index.php/ClassOpen';?>"><strong>Mo them Lop</strong></a>
	</div>

	<div>
	</div>
</section>