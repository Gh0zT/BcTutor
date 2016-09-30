<!DOCTYPE html>
<html>
	<?php
		session_start(); 
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
		<form name="admin-register" action="" method="POST">
			<input type="text" name="Voornaam" placeholder="Voornaam" required>
                    	<input type="text" name="Tussenvoegsel" placeholder="Tussenvoegsel">
                    	<input type="text" name="Achternaam" placeholder="Achternaam" required>
			<input type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam" required>
                    	<input type="password" name="Wachtwoord" placeholder="Wachtwoord" required>
                    	<input type="email" name="Email" placeholder="E-mail" required>
		</form>
	</body>

	<?php
		function NewAdmin(){
				
		}
		
		function AdminSignUp(){
				
		}
	?>
</html>
