
<?php session_start(); ?>

<!DOCTYPE html>

<?php

require 'dbconnect.php';

if(!(isset($_SESSION['user'])) && !(isset($_SESSION['logged_in']))) { ?>
<html>
    <head>
        <title>BcTutor</title>
	<!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- SEMANTIC UI -->
        <link rel="stylesheet" type="text/css" href="Semantic-UI-CSS/semantic.min.css">
        <script src="Semantic-UI-CSS/semantic.min.js"></script>

        <meta charset="UTF-8">

	<?php $page = home; ?>

	<style>
.jumbotron {
    top: 0px;
    position: relative;
    height: 700px !important;
    width: 100% !important;
    background-size: cover !important;
    background-image: url('/source/images/header.jpg') !important;
    box-shadow: 0px 3px 12px #888888;
}
.page-header {
    width: 30% !important;
    float: right !important;
}
.login {
   width: 450px;
   margin-top: 100px;
}
#klasinput { 
    text-transform: uppercase;
}
::-webkit-input-placeholder { /* WebKit browsers */
    text-transform: none;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    text-transform: none;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    text-transform: none;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
    text-transform: none;
}
	</style>
    </head>

    <body>
	
        <?php include 'includes/navbar.php'; ?>
    
	<div class="jumbotron segment" style="padding: 100px 0 0 0;";>
	    <div class="ui stackable middle aligned page grid" style="height: 100%;">
		<div class="ui column sixteen wide" style="background-color: rgba(0,0,0,0.6); position: absolute; padding: 0; left: 0; right: 0; top: 55%; transform: translateY(-50%); height: 120px;">
		    <div class="ui container" class="display: table;">
			<h2 style="color: white; display: table-cell; height: 120px; vertical-align: middle;">Welkom op BcTutor, de bijlessite van het Baudartius College!</h2>
		    </div>
		</div>
		<div class="ui column ten wide"></div>
            	<div class="ui column six wide container page-header">
			<div class="ui raised top attached segment" style="background-color: #ffffff;">
			    <div class="ui header">Login</div>
		   		 <div class="ui divider"></div>
                 		   <form class="ui large form" action="login.php" method="POST">
			           <p>Log in met je BcTutor account</p>
				   <div class="field">
			    		<label>Gebruikersnaam</label>
			    		<input type="text" name="myusername" placeholder="Gebruikersnaam">
				   </div>
				   <div class="field">
                            		<label>Wachtwoord</label>
                            		<input type="password" name="mypassword" placeholder="Wachtwoord">
                        	   </div>
				   <button class="ui button blue" name="submit-login" type="submit">Inloggen</button>
                                   </form>

				   <div class="registerform" style="float: left;">
					<p style="margin: 10px 0 0 0; float: left;">Nog geen BcTutor account?</p>
                        		<p style="margin: 0;">
						<a class='openRegister' href="#" onclick="return false;">Account aanmaken</a>
					</p>
					<div class="ui blue modal" id="registerModal" role="dialog">
					   <div class="header">Registreer</div>
					   <div class="content">
					   <div class="center">
					   <form class="ui large form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="registerForm">
						<div class="three fields">
 						   <div class="required field">
    						   	<label>Voornaam</label>
    						   	<input name="Voornaam" type="text" placeholder="Voornaam">
  						   </div>
  						   <div class="field">
    						   	<label>Tussenvoegsel</label>
    						   	<input name="Tussenvoegsel" type="text" placeholder="Tussenvoegsel">
  						   </div>
						   <div class="required field">
							<label>Achternaam</label>
							<input name="Achternaam" type="text" placeholder="Achternaam">
						   </div>
						</div>
						<div class="required field">
						    <label>Geboortedatum</label>
						    <input name="Geboortedatum" type="date" placeholder="dd-mm-yyyy">
						</div>
						<div class="three fields">
						    <div class="required field">
							<label>Gebruikersnaam</label>
							<input name="Gebruikersnaam" type="text" placeholder="Gebruikersnaam">
						    </div>
						    <div class="required field">
							<label>Wachtwoord</label>
                                                        <input name="Wachtwoord" type="password" placeholder="Wachtwoord">
						    </div>
						    <div class="required field">
                                                        <label>Herhaal wachtwoord</label>
                                                        <input name="Herhaalwachtwoord" type="password" placeholder="Wachtwoord">
						    </div>
						</div>
						<div class="required field">
                                                    <label>Emailadres</label>
                                                    <input name="Email" type="text" placeholder="Emailadres">
                                                </div>
						<div class="three fields">
						    <div class="required field">
							<label>Niveau</label>
							<select name="niveau" id="list-niveau" class="ui fluid dropdown">
							    <option value="">Niveau</option>
							    <option>MAVO</option>
                            				    <option>HAVO</option>
                            				    <option>VWO</option>
							</select>
						    </div>
						    <div class="required field">
							<label>Leerjaar</label>
                        				<select name="leerjaar" id="klassenlijst" class="ui fluid dropdown">
							    <option value="">Leerjaar</option>
                            				    <option>Klas 1</option>
                            				    <option>Klas 2</option>
                            				    <option>Klas 3</option>
                            				    <option>Klas 4</option>
                            				    <option>Klas 5</option>
                            				    <option>Klas 6</option>
                        				</select>
						    </div>
						    <div class="required field">
							<label>Klas</label>
                                                        <input name="Klas" type="text" placeholder="Klas" id="klasinput">
						    </div>
						</div>
						<div class="ui error message"></div>
					   </form>
					   </div>
					   </div>
					   <div class="actions">
                          		      <div class="ui red cancel hide labeled icon button">
                              			Annuleren
                              			<i class="remove icon"></i>
                          		      </div>
                          		      <button name="postRegister" id="submit-registration" form="registerForm" value="Submit" class="ui green ok right labeled icon button" type="submit">
                              			Opslaan
                              			<i class="checkmark icon"></i>
                          		      </button>
                     			   </div>
					</div>
				   </div>
				   <div style="clear: both;"></div>
            		        </div>
				<div class="ui bottom attached segment">
         	                    <div>
                                        <p style="margin: 0;">Wachtwoord vergeten?</p>
                                       	<p><a href="">Wachtwoordherstel</a></p>
                                    </div>
	                        </div>
                	</div>
	    	</div>
	</div>
	<div class="ui vertical very padded segment" style="padding: 60px 0;">
		<div class="ui center aligned container">
			<h1>BcTutor</h1>
			<div class="ui text container">
				<p>Zit je op het Baudartius College en heb je moeite met een bepaald vak? Dan biedt BcTutor een uitkomst! Meld je hier aan om bijles te krijgen van een andere leerling van het Baudartius College die erg goed is in het vak waar je moeite mee hebt. Leerlingen begrijpen elkaar tenslotte goed en kunnen daardoor vaak de hulp bieden die je nodig hebt. De kosten van het krijgen van bijles zijn slechts 5 euro per uur en onze school zorgt voor een geschikte ruimte. Natuurlijk kun je je ook aanmelden om zelf Tutor te worden! Check hiervoor wel even de voorwaarden!</p>
			</div>
			<br><br><br>
			<h2>Hoe werkt het?</h2>
			<br>
			<div class="ui center aligned relaxed grid">
				<div class="three column row">
					<div class="column">
						<div class="segment">
							<i class="huge add user icon"></i>
							<h3>Aanmelden</h3>
							<p style="font-size: 1.14285714rem;">Meld je aan op BcTutor door op de bovenstaande knop te klikken en vul dan je gegevens in.</p>
						</div>
					</div>
					<div class="column">
						<div class="segment">
							<i class="huge checkmark box icon"></i>
							<h3>Vak(ken) kiezen</h3>
							<p style="font-size: 1.14285714rem;">Selecteer het vak / de vakken waarin je graag bijles zou willen krijgen.</p>
						</div>
					</div>
					<div class="column">
						<div class="segment">
							<i class="huge student icon"></i>
							<h3>Bijles krijgen</h3>
							<p style="font-size: 1.14285714rem;">Zodra er een geschikte tutor is gevonden kun je met je tutor een plaats en tijd afspreken.</p>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

