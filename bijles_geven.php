<!DOCTYPE html>
<html>

<?php session_start();

require '/var/www/dbconfig.php';
require 'dbconnect.php';

if(!($_SESSION['logged_in'] == true)) {
	header("Location: index.php");
} else { ?>

	<head>
		<title>BcTutor</title>
        	<link rel="stylesheet" type="text/css" href="style/style.css">
        	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	        <meta charset="UTF-8">
	</head>
	<body>
		<?php include 'includes/navbar.php'; ?>

		<div class="blurb-container">
			<div class="blurb">
				<img src="">
				<h5>Aanmelden</h5>
				<p>Ben je goed in een bepaald vak en ben je bereid om andere leerlingen bijles te geven in dat vak? Meld je dan aan door hieronder op het vak te klikken waarin je bijles wilt geven. Je moet echter wel aan de voorwaarden voldoen om bijles te geven!</p>
			</div>
			<div class="blurb">
                                <img src="">
                                <h5>gesprek</h5>
                                <p>Ben je aangemeld om bijles te geven? Dan wordt je uitgenodigd voor een gesprek! In dit gesprek krijg je verdere informatie en wordt gekeken of je inderdaad geschikt bent om bijles te geven.</p>
                        </div>
			<div class="blurb">
                                <img src="">
                                <h5>Bijles geven</h5>
                                <p>Zodra uit het gesprek blijkt dat je aan alle voorwaarden voldoet, kun je beginnen met bijles geven! Je verdient hiermee 5 euro per uur en de school stelt een ruimte beschikbaar waar je rustig kunt zitten om bijles te geven.</p>
                        </div>
		</div>

			<div class="grid">
				<?php
$result = mysql_query("SELECT * FROM `Vakken`");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<div class='tile' style='background-image: url(source/images/vakken/" . $row['Afbeelding'] . ");'><p>" . $row['Vak'] . "</p></div>";
}				?>
			</div>
	</body>
</html>
<?php } ?>
