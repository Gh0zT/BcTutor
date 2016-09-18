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
                    <p>Log in met je magister leerlingnummer</p>

                    <input autofocus="autofocus" name="magisteruser" type="text" placeholder="leerlingnummer">
                    <input name="magisterpassword" type="password" placeholder="wachtwoord">

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
                
                <form id="normal-login" action="login.php" class="login-form">
                    <p>Log in met je BcTutor account</p>

                    <input autofocus="autofocus" name="username" type="text" placeholder="gebruikersnaam / e-mailadres">
                    <input name="password" type="password" placeholder="wachtwoord">

                    <input checked="checked" type="checkbox" id="rememberme" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="margin-reset right" type="submit">Inloggen</button><br>
                    
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
                
                <button type="submit" id="change-logintype">Log in met je BcTutor account</button>
                
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
