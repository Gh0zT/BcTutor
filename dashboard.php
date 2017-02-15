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
	<div class="ui vertical segment" style="padding: 90px 0 0 0;">
	    <div class="ui grid container">
		    <div class="four wide column">
		    	<div class="ui vertical menu">
			    <a class="item">Tutors</a>
			    <a class="item">Studenten</a>
		    	</div>
		    </div>
		    <div class="twelve wide column">
		       	<table class="ui sortable celled table">
			    <thead>
				<tr>
				    <th>hoi1</th>
				    <th>hoi2</th>
				    <th>hoi1</th>
                                    <th>hoi2</th>
				</tr>
			    </thead>
			    <tbody>
				<tr>
  				    <td>hoihoi</td>
                                    <td>hoihoi</td>
                                    <td>hoihoi</td>
                                    <td>hoihoi</td>
				</tr>
			    <?php
			    	$result = mysql_query("SELECT u.ID 'ID', u.Voornaam 'Voornaam', u.Achternaam 'Achternaam', u.Tussenvoegsel 'Tussenvoegsel', u.Klas 'Klas' FROM Users u, Tutors t WHERE u.ID = t.Tutor");	
			    	while($row = mysql_fetch_array($result)){
				    echo "<tr><td>" . $row['Voornaam'] . "</td><td>" . $row['Tussenvoegsel'] . "</td><td>" . $row['Achternaam'] . "</td><td>" . $row['Klas'] . "</td></tr>";
				}
			    ?>
			    </tbody>
			</table>
			<script>
			    $('.ui.sortable.table').tablesort();
			</script>
   		    </div>
	    </div>
	</div>

	<!-- <div class="adminview">
	<div class="adminsidebar left">
	    <div class="adminsidebar view">
		<?php
		if(($_GET['view'] == "students") || !(isset($_GET['view']))){ ?>
		    <a href="dashboard.php?view=tutors">Tutors</a>
		<?php }
		if($_GET['view'] == "tutors"){ ?>
		    <a href="dashboard.php?view=students">Studenten</a>
		<?php } ?>
	    </div>
            <div></div>
            <div></div>
	</div>
	<div class="fill-space right">
	<?php
	if(($_GET['view'] == "students") || !(isset($_GET['view']))){ ?>
	    <h3 class="left">Studenten</h3>
	<?php } else if($_GET['view'] == "tutors"){ ?>
	    <h3 class="left">Tutors</h3>
	<div class="tablewrapper left">
	    <?php
		$query = "SELECT u.ID 'ID', u.Voornaam 'Voornaam', u.Achternaam 'Achternaam', u.Tussenvoegsel 'Tussenvoegsel', u.Klas 'Klas' FROM Users u, Tutors t WHERE u.ID = t.Tutor ORDER BY u.Voornaam ASC";
	    ?>
	    <table>
	    <tr>
		<?php if(!isset($_GET['voornaam'])){ ?>
		    <th><a href="dashboard.php?view=tutors&voornaam=desc">Voornaam )</a></th>
		<?php } else if($_GET['voornaam'] == "desc"){ ?>
		    <th><a href="dashboard.php?view=tutors&voornaam=asc">Voornaam v</a></th>
		<?php $query = "SELECT * FROM Users u, Tutors t WHERE u.ID = t.tutor ORDER BY u.Voornaam ASC";
		} else { ?>
		    <th><a href="dashboard.php?view=tutors&voornaam=desc">Voornaam ^</a></th>
		<?php $query = "SELECT * FROM Users u, Tutors t WHERE u.ID = t.tutor ORDER BY u.Voornaam DESC";
		} ?>
	
		<?php if(!isset($_GET['achternaam'])){ ?>
                    <th><a href="dashboard.php?view=tutors&achternaam=desc">Achternaam )</a></th>
                <?php } else if($_GET['achternaam'] == "desc"){ ?>
                    <th><a href="dashboard.php?view=tutors&achternaam=asc">Achternaam v</a></th>
                <?php $query = "SELECT * FROM Users u, Tutors t WHERE u.ID = t.tutor ORDER BY u.Achternaam ASC";
                } else { ?>
                    <th><a href="dashboard.php?view=tutors&achternaam=desc">Achternaam ^</a></th>
                <?php $query = "SELECT * FROM Users u, Tutors t WHERE u.ID = t.tutor ORDER BY u.Achternaam DESC";
                } ?>
		
		<?php if(!isset($_GET['klas'])){ ?>
                    <th><a href="dashboard.php?view=tutors&klas=desc">Klas )</a></th>
                <?php } else if($_GET['klas'] == "desc"){ ?>
                    <th><a href="dashboard.php?view=tutors&klas=asc">Klas v</a></th>
                <?php $query = "SELECT * FROM Users u, Tutors t WHERE u.ID = t.tutor ORDER BY u.Klas ASC";
                } else { ?>
                    <th><a href="dashboard.php?klas=desc">Klas ^</a></th>
                <?php $query = "SELECT * FROM Users u, Tutors t WHERE u.ID = t.tutor ORDER BY u.Klas DESC";
                } ?>
	
	    </tr>
	    <?php
		$result = mysql_query($query);
		while ( $row = mysql_fetch_array($result) ) {
		    echo "<tr><td>" . $row['Voornaam'] . "</td>";
		    echo "<td>" . $row['Tussenvoegsel'] . " " . $row['Achternaam'] . "</td>";	
		    echo "<td>" . $row['Klas'] . "</td></tr>";
		}
	    ?>
	    </table>
	</div>
	<?php } else {
	    echo "Geen tabel geselecteerd!";
	} ?>
	</div>
	</div> -->
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
	    </div>

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
	</div>
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
if(isset($_POST['submit-settings-email'])) {

        if($_SESSION['user'] == true) {
                if($changeemail !== '') {

                        $query = mysql_query("SELECT * FROM `Users` WHERE Email='$changeemail'") or die(mysql_error());
                        $count = mysql_num_rows($query);

                        if($count==0) {

                                $result = mysql_query("UPDATE `Users` SET Email='$changeemail' WHERE ID='$ID'");
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

    </body>
</html>
<?php }
} else {

header('Location: index.php');

}
?>
