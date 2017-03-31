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

	<style>
	    .column > .segment {
		height: 100%;
    	    }
	</style>

    </head>

    <body>
        <?php include 'includes/navbar.php'; ?>
	
	<div class="ui center aligned container" style="margin-top: 90px;">
 		<h2 class="header">Dashboard</h2>
		<br>
	</div>
	
	<?php
	    $ID = $_SESSION['ID'];
	    $sql = "SELECT * FROM `Users` WHERE ID='$ID'";
	    $result = mysql_query($sql);
	    $row = mysql_fetch_array($result);
	?>
	<div class="ui equal height grid container">
		<div class="eight wide column">
			<div class="ui padded blue segment">
	<h3 class="ui header">Algemene informatie</h3>
	<?php    

	    echo "<p>Welkom op BcTutor " . $row['Voornaam'] . " " . $row['Tussenvoegsel'] . " " . $row['Achternaam'] . "</p>";
	    echo "<p>Je zit nu in " . $row['Niveau'] . " " . $row['Leerjaar'] . ", " . $row['Klas'] . "</p>";
	?>
			</div>
		</div>

	<?php
	 	$result_ta = mysql_query(" SELECT ta.ID, ta.Vak, ta.Datum, ta.Keuze, Vakken.Vak FROM Tutoraanmeldingen AS ta JOIN Vakken ON ta.Vak = Vakken.ID  WHERE ta.ID = '$ID' ");
					
		$result_la = mysql_query(" SELECT la.ID, la.Vak, la.Datum, la.Keuze, Vakken.Vak FROM Leerlingaanmeldingen AS la JOIN Vakken ON la.Vak = Vakken.ID WHERE la.ID = '$ID' ");

	        $result_t = mysql_query(" SELECT t.ID, t.Vak, t.Datum, Vakken.Vak FROM Tutors AS t JOIN Vakken ON t.Vak = Vakken.ID WHERE t.ID = '$ID' ");
                                         
		$result_l = mysql_query(" SELECT l.ID, l.Vak, l.Datum, Vakken.Vak FROM Leerlingen AS l JOIN Vakken ON l.Vak = Vakken.ID WHERE l.ID = '$ID' ");

		$result_mt = mysql_query(" SELECT mt.Tutor, mt.Leerling, mt.Vak, Vakken.Vak, Users.Voornaam, Users.Tussenvoegsel, Users.Achternaam, Users.Klas FROM Matches AS mt JOIN Vakken ON mt.Vak = Vakken.ID JOIN Users ON mt.Leerling = Users.ID WHERE mt.Tutor = '$ID' ");

		$result_ml = mysql_query(" SELECT ml.Tutor, ml.Leerling, ml.Vak, Vakken.Vak, Users.Voornaam, Users.Tussenvoegsel, Users.Achternaam, Users.Klas FROM Matches AS ml JOIN Vakken ON ml.Vak = Vakken.ID JOIN Users ON ml.Tutor = Users.ID WHERE ml.Leerling = '$ID' ");


	        $num_rows_ta = mysql_num_rows($result_ta);
	        $num_rows_la = mysql_num_rows($result_la);
	        $num_rows_t = mysql_num_rows($result_t);
                $num_rows_l = mysql_num_rows($result_l);
	        $num_rows_mt = mysql_num_rows($result_mt);
	        $num_rows_ml = mysql_num_rows($result_ml);

	?>
		<div class="eight wide column">
			<div class="ui padded blue segment">
	<h3 class="ui header">Bijles Geven</h3>
	<?php
	     if (($num_rows_ta == 0) && ($num_rows_t == 0) && ($num_rows_mt == 0)) {
                 echo "Je staat nog niet ingeschreven als tutor! <br />";
		 echo "Schrijf je snel in door naar de kopjes hierboven te navigeren!";
             }
             if ($num_rows_ta > 0) {
                 echo "Je staat reeds geregistreerd als een tutor!<br/ >";
		 echo "Echter ben je nog in afwachting op een goedkeuring!<br />";
		 echo "Je staat in de volgende vakken geregistreerd als tutor:<br /><br />";
		 while ($row_ta = mysql_fetch_array($result_ta, MYSQL_ASSOC)){
		     echo "<div class='ui blue horizontal label'>" . $row_ta['Vak'] . "</div>";
		 }
		 echo "<br /><br />";
       	     }
	     if ($num_rows_t > 0) {
                 echo "Je bent goedgekeurd als een tutor!";
                 echo "<br />Het is nu afwachten tot dat je gekoppeld wordt!";
                 echo "<br />Je staat in de volgende vakken geregistreerd als tutor:<br /><br />";
                 while ($row_t = mysql_fetch_array($result_t, MYSQL_ASSOC)){
                     echo "<div class='ui blue horizontal label'>" . $row_t['Vak'] . "</div>";
                 }
                 echo "<br /><br />";
             }
             if ($num_rows_mt > 0) {
                while ($row_mt = mysql_fetch_array($result_mt, MYSQL_ASSOC)) {
                    echo "Je geeft al bijles in het vak " . $row_mt['Vak'] . " aan " . $row_mt['Voornaam'] . " " . $row_mt['Tussenvoegsel'] . " " . $row_mt['Achternaam'] . " uit " . $row_mt['Klas'] . "!<br /><br />";
                }
             }
	?>		</div>
		</div>
	<div class="eight wide column">
		<div class="ui padded blue segment">
	<h3 class="ui header">Bijles Krijgen</h3>
	<?php
             if (($num_rows_la == 0) && ($num_rows_l == 0) && ($num_rows_ml == 0)) {
                 echo "Je staat nog niet ingeschreven als leerling! <br />";
                 echo "Schrijf je snel in door naar de kopjes hierboven te navigeren!";
             }
             if ($num_rows_la > 0) {
                 echo "Je staat reeds geregistreerd als een leerling!<br />";
                 echo "Echter ben je nog in afwachting op een goedkeuring!<br />";
		 echo "Je staat in de volgende vakken geregistreerd als leerling:<br /><br />";
                 while ($row_la = mysql_fetch_array($result_la, MYSQL_ASSOC)){
                     echo "<div class='ui blue horizontal label'>" . $row_la['Vak'] . "</div>";
		 }
		 echo "<br /><br />";
             }
             if ($num_rows_l > 0) {
                 echo "Je bent goedgekeurd als een leerling!";
                 echo "<br />Het is nu afwachten tot dat je gekoppeld wordt!";
		 echo "<br />Je staat in de volgende vakken geregistreerd als leerling:<br /><br />";
                 while ($row_l = mysql_fetch_array($result_l, MYSQL_ASSOC)){
                     echo "<div class='ui blue horizontal label'>" . $row_l['Vak'] . "</div>";
                 }
		 echo "<br /><br />";
             }
	     if ($num_rows_ml > 0) {
		while ($row_ml = mysql_fetch_array($result_ml, MYSQL_ASSOC)) {
                echo "Je krijgt al bijles in het vak " . $row_ml['Vak'] . " van  " . $row_ml['Voornaam'] . " " . $row_ml['Tussenvoegsel'] . " " . $row_ml['Achternaam'] . " uit " . $row_ml['Klas'] . "!<br /><br />";
                }
	     }
	?>		
			</div>
		</div>

                <div class="eight wide column">
			<div class="ui padded blue segment">
		<h3 class="ui header">Instellingen</h3>

                <form class="ui form login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>Gebruikersnaam aanpassen</p>
			<div class="ui small action input">
				<input type="text" name="changeusername" placeholder="Nieuwe gebruikersnaam">
                  		<button class="ui mini blue button" type="sumbit" name="submit-settings-username">Aanpassen</button>
			</div>
		</form>
			<?php
