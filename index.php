<!DOCTYPE html>
<?php session_start();
if(!(isset($_SESSION['user'])) && !(isset($_SESSION['logged_in']))) { ?>
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
        
        <!-- Register user popup -->
        <div class="popup">
            <div class="form-container">
                <h3>Registreer</h3>
		        <div class="close-popup"></div>
               	<form method="POST" action="register.php">
                    <input type="text" name="Voornaam" placeholder="Voornaam" required>
                    <input type="text" name="Tussenvoegsel" placeholder="Tussenvoegsel">
                    <input type="text" name="Achternaam" placeholder="Achternaam" required>
                    <input type="text" name="Geboortedatum" placeholder="Geboortedatum yyyy-mm-dd" onfocus="(this.type='date')" required>
                    <input type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam" required>
                    <input type="password" name="Wachtwoord" placeholder="Wachtwoord" required>
                    <input type="email" name="Email" placeholder="E-mail" required>
		            <button type="sumbit" name="submit-registration">Registreer</button>
                </form>
            </div>
            <script>
                function registerBoxAppear(width, height) {
                    $(".popup").fadeIn(500);
                    $(".popup").css("display", "flex");
                    $(".form-container").css("width", width);
                    $(".form-container").css("height", height);
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

        <!-- Content -->
        <div id="content">
            <h2 id="caption">Hier komt een fancy slogan die je onder andere<br> aanmoedigd om je aan te melden voor de site!</h2>
            
            <!-- Login -->
            <div class="form-container entry right">
                <h3>Login</h3>

                <!-- Magister login (visible) -->
                <form id="magister-login" action="login-magister.php" class="login-form">
                    <p>Log in met je Magister account</p>

                    <input autofocus="autofocus" name="magisteruser" type="text" placeholder="Leerlingnummer">
                    <input name="magisterpassword" type="password" placeholder="Wachtwoord">

                    <input checked="checked" type="checkbox" id="rememberme" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="right" type="submit">Inloggen</button>
                    
                    <table>
                        <tr>
                            <td class="text-align-right"><p>Wachtwoord vergeten?</p></td>
                        </tr>
                        <tr>
                            <td><a target="_blank" href="https://baudartius.magister.net/#/wachtwoord-vergeten" class="right">Wachtwoordherstel</a></td>
                        </tr>
                    </table>
                </form>
                
                <!-- BcTutor login (hidden) -->
                <form id="normal-login" action="login.php" class="login-form" method="POST">
                    <p>Log in met je BcTutor account</p>

                    <input autofocus="autofocus" name="myusername" type="text" placeholder="Gebruikersnaam / E-mailadres">
                    <input name="mypassword" type="password" placeholder="Wachtwoord">

                    <input checked="checked" type="checkbox" id="rememberme" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="right" type="submit" name="submit-login">Inloggen</button><br>
                    
                    <table>
                        <tr>
                            <td><p>Nog geen BcTutor account?</p></td>
                            <td class="text-align-right"><p>Wachtwoord vergeten?</p></td>
                        </tr>
                        <tr>
                            <td><a onclick="registerBoxAppear('500px', 'auto')" href="#" class="left">Account aanmaken</a></td>
                            <td><a href="forgot-pass.php" class="right">Wachtwoordherstel</a></td>
                        </tr>
                    </table>
                </form>

                <div class="divider"></div>
                
                <button class="full-width" id="change-logintype">Log in met je BcTutor account</button>

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
<?php } else { ?>
<!DOCTYPE html>
<html>
    <head>
        <title>BcTutor</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body>
	<?php include 'includes/navbar.php'; ?>

	<div class="header"></div>

	<div class="wrapper">
		<p><?php echo 'Welkom ' . $_SESSION['user'] . ''; ?> op BcTutor, de bijles site van het Baudartius College! </p>

	
	</div>	
    </body>
</html>
<?php } ?>
