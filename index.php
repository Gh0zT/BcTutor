<!DOCTYPE html>
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

        <div id="content">
            <h2 id="caption">Hier komt een fancy slogan die je onder andere<br> aanmoedigd om je aan te melden voor de site!</h2>
            
            <div id="login-box">
                <h3 class="login-caption">Login</h3>

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
                            <td><a href="register.html" class="left">Account aanmaken</a></td>
                            <td><a href="forgot-pass.php" class="right">Wachtwoordherstel</a></td>
                        </tr>
                    </table>
                </form>

                <div class="divider"></div>
                
		<input onclick="change()" type="button" value="Log in met je BcTutor account" id="change-logintype"></input>

		<script>
			function change() {
    				var elem = document.getElementById("change-logintype");
    				if (elem.value=="Log in met je BcTutor account") elem.value = "Log in met je Magister account";
    				else elem.value = "Log in met je BcTutor account";
			}		
 		</script>

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
                                $("#magister-login").fadeOut(500, function() {
                                    $("#normal-login").fadeIn(500, function() {
                                        $busy = 0;
                                    });
                                });
                                $loginType = 2;
                            } else {
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
