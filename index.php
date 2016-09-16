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
            <div id="login-box">
                <h2 class="login-caption">Login</h2>

                <form id="magister-login" action="login-magister.php" class="login-form">
                    <p>Log in met je magister leerlingnummer</p>

                    <input autofocus="autofocus" name="magisteruser" type="text" placeholder="leerlingnummer">
                    <input name="magisterpassword" type="password" placeholder="wachtwoord">

                    <input checked="checked" type="checkbox" id="rememberme" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="margin-reset right" type="submit">Inloggen</button>
                </form>
                
                <form id="normal-login" action="login.php" class="login-form">
                    <p>Log in met je BcTutor account</p>

                    <input autofocus="autofocus" name="username" type="text" placeholder="gebruikersnaam / e-mailadres">
                    <input name="password" type="password" placeholder="wachtwoord">

                    <input checked="checked" type="checkbox" id="rememberme" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="margin-reset right" type="submit">Inloggen</button>
                </form>

                <div class="divider"></div>
                
                <button type="submit" id="change-logintype">Log in met je BcTutor account</button>
                
                <script>
                    $(document).ready(function(){
                        $("#normal-login").hide();
                    });
                    
                    $a = 1
                    
                    $("#change-logintype").click(function(){
                        if ($a == 1) {
                            $("#magister-login").fadeOut(500);
                            setTimeout(function() {
                                $("#normal-login").fadeIn(500);
                            }, 500);
                            $a = 2;
                        } else {
                            setTimeout(function() {
                                $("#magister-login").fadeIn(500);
                            }, 500);
                            $("#normal-login").fadeOut(500);
                            $a = 1;
                        }
                    });
                </script>
            </div>
        </div>
    </body>
</html>
