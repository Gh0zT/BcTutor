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

		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'></script>
	</head>
	<body>
		<?php include 'includes/navbar.php'; ?>

		<div class="blurb-container">
			<div class="blurb">
				<div><img src="source/images/icon_aanmelden_512px.png"></div>
				<h5>Aanmelden</h5>
				<p>Ben je goed in een bepaald vak en ben je bereid om andere leerlingen bijles te geven in dat vak? Meld je dan aan door hieronder op het vak te klikken waarin je bijles wilt geven. Je moet echter wel aan de voorwaarden voldoen om bijles te geven!</p>
			</div><!--
			--><div class="blurb">
                                <div><img src="source/images/icon_gesprek_512px.png"></div>
                                <h5>Gesprek</h5>
                                <p>Ben je aangemeld om bijles te geven? Dan wordt je uitgenodigd voor een gesprek! In dit gesprek krijg je verdere informatie en wordt gekeken of je inderdaad geschikt bent om bijles te geven.</p>
                        </div><!--
			--><div class="blurb">
                                <div><img src="source/images/icon_bijlesgeven_512px.png"></div>
                                <h5>Bijles geven</h5>
                                <p>Zodra uit het gesprek blijkt dat je aan alle voorwaarden voldoet, kun je beginnen met bijles geven! Je verdient hiermee 5 euro per uur en de school stelt een ruimte beschikbaar waar je rustig kunt zitten om bijles te geven.</p>
                        </div>
		</div>
              	<hr class="big-divider">
		<div class="grid">
			<?php
$result = mysql_query("SELECT * FROM `Vakken` ORDER BY Vak");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<div class='tile-wrapper' onclick='registerBoxAppear(\"" . $row['Vak'] . "\")'><div class='tile' style='background-image: url(source/images/vakken/" . $row['Afbeelding'] . ");'><p><a>" . $row['Vak'] . "</a></p></div></div>";
}			?>
		</div>

	<div id="register-container">
            <div class="entry other-popup">
                <h3 class="entry-caption">Bijles geven</h3>
                <div id="close-register" class="close-popup"></div>

                <form class="login-form" method="POST" action="">
		    <p>Je bent je aan het aanmelden om bijles te geven in <span class="highlight" id="hoofdvak"></span></p>
                    <input type="text" name="Klas" placeholder="Klas" required>
		    <input type="text" name="Extravak" placeholder="Extra vakken" required>

		    <input type="checkbox" id="" name="voorwaarden">
                    <label for=""><div id="voorwaarden" style="display:none;"</div>Hierbij ga ik akkoord met de <a href="voorwaarden;" onClick="document.getElementById('voorwaarden').style.display='block';">Hierbij de voorwaarden.</label>


		    <!--<input type="hidden" name="Hoofdvak" value="!!!">-->
                    <button type="sumbit" name="submit-bijlesgeven">Opslaan</button>
                </form>
            </div>

            <script>
                $(document).ready(function(){
                    $("#register-container").hide();
                });
		
                function registerBoxAppear(vak) {
                    $("#register-container").fadeIn(500);
      		    $('body').addClass('stop-scrolling');
                    document.getElementById("hoofdvak").innerHTML = vak;
                };

                $('html').click(function (e) {
                    if (e.target.id == 'register-container') {
                        $("#register-container").fadeOut(500);
                    }
                });

                $('#close-register').click(function() {
                    $("#register-container").fadeOut(500);
  		    $('body').removeClass('stop-scrolling');
                });
            </script>
        </div>

	</body>
</html>
<?php } ?>
