<!DOCTYPE html>
<?php session_start();

require("/var/www/dbconfig.php");
require 'dbconnect.php';

//check of gebruiker ingelogd is
if((isset($_SESSION['user'])) && (isset($_SESSION['logged_in']))) { 
    //check of gebruiker admin is
    $id = $_SESSION['ID'];
    $result = mysql_query("SELECT u.Admin FROM Users u WHERE u.ID='$id'");
    $row = mysql_fetch_array($result); 
    if($row['Admin'] == "ja"){
?>
<html>
    <head>
        <title>BcTutor</title>

        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- SEMANTIC UI -->
        <link rel="stylesheet" type="text/css" href="Semantic-UI-CSS/semantic.min.css">
        <script src="Semantic-UI-CSS/semantic.min.js"></script>
        <script src="http://semantic-ui.com/javascript/library/tablesort.js"></script>

        <!-- STYLE & FONTS -->
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <meta charset="UTF-8">

	 <?php $page = home; ?>

    </head>
    <body>
	<?php include "includes/navbar.php"; ?>

	<?php if($_GET['view'] == "tutors"){ ?>
	<div class="ui vertical segment" style="padding: 90px 0 0 0;">
	    <div class="ui grid container">
		    <div class="four wide column">
		    	<div class="ui vertical menu">
			    <a class="active item" href="dashboard.php?view=tutors">Tutors</a>
			    <a class="item" href="dashboard.php?view=students">Studenten</a>
			    <a class="item" href="dashboard.php?view=aanmeldingen">Aanmeldingen</a>
		    	</div>
		    </div>
		    <div class="twelve wide column">
		       	<table class="ui sortable celled blue table">
			    <thead>
				<tr>
				    <th></th>
				    <th>Voornaam</th>
				    <th>Tussenvoegsel</th>
				    <th>Achternaam</th>
                                    <th>Klas</th>
				    <th class="collapsing">Koppelen</th>
				</tr>
			    </thead>
			    <tbody>
			    <?php
				$result = mysql_query("SELECT u.Voornaam 'Voornaam', u.Achternaam 'Achternaam', u.Tussenvoegsel 'Tussenvoegsel', u.Klas 'Klas' FROM Users u, Tutors t WHERE u.ID = t.Tutor");
			    	while($row = mysql_fetch_array($result)){
				    echo "<tr>
				        <td class='collapsing'>
        				    <div class='ui fitted checkbox'>
          					<input type='checkbox'> <label></label>
        				    </div>
      					    </td><td>" . $row['Voornaam'] . "</td><td>" . $row['Tussenvoegsel'] . "</td><td>" . $row['Achternaam'] . "</td><td>" . $row['Klas'] . "</td><td></td></tr>";
				}
			    ?>
			    </tbody>
			    <tfoot>
				<th colspan="6">
				    <div class="ui right floated small primary labeled icon button">
          				<i class="user icon"></i> Add User
        			    </div>
				</th>
			    </tfoot>
			</table>
			<script>
			    $('.ui.sortable.table').tablesort();
			</script>
   		    </div>
	    </div>
	</div>
	<?php } elseif ($_GET['view'] == "students"){ ?>

	<?php } elseif ($_GET['view'] == "aanmeldingen" || $view == ""){ ?>
	    <div class="ui vertical segment" style="padding: 90px 0 0 0;">
                <div class="ui grid container">
                    <div class="four wide column">
                        <div class="ui vertical menu">
                            <a class="item" href="dashboard.php?view=tutors">Tutors</a>
                            <a class="item" href="dashboard.php?view=students">Studenten</a>
                            <a class="active item" href="dashboard.php?view=aanmeldingen">Aanmeldingen</a>
                        </div>
                    </div>
		    <div class="twelve wide column">
                        <table class="ui sortable celled selectable blue table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Voornaam</th>
                                    <th>Tussenvoegsel</th>
                                    <th>Achternaam</th>
                                    <th>Klas</th>
				    <th>Vak/Vakken</th>
				    <th>Datum</th>
				    <th>Keuze</th>
                                </tr>
                            </thead>
			    <tbody>
				<style>
				td {
				    white-space: nowrap;
				    overflow: hidden;
				}
				</style>
                            <?php
                                $result = mysql_query(" SELECT Users.Voornaam, Users.Tussenvoegsel, Users.Achternaam, Users.Klas, GROUP_CONCAT(Vakken.Afkorting SEPARATOR ','), Tutoraanmeldingen.Datum, Tutoraanmeldingen.Keuze, Users.ID
							FROM Tutoraanmeldingen
							JOIN Vakken ON Tutoraanmeldingen.Vak=Vakken.ID
							JOIN Users ON Tutoraanmeldingen.ID=Users.ID
							GROUP BY Tutoraanmeldingen.ID
							UNION ALL
							SELECT Users.Voornaam, Users.Tussenvoegsel, Users.Achternaam, Users.Klas, GROUP_CONCAT(Vakken.Afkorting SEPARATOR ','), Leerlingaanmeldingen.Datum, Leerlingaanmeldingen.Keuze, Users.ID
                                                        FROM Leerlingaanmeldingen
                                                        JOIN Vakken ON Leerlingaanmeldingen.Vak=Vakken.ID
                                                        JOIN Users ON Leerlingaanmeldingen.ID=Users.ID
							GROUP BY Leerlingaanmeldingen.ID
							 ");

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				    $vakkenlijst = explode(",", $row['GROUP_CONCAT(Vakken.Afkorting SEPARATOR \',\')']);
                                    echo "<tr>
                                        <td class='collapsing'>
                                            <div class='ui fitted checkbox'>
                                                <input type='checkbox' class='ajax-checkbox' name='checkbox[]' value='" . $row['ID'] . "'><label></label>
                                            </div>
                                        </td>
					<td>" . $row['Voornaam'] . "</td>
					<td>" . $row['Tussenvoegsel'] . "</td>
					<td>" . $row['Achternaam'] . "</td>
					<td>" . $row['Klas'] . "</td>
					<td>";
					foreach($vakkenlijst as $vak){
					    echo "<div class='ui blue horizontal label'>" . $vak . "</div>";
					}
					echo "</td><td>" . $row['Datum'] . "</td>
					<td>" . $row['Keuze'] . "</td>
				    </tr>";
                                }
			    ?>
                            </tbody>
                            <tfoot>
				<th colspan="8">
				    <div id="approve-users" class="ui small labeled icon button" type="button" name="approve-users">
					<i class="add user icon"></i>Aanmeldingen accepteren
				    </div>
                                    <div id="deny-users" class="ui small labeled icon button" type="button" name="deny-users">
                                        <i class="remove user icon"></i>Aanmeldingen annuleren
                                    </div>
                                </th>
                            </tfoot>
                        </table>
                        <script>
			$( document ).ready(function() {
    			    $('#approve-users').click(function(){
				$.ajax({
			            type: "POST",
      				    url: 'ajaxHandlerDashboard.php',
        			    data: $('.ajax-checkbox:checked').serialize(),
        			    success: function( response ) {
          				console.log(response);
         			    }
      				});
			    });
			});
                        $('.ui.sortable.table').tablesort();
                        </script>
                    </div>
            </div>
        </div>
	<?php } ?>

    </body>
</html>

<?php 
}else{ ?>

<html>
    <head>
        <title>BcTutor</title>

        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- SEMANTIC UI -->
        <link rel="stylesheet" type="text/css" href="Semantic-UI-CSS/semantic.min.css">
        <script src="Semantic-UI-CSS/semantic.min.js"></script>

        <!-- STYLE & FONTS -->
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <meta charset="UTF-8">

	<?php $page = home; ?>

    </head>

    <body>
        <?php include 'includes/navbar.php'; ?>
	
	<div class="wrapper" style="padding: 90px 0 40px 0;">
 	    <h2 style="color: blue;">Dashboard</h2>
	    <hr>
	
	<?php
	    $ID = $_SESSION['ID'];
	    $sql = "SELECT * FROM `Users` WHERE ID='$ID'";
	    $result = mysql_query($sql);
	    $row = mysql_fetch_array($result);

	    

	    echo "Welkom op BcTutor " . $row['Voornaam'] . " " . $row['Tussenvoegsel'] . " " . $row['Achternaam'];
	?>
	<br/>
	<?php
	    echo "Je zit nu in " . $row['Niveau'] . " " . $row['Leerjaar'];
	?>
	<br/><br/>

	<?php
	 	$result2 = mysql_query(" SELECT ID, Vak, Datum FROM Tutoraanmeldingen AS ta WHERE ID = '$ID'
					 UNION ALL
					 SELECT ID, Vak, Datum FROM Tutors AS t WHERE ID = '$ID'
					 UNION ALL
					 SELECT ID, Vak, Datum FROM Leerlingaanmeldingen AS la WHERE ID = '$ID'
                                         UNION ALL
					 SELECT ID, Vak, Datum FROM Leerlingen AS l WHERE ID = '$ID' ");

	    $num_rows = mysql_num_rows($result2); 
	    echo $num_rows . "<br>";
		if($num_rows > 0){
		    while ($row3 = mysql_fetch_array($result2, MYSQL_ASSOC)){
			echo $row3['ID'] . "; " . $row3['Vak'] . "; " . $row3['Datum'] . "<br>";	
		    }
		}		
            	if ($num_rows == 0) {
                    echo "U staat nog nergens voor ingeschreven";
            	}
                else {
                    echo "U staat reeds ingeschreven";
                }
	?>
	<br /><br />
	<?php
	    echo "In het vak: " . $row2['Vak']; 
	    echo "<br/ >Op de datum: " . $row2['Datum'];
	?>
	<br /><br />











<!--	    <div class="dashboard">
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
				$result2 = mysql_query("SELECT u.Voornaam 'Voornaam', u.Tussenvoegsel 'Tussenvoegsel', u.Achternaam 'Achternaam', v.Vak 'Vak' FROM Users u, Tutors t, Vakken v WHERE v.ID = t.Vak AND u.ID = t.Leerling AND t.Tutor = $ID");
				$i = 1;
				while ( $row2 = mysql_fetch_array($result2) ) {
				    if($i == 1) {
				        echo "Je geeft momenteel bijles aan " . $row2['Voornaam'] . " " . $row2['Tussenvoegsel'] . " " . $row2['Achternaam'] . " in " . $row2['Vak'];
				    }
				    if($i != 1) {
					echo ", en aan " . $row2['Voornaam'] . " " . $row2['Tussenvoegsel'] . " " . $row2['Achternaam'] . " in " . $row2['Vak'];
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
			    $result2 = mysql_query("SELECT u.Voornaam 'Voornaam', u.Tussenvoegsel 'Tussenvoegsel', u.Achternaam 'Achternaam', v.Vak 'Vak' FROM Users u, Tutors t, Vakken v WHERE v.ID = t.Vak AND u.ID = t.Tutor AND t.Leerling = $ID");
			    $i = 1;
			    while ( $row2 = mysql_fetch_array($result2) ) {
				if($i == 1) {
				    echo "Je krijgt bijles in " . $row2['Vak'] . " van " . $row2['Voornaam'] . " " . $row2['Tussenvoegsel'] . " " . $row2['Achternaam'];
				}
                               	if($i != 1) {
				    echo ", en in " . $row2['Vak'] . " van " . $row2['Voornaam'] . " " . $row2['Tussenvoegsel'] . " " . $row2['Achternaam'];
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
	    </div> -->

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

                </div>
	</div>
<?php

$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

$changeusername = $_POST['changeusername'];
$changepassword = $_POST['changepassword'];
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

			$usersession = $_SESSION['user'];
                        $query = mysql_query("SELECT Wachtwoord FROM `Users` WHERE Gebruikersnaam='$usersession'") or die(mysql_error());
                        $count = mysql_num_rows($query);
			$result2 = mysql_fetch_array($query);

			if($result2['Wachtwoord'] == $changepassword) {
				echo"Dit wachtwoord is al in gebruik!";
				break;
                        }	

                        if($count==1) {

                                $result = mysql_query("UPDATE `Users` SET Wachtwoord='$changepassword' WHERE Gebruikersnaam='$usersession'");
                                echo"Aanpassingen gemaakt!";
				echo"$pass";
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

    </body>
</html>
<?php }
} else {

header('Location: index.php');

}
?>
