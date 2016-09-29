<?php


//////// WALHALLALALKJLSKDJ SELECT `ID` FROM `Register` WHERE Gebruikersnaam='Mikeyy';


session_start();

$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

if(isset($_POST['submit-login'])) {

	$myusername = $_POST['myusername'];
	$mypassword = $_POST['mypassword'];

	$sql = "SELECT * FROM `Register` WHERE Gebruikersnaam='$myusername' OR Email='$myusername' AND Wachtwoord='$mypassword'";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);

	if($count==1) {

		$_SESSION['user'] = $myusername;
		$_SESSION['logged_in'] = true;

		$sql2 = "`ID` SELECT FROM `Register` WHERE Gebruikersnaam='$myusername' OR Email='$myusername'";
                $result2 = mysql_query($sql2);

		echo $result2;

		//header("Location: test.php");
	}
	else {
		echo "Verkeerde gebruikersnaam en/of wachtwoord!";
	}
}	

?>
