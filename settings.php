<?php session_start();

include 'includes/navbar.php';

?>

<html>
	<head>
        <title>BcTutor</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <meta charset="UTF-8">
	</head>

	<body>
		<div>
		Instellingen! <?php echo 'Welkom ' . $_SESSION['user'] . ' !'; ?>
		</div>
		<div>		

		  <form style="width: 300px;" class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <input type="text" name="changeusername" placeholder="Verander Gebruikersnaam">
                  <button type="sumbit" name="submit-settings-username">Aanpassen</button>
		  </form>
		  <form style="width: 300px;" class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <input type="password" name="changepassword" placeholder="Verander Wachtwoord">
                  <button type="sumbit" name="submit-settings-password">Aanpassen</button>
		  </form>
		  <form style="width: 300px;" class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <input type="email" name="changeemail" placeholder="Verander E-mail">
                  <button type="sumbit" name="submit-settings-email">Aanpassen</button>
		  </form>
		
		</div>
	</body>
</html>

<?php

$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

$changeusername = $_POST['changeusername'];
$changepassword = $_POST['changepassword'];
$changeemail = $_POST['changeemail'];
$ID = $_SESSION['ID'];


if(isset($_POST['submit-settings-username'])) {

	if($_SESSION['user'] == true) {
		if($changeusername !== '') {
			
			$query = mysql_query("SELECT * FROM `Users` WHERE Gebruikersnaam='$changeusername'") or die(mysql_error());
			$count = mysql_num_rows($query);

		        if($count==0) {
	
				$result = mysql_query("UPDATE `Users` SET Gebruikersnaam='$changeusername' WHERE ID='$ID'");
				echo"Aanpassingen gemaakt!";
			}
			else {
				echo"Deze gebruikersnaam is al in gebruik!";
			}
		}
		else {
			echo"Vul alstublieft een geldige waarde in!";
		}	
	}	
	else {
		echo"U moet ingelogd zijn om aanpassingen te maken!";
	}
}
if(isset($_POST['submit-settings-password'])) {

        if($_SESSION['user'] == true) {
                if($changepassword !== '') {

                        $query = mysql_query("SELECT * FROM `Users` WHERE Wachtwoord='$changepassword'") or die(mysql_error());
                        $count = mysql_num_rows($query);

                        if($count==0) {

                		$result = mysql_query("UPDATE `Register` SET Wachtwoord='$changepassword'");
                		echo"Aanpassingen gemaakt!";
        		}
			else {
				echo"Dit wachtwoord is al in gebruik!";
			}
		}
		else {
			echo"Vul alstublieft een geldige waarde in!";
		}
	}
        else {
                echo"U moet ingelogd zijn om aanpassingen te maken!";
        }
}
if(isset($_POST['submit-settings-email'])) {

        if($_SESSION['user'] == true) {
		if($changeemail !== '') {

                        $query = mysql_query("SELECT * FROM `Register` WHERE Email='$changeemail'") or die(mysql_error());
                        $count = mysql_num_rows($query);

                        if($count==0) {
                	
				$result = mysql_query("UPDATE `Register` SET ='$changeemail'");
                		echo"Aanpassingen gemaakt!";
        		}
			else {
				echo"Dit e-mailadres is al in gebruik!";
			}
		}
		else {
			echo"Vul alstublieft een geldige waarde in!";
		}
	}
        else {
                echo"U moet ingelogd zijn om aanpassingen te maken!";
        }
}


?>