$changeusername = $_POST['changeusername'];
$ID = $_SESSION['ID'];
if(isset($_POST['submit-settings-username'])) {

        if($_SESSION['user'] == true) {
                if($changeusername !== '') {

                        $query = mysql_query("SELECT * FROM `Users` WHERE Gebruikersnaam='$changeusername'") or die(mysql_error());
                        $count = mysql_num_rows($query);

                        if($count==0) {
                                $result = mysql_query("UPDATE `Users` SET Gebruikersnaam='$changeusername' WHERE ID='$ID'");
                                echo"<div class='ui small success message'><p>Aanpassingen gemaakt!</p></div>";
                        }
                        else {
                                echo"<div class='ui small error message'><p>Deze gebruikersnaam is al in gebruik!</p></div>";
                        }
                }
                else {
                        echo"<div class='ui small error message'><p>Vul alstublieft een geldige waarde in!</p></div>";
                }
        }
        else {
                echo"<div class='ui small error message'><p>U moet ingelogd zijn om aanpassingen te maken!</p></div>";
        }
}
			?>
                <form class="ui form login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>Wachtwoord aanpassen</p>
			<div class="ui small action input">
                		<input type="password" name="changepassword" placeholder="Nieuw wachtwoord">
                		<button class="ui mini blue button" type="sumbit" name="submit-settings-password">Aanpassen</button>
			</div>
		</form>
			<?php
$changepassword = $_POST['changepassword'];
$ID = $_SESSION['ID'];
if(isset($_POST['submit-settings-password'])) {

        if($_SESSION['user'] == true) {
                if($changepassword !== '') {

                        $usersession = $_SESSION['user'];
                        $query = mysql_query("SELECT Wachtwoord FROM `Users` WHERE Gebruikersnaam='$usersession'") or die(mysql_error());
                        $count = mysql_num_rows($query);
                        $result2 = mysql_fetch_array($query);

                        if($result2['Wachtwoord'] == $changepassword) {
                                echo"<div class='ui small error message'><p>Vul een nieuw wachtwoord in!</p></div>";
                                break;
                        }

                        if($count==1) {

                                $result = mysql_query("UPDATE `Users` SET Wachtwoord='$changepassword' WHERE Gebruikersnaam='$usersession'");
                                echo"<div class='ui small success message'><p>Aanpassingen gemaakt!</p></div>";
                        }
                }
                else {
                        echo"<div class='ui small error message'><p>Vul alstublieft een geldige waarde in!</p></div>";
                }
        }
        else {
                echo"<div class='ui small error message'><p>U moet ingelogd zijn om aanpassingen te maken!</p></div>";
        }
}

			?>
			</div>
                </div>
	</div>
    </body>
</html>
<?php }
} else {

header('Location: index.php');

}
?>
