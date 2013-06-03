<section>
	<div>
		<h3>Nhap Thong Tin Lop Hoc:</h3>
		<form style="right: 800px; top: 20px;" action="<?php echo SERVER.'index.php/ClassOpen/doOpen';?>" method="POST">
			<fieldset>
				<legend>Class information</legend>
				<!-- placeholder for display text default -->
				<input type="text" name="classID" placeholder="Class ID" 
					required autocomplete="off" autofocus /><br />
				<input type="text" name="className" placeholder="Class Name"
					required autocomplete="off" /><br />
				<input type="text" name="courseID" placeholder="Course ID" 
					required autocomplete="off" /><br />
				<input type="text" name="semester" placeholder="Semester" 
					required autocomplete="off" /><br />
				<input type="date" name="dateFinish" placeholder="Date Finish (YYYY-MM-DD)" 
					required autocomplete="off" /><br />
				<input id="Submit" type="submit" value="Submit">
			</fieldset>
		</form>
	</div>

	<div>
	</div>
</section>