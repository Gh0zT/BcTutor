<?php
session_start();
$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

if(isset($_POST['submit-login'])) {

	$myusername = $_POST['myusername'];
	$mypassword = $_POST['mypassword'];

	$sql = "SELECT * FROM `Users` WHERE BINARY Gebruikersnaam='$myusername' AND BINARY Wachtwoord='$mypassword' OR BINARY Email='$myusername' AND BINARY Wachtwoord='$mypassword'";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);
	if($count==1) {

		$_SESSION['user'] = $myusername;
		$_SESSION['logged_in'] = true;

		$sql2 = "SELECT `ID` FROM `Users` WHERE BINARY Gebruikersnaam='$myusername' OR BINARY Email='$myusername'";
                $result2 = mysql_query($sql2);
		
		while($values = mysql_fetch_array($result2)){
                    $_SESSION['ID'] = $values['ID'];
                }

		header("Location: index.php");
	}
	else {
		echo "Verkeerde gebruikersnaam en/of wachtwoord!";
	}
}	

?>