<script>

$('#registerForm')
  .form({
    fields: {
      Voornaam: {
        identifier: 'Voornaam',
        rules: [{
          type   : 'empty',
          prompt : 'Vul alstublieft een voornaam in.'
        }]
      },
      Achternaam: {
        identifier: 'Achternaam',
        rules: [{
          type   : 'empty',
          prompt : 'Vul alstublieft een achternaam in.'
        }]
      },
      Geboortedatum: {
        identifier: 'Geboortedatum',
        rules: [{
          type   : 'empty',
          prompt : 'Vul alstublieft een geboortedatum in.'
        }]
      },
      Gebruikersnaam: {
        identifier: 'Gebruikersnaam',
        rules: [{
	  type   : 'minLength[3]',
          prompt : 'Uw gebruikersnaam moet minimaal drie karakters lang zijn.'
	}]
      },
      Wachtwoord: {
        identifier: 'Wachtwoord',
        rules: [{
          type   : 'minLength[6]',
          prompt : 'Uw wachtwoord moet minimaal zes karakters lang zijn.'
        }]
      },
      Herhaalwachtwoord: {
        identifier: 'Herhaalwachtwoord',
        rules: [{
          type   : 'match[Wachtwoord]',
          prompt : 'Uw wachtwoord komt niet overeen.'
        }]
      },
      Email: {
        identifier: 'Email',
        rules: [{
          type   : 'email',
          prompt : 'Vul alstublieft een geldig emailadres in.'
        }]
      },
      niveau: {
        identifier: 'niveau',
        rules: [{
          type   : 'empty',
          prompt : 'Kies alstublieft een niveau.'
        }]
      },
      leerjaar: {
        identifier: 'leerjaar',
        rules: [{
          type   : 'empty',
          prompt : 'Kies alstublieft een leerjaar.'
        }]
      },
      Klas: {
        identifier: 'Klas',
        rules: [{
	  type	 : 'minLength[3]',
	  prompt : 'Vul alstublieft uw hele klas in hoofdletters in.'
	}]
      }
    }
  })
