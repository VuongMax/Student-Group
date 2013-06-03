<?php
require_once 'models/Validate.php';
require_once 'controllers/Controller.php';
require_once 'models/DatabaseConnector.php';
// echo "<br />";
// $salt = "$2a$10$".substr(sha1(mt_rand()),0,22);
// echo $salt;
// echo "<br/>";
// echo strlen($salt) . "<br/>";

// $hashed = crypt("good", $salt);
// echo $hashed . '<br />';
// echo substr($hashed, 0, 29).'<br/>';
// $pass = 'good';
// if (crypt($pass, substr($hashed, 0, 29)) == $hashed) {
// // if (crypt($pass, $hashed) == $hashed) {
// 	echo "match.";
// } else {
// 	echo "Not match";
// }
if (isset($_POST['submit'])) {
	foreach ($_FILES['fileUpload'] as $key => $value) {
		echo "<br/><strong>$key: </strong> $value";
	}
	$handle = fopen($_FILES['fileUpload']['tmp_name'], "r");
	$content = fread($handle, $_FILES['fileUpload']['size']);

	$db = new DatabaseConnector();
	$db->insert('File', ['name' => $_FILES['fileUpload']['name'],
					'size' => $_FILES['fileUpload']['size'],
					'content' => $content]);
}	

?>
<form enctype="multipart/form-data" action="" method="POST">
	Upload File:
	<input name="fileUpload" type ="file" />
	<input type="submit" name="submit" value="Send File" />
</form>