<!DOCTYPE html>
<html>
        <head>
                <title>BcTutor</title>
                <link rel="stylesheet" type="text/css" href="style/style.css">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
                <meta charset="UTF-8">
        </head>

        <body style="margin: 0; padding: 0; background-color: #007ee5;">

                <?php include 'includes/navbar.php'; ?>

                <div id="content">

                        <div id="login-box" style="padding: 30px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.6); border-radius: 8px; position: relative; float: right; display: block; background-color: #f6f9fc; height: 70%; width: 30%; right: 10%; top: 15%; bottom: 15%; min-width: 300px; max-width: 340px;">

                                <h2 style="position: absolute; border-radius: 8px 8px 0 0; border-bottom: 1px solid #D0D4D9; font-weight: 200; font-family: 'Open Sans', sans-serif; justify-content: center; align-items: center; text-align: center; font-size: 16pt; color: #3d464d; display: flex; height: 50pt; width: 100%; background-color: #ffffff; margin: -30px 0 0 -30px; padding: 0;">Login</h2>

                                <form action="login-magister.php" style="margin-top: 50pt;">

                                        <p style="margin-bottom: 5px;">Log in met je magister leerlingnummer</p>

                                        <input autofocus="autofocus" name="leerlingnummer" type="text" placeholder="Leerlingnummer">

                                        <input type="password" placeholder="Wachtwoord">



                                        <input style="margin-top: 5px; vertical-align: middle; position: relative; bottom: 1px;" checked="checked" type="checkbox" id="remember" name="remember_me">

                                        <label for="remember">Mijn gegevens onthouden</label>



                                        <button style="margin: -5px 0 0 0; width: 100px; float: right;" type="submit">Inloggen</button>

                                </form>
                                
                                <div class="divider"></div>
				
				                <button type="submit">Log in met je BcTutor account</button>
                        </div>
                </div>
        </body>
</html>