;
</script>


                <div class="ui small modal" id="modalconfirm">
                    <div class="header">Registratie annuleren</div>
                    <div class="content">
                        <p>Weet je zeker dat je je registratie wil annuleren?</p>
                    </div>
                    <div class="actions">
                          <div class="ui red cancel hide labeled icon button" name="annuleren" id="annuleren">
                              Niet annuleren
                              <i class="remove icon"></i>
                          </div>
                          <button class="ui green positive right labeled icon button" id="resetform" form="registerForm" type="reset">
                              Annuleer
                              <i class="checkmark icon"></i>
                          </button>
                      </div>
                </div>
		
		<?php include 'includes/footer.php'; ?>
    </body>
</html>
<?php } else {
    header('Location: dashboard.php');
} ?>


            <script>
                $(document).ready(function(){
		  $('.openRegister').click(function() {
                    $('#registerModal')
                        .modal({
			 observeChanges: true,
			 allowMultiple: true,
			 onDeny: function(){
			   $("#modalconfirm")
			   .modal({
			    allowMultiple: true,
                                onDeny : function(){},
                                onApprove : function (){
                                  $("#registerModal").modal('hide');
			   }
			})
			.modal('setting', 'closable', false)
                          .modal('setting', 'transition', 'scale')
                          .modal('show');
                          return false;
                    },
          		onApprove : function(){
                          $('#registerModal').hide();
                              return false;
                            }
                          })
                        .modal('setting', 'closable', false)
                        .modal('setting', 'transition', 'scale')
                        .modal('show');
                  });
		});

            </script>
            <script>
                $('.ui.fluid.dropdown').dropdown();
            </script>


<?php

function UserValues() {

    $Voornaam = $_POST['Voornaam'];
    $Tussenvoegsel = $_POST['Tussenvoegsel'];
    $Achternaam = $_POST['Achternaam'];
    $Geboortedatum = $_POST['Geboortedatum'];
    $Gebruikersnaam = $_POST['Gebruikersnaam'];
    $Wachtwoord = $_POST['Wachtwoord'];
    $Email = $_POST['Email'];
    $Niveau = $_POST['niveau'];
    $Leerjaar = $_POST['leerjaar'];
    $Klas = $_POST['Klas'];

}

function NewUser() {

$query = "INSERT INTO `Users` (Voornaam,Tussenvoegsel,Achternaam,Geboortedatum,Gebruikersnaam,Wachtwoord,Email,Niveau,Leerjaar,Klas) VALUES ('$_POST[Voornaam]', '$_POST[Tussenvoegsel]', '$_POST[Achternaam]', '$_POST[Geboortedatum]', '$_POST[Gebruikersnaam]', '$_POST[Wachtwoord]', '$_POST[Email]', '$_POST[niveau]', '$_POST[leerjaar]', '$_POST[Klas]')";

 $sql = mysql_query($query);
$query2 = "UPDATE `Users` SET Klas = UPPER(Klas)";
$result2 = mysql_query($query2);
}

function SignUp() {

if(!empty($_POST['Gebruikersnaam'])) {

    $query = mysql_query("SELECT * FROM `Users` WHERE Gebruikersnaam = '$_POST[Gebruikersnaam]'") or die(mysql_error());

    if(!$row = mysql_fetch_array($query)) {

        NewUser();
    }
    else {
        echo "Sorry, deze gebruikersnaam is al in gebruik!";
    }
}
}

if(isset($_POST['postRegister'])) {
    UserValues();
    SignUp();
}

?>

<script>
$('#submit-registration').click(function() {
    $('#registerForm').submit();
});

</script>

