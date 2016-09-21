<?php

session_start();

$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

if(isset($_POST['submit-login'])) {

	$myusername = $_POST['myusername'];
	$mypassword = $_POST['mypassword'];

	$sql = "SELECT * FROM `Register` WHERE Gebruikersnaam='$myusername' AND Wachtwoord='$mypassword'";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);

	if($count==1) {

		$_SESSION['user'] = $myusername;
		$_SESSION['logged_in'] = true;

		header("Location: test.php");
	}
	else {
		echo "Verkeerde gebruikersnaam en/of wachtwoord!";
	}
}	

?>
