<!DOCTYPE html>

<?php session_start(); ?>

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
        
        <div id="register-container">
            <div class="entry register">
                <h3 class="entry-caption">Registreer</h3>
		<div id="close-register" class="close-popup"></div>

               	<form class="login-form" method="POST" action="register.php">
                    <input type="text" name="Voornaam" placeholder="Voornaam">
                    <input type="text" name="Tussenvoegsel" placeholder="Tussenvoegsel">
                    <input type="text" name="Achternaam" placeholder="Achternaam">
                    <input type="text" name="Leeftijd" placeholder="Leeftijd">
                    <input type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam">
                    <input type="password" name="Wachtwoord" placeholder="Wachtwoord">
                    <input type="email" name="Email" placeholder="E-mail">
		    <button type="sumbit" name="submit-registration">Registreer</button>
                </form>
            </div>
            
            <script>
                $(document).ready(function(){
                    $("#register-container").hide();
                });
            
                function registerBoxAppear() {
                    $("#register-container").fadeIn(500);
                };

		$('html').click(function (e) {
   		    if (e.target.id == 'register-container') {
      			$("#register-container").fadeOut(500);
    		    }
		});
		
		$('#close-register').click(function() {
		    $("#register-container").fadeOut(500);	
		}); 
            </script>
        </div>

        <div id="content">
            <h2 id="caption">Hier komt een fancy slogan die je onder andere<br> aanmoedigd om je aan te melden voor de site!</h2>
            
            <div class="entry login">
                <h3 class="entry-caption">Login</h3>

                <form id="magister-login" action="login-magister.php" class="login-form">
                    <p>Log in met je Magister account</p>

                    <input autofocus="autofocus" name="magisteruser" type="text" placeholder="Leerlingnummer">
                    <input name="magisterpassword" type="password" placeholder="Wachtwoord">

                    <input checked="checked" type="checkbox" id="rememberme" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="margin-reset right" type="submit">Inloggen</button>
                    
                    <table>
                        <tr>
                            <td class="text-right"><p>Wachtwoord vergeten?</p></td>
                        </tr>
                        <tr>
                            <td><a target="_blank" href="https://baudartius.magister.net/#/wachtwoord-vergeten" class="right">Wachtwoordherstel</a></td>
                        </tr>
                    </table>
                </form>
                
                <form id="normal-login" action="login.php" class="login-form" method="POST">
                    <p>Log in met je BcTutor account</p>

                    <input autofocus="autofocus" name="myusername" type="text" placeholder="Gebruikersnaam / E-mailadres">
                    <input name="mypassword" type="password" placeholder="Wachtwoord">

                    <input checked="checked" type="checkbox" id="rememberme" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="margin-reset right" type="submit" name="submit-login">Inloggen</button><br>
                    
                    <table>
                        <tr>
                            <td><p>Nog geen BcTutor account?</p></td>
                            <td class="text-right"><p>Wachtwoord vergeten?</p></td>
                        </tr>
                        <tr>
                            <td><a onclick="registerBoxAppear()" href="#" class="left">Account aanmaken</a></td>
                            <td><a href="forgot-pass.php" class="right">Wachtwoordherstel</a></td>
                        </tr>
                    </table>
                </form>

                <div class="divider"></div>
                
                <button id="change-logintype">Log in met je BcTutor account</button>

                <script>
                    $(document).ready(function(){
                        $("#normal-login").hide();
                    });
                    
                    $loginType = 1;
                    $busy = 0;
                    
                    $("#change-logintype").click(function(){
                        if ($busy == 0) {
                            $busy = 1;
                            
                            if ($loginType == 1) {
                                $("#change-logintype").html('Log in met je Magister account');
                                $("#magister-login").fadeOut(500, function() {
                                    $("#normal-login").fadeIn(500, function() {
                                        $busy = 0;
                                    });
                                });
                                $loginType = 2;
                            } else {
                                $("#change-logintype").html('Log in met je BcTutor account');
                                $("#normal-login").fadeOut(500, function() {
                                    $("#magister-login").fadeIn(500, function() {
                                        $busy = 0;
                                    });
                                });
                                $loginType = 1;
                            }
                        }
                    });
                </script>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </body>
</html>
