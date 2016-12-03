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
                    <p>Heb je hulp nodig bij een bepaald vak, omdat je het vak te moeilijk vindt of omdat je je wilt verbeteren in dat vak? Meld je dan aan door hieronder op het vak te klikken waarin jij bijles wilt krijgen.</p>
                </div><!--
                --><div class="blurb">
                    <div><img src="source/images/icon_gesprek_512px.png"></div>
                    <h5>?</h5>
                    <p>Zodra je je aangemeld hebt voor het desbetreffende vak, wordt er gekeken naar welke behoeften je hebt en welk persoon hier het beste aan gekoppeld kan worden. Op basis van jouw gegevens gaan we een tutor zoeken die goed bij jou past.</p>
                </div><!--
                --><div class="blurb">
                    <div><img src="source/images/icon_bijlesgeven_512px.png"></div>
                    <h5>?</h5>
                    <p>Zodra er een tutor beschikbaar is die we aan jou kunnen koppelen, kan je direct aan de slag. Je betaald wel een bedrag van 5 euro per uur, maar dat zal uiteindelijk moeten gaan lonen. </p>
                </div>
            </div>
            <hr class="big-divider">
            <div class="grid">
                <?php
                    $result = mysql_query("SELECT * FROM `Vakken` ORDER BY Vak");
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        echo "<div class='tile-wrapper' onclick='createPopup(\"500px\", \"auto\", \"" . $row['Vak'] . "\")'><div class='tile' style='background-image: url(source/images/vakken/" . $row['Afbeelding'] . ");'><p><a>" . $row['Vak'] . "</a></p></div></div>";
                    }
                ?>
            </div>

            <div class="popup">
                <div class="form-container">
                    <h3>Bijles krijgen</h3>
                    <div class="close-popup"></div>
                    <form method="POST" action="">
                        <p>Je bent je aan het aanmelden om bijles te krijgen in het vak <span class="highlight" id="hoofdvak"></span></p>
                        

                        <input type="checkbox" name="voorwaarden">
                        <label for="voorwaarden">Ik heb de <a class="voorwaarden" href="#">algemene voorwaarden</a> gelezen en ga hiermee akkoord.</label>

                        <div style="display: none;" id="hiddenvoorwaarden">Hier komen de voorwaarden!</div>
                        <button type="sumbit" name="submit-bijlesgeven">Opslaan</button>
                    </form>
                </div>

                <script>
                //popup script
                function createPopup(width, height, vak) {
                    $(".popup").fadeIn(500);
                    $(".popup").css("display", "flex");
                    $(".form-container").css("width", width);
                    $(".form-container").css("height", height);
                    document.getElementById("hoofdvak").innerHTML = vak;
                };

                $('html').click(function (e) {
                    if ( $(e.target).hasClass("popup") ) {
                        $(".popup").fadeOut(500);
                    }
                });

                $('.close-popup').click(function() {
                    $(".popup").fadeOut(500);
                });
                </script>
            </div>

    </body>

</html>
<?php } ?>


