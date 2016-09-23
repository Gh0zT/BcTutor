<html>
	<head>
        <title>BcTutor</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <meta charset="UTF-8">
	</head>

	<body>
		<div>
		Instellingen!
		</div>
		<div>		

		  <form style="width: 300px;" class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <input type="text" name="changeusername" placeholder="Verander Gebruikersnaam">
                  <input type="password" name="changepassword" placeholder="Verander Wachtwoord">
		  <input type="email" name="changepassword" placeholder="Verander E-mail">
		  <button type="sumbit" name="submit-settings">Aanpassen</button>
		  </form>
		
		</div>
	</body>
</html>

<?php

$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

if(isset($_POST['submit-settings'])) {

	if($_SESSION['user'] == true) {
		echo"Aanpassingen gemaakt!";
	}	
	else {
		echo"U moet ingelogd zijn om aanpassingen te maken!";
	}
}


?>
