<!DOCTYPE html>
<html>
	<?php 
		require ('/var/www/dbconfig.php');
		require 'dbconnect.php';
	?>
	<head>
        	<title>BcTutor</title>
        	<link rel="stylesheet" type="text/css" href="style/style.css">
	        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        	<meta charset="UTF-8">
    	</head>
	<body>
		<?php include 'includes/navbar.php'; ?>
		<form name="admin-login" action="" method="POST">
			<input type="text" name="user" placeholder="Gebruikersnaam" required>
                    	<input type="password" name="pass" placeholder="Wachtwoord" required>
			<button type="submit" name="submit-admin-login">Log in</button>
		</form>
	</body>

	<?php
		if(isset($_POST['submit-admin-login'])) {
			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$result = mysql_query("SELECT * FROM `Admins` WHERE Gebruikersnaam='$user' AND Wachtwoord='$pass'");
			
			$rowCount = mysql_num_rows($result);
			
			if($rowCount == 1) {
				session_start();
				
				$_SESSION['user'] = $user;
				$_SESSION['logged_in'] = true;
				
				$result2 = mysql_query("SELECT `ID` FROM `Admins` WHERE Gebruikersnaam='$user'");
				$row = mysql_fetch_array($result2);

				$_SESSION['ID'] = $row['ID'];
				
				echo "bier";

				header("Location: test.php");
			}
			else {
				echo "Verkeerde inloggegevens";
			}
		}
	?>
</html>
