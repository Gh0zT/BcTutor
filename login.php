<?php

session_start();

$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

if(isset($_POST['submit-login'])) {

	$myusername = $_POST['myusername'];
	$mypassword = $_POST['mypassword'];

	$sql = "SELECT * FROM `Users` WHERE Gebruikersnaam='$myusername' OR Email='$myusername' AND Wachtwoord='$mypassword'";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);

	if($count==1) {

		$_SESSION['user'] = $myusername;
		$_SESSION['logged_in'] = true;

		$sql2 = "SELECT `ID` FROM `Users` WHERE Gebruikersnaam='$myusername' OR Email='$myusername'";
                $result2 = mysql_query($sql2);
		$values = mysql_fetch_array($result2);


		$_SESSION['ID'] = $values['ID'];

		header("Location: index.php");
	}
	else {
		echo "Verkeerde gebruikersnaam en/of wachtwoord!";
	}
}	

?>
