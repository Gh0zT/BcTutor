<?php session_start(); ?>

<!DOCTYPE html>

<?php

require '../../dbconfig.php';
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
    position: absolute;
    height: 700px !important;
    width: 100% !important;
    background-size: cover !important;
    background-image: url('/source/images/header.jpg') !important;
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
    
	<div class="jumbotron">
	    <div class="ui vertical masthead segment" style="padding: 90px 0 40px 0;">
            	<div class="ui container page-header">
			<div class="ui segment login">
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
				   <div class="ui error message"></div>
				   <button class="ui button blue" name="submit-login" type="submit">Inloggen</button>
				   </form>
                        	<p>Nog geen BcTutor account?</p>

				   <div class="registerform">
                        		<p>
						<a class='openRegister'>Account aanmaken</a>
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
  						   <!--<button class="ui button blue" type="submit" name="submit-registration">Registreer</button>-->
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
				   <div>
                        		<p>Wachtwoord vergeten?</p>
                        		<p><a href="">Wachtwoordherstel</a></p>
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

