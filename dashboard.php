<!DOCTYPE html>
<?php session_start();
if((isset($_SESSION['user'])) && (isset($_SESSION['logged_in']))) { ?>

<?php 
    require("/var/www/dbconfig.php");
    require 'dbconnect.php';
?>
<html>
    <head>
        <title>BcTutor</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <meta charset="UTF-8">

        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'></script>
    </head>

    <body>
        <?php include 'includes/navbar.php'; ?>
	
	<div class="wrapper">
 	    <h2>Dashboard</h2>
	    <hr>
	
	    <div class="dashboard">
		<div class="bijlesgeven">
			<div style="width: 40px; height: 40px; background-color: red;"></div>
			<h6>Tutor</h6>
			<p>
			    <?php 
			    $ID = $_SESSION['ID'];
			    $result = mysql_query("SELECT `Tutor` FROM `Users` WHERE `ID`=$ID");
			    $row = mysql_fetch_array($result);
                            if ($row['Tutor'] == "nee") {
				echo "Je bent nog niet aangemeld als Tutor! Klik <a>hier</a> om je aan te melden!";
			    } else if ($row['Tutor'] == "ja") {
				$result2 = mysql_query("SELECT u.Voornaam 'Voornaam', v.Vak 'Vak' FROM Users u, Tutors t, Vakken v WHERE v.ID = t.Vak AND u.ID = t.Leerling AND t.Tutor = $ID");
				$i = 1;
				while ( $row2 = mysql_fetch_array($result2) ) {
				    if($i == 1) {
				        echo "Je geeft momenteel bijles aan " . $row2['Voornaam'] . " in " . $row2['Vak'];
				    }
				    if($i != 1) {
					echo ", en aan " . $row2['Voornaam'] . " in " . $row2['Vak'];
				    }
				    if($i == mysql_num_rows($result2)) {
					echo ".";	
				    }
				    $i++;
				}	
			    } else if ($row['Tutor'] == "goedgekeurd") {
				echo "Je mag bijles geven maar er komt op dit moment niemand in aanmerking om bijles aan te geven. Je ontvangt een e-mail zodra we iemand voor je gevonden hebben!";
			    } else if ($row['Tutor'] == "wachtend op goedkeuring") {
				echo "Top dat je je hebt aangemeld om bijles te geven! Je bent in afwachting van goedkeuring om ook echt bijles te mogen gaan geven.";
			    }
			    ?>
			</p>
		</div>
		<div class="bijleskrijgen">
		    <div style="width: 40px; height: 40px; background-color: red;"></div>
                    <h6>Leerling</h6>
                    <p>
			<?php 
			$ID = $_SESSION['ID'];
			$result = mysql_query("SELECT u.Leerling 'Leerling' FROM Users u WHERE u.ID=$ID");
			$row = mysql_fetch_array($result);
			if ($row['Leerling'] == "nee") {
			    echo "Je hebt je nog niet aangemeld om bijles te krijgen! Klik <a>hier</a> om je daarvoor aan te melden.";
			} else if ($row['Leerling'] == "ja") {
			    $result2 = mysql_query("SELECT u.Voornaam 'Voornaam', v.Vak 'Vak' FROM Users u, Tutors t, Vakken v WHERE v.ID = t.Vak AND u.ID = t.Tutor AND t.Leerling = $ID");
			    $i = 1;
			    while ( $row2 = mysql_fetch_array($result2) ) {
				if($i == 1) {
				    echo "Je krijgt bijles in " . $row2['Vak'] . " van " . $row2['Voornaam'];
				}
                               	if($i != 1) {
				    echo ", en in " . $row2['Vak'] . " van " . $row2['Voornaam'];
				}
  				if($i == mysql_num_rows($result2)) {
				    echo ".";
				}
				$i++;
			    }	
			}
			?>
		    </p>	
		</div>
	    </div>
	</div>
    </body>
</html>
<?php } ?>
