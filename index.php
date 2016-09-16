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

        <div id="content">
            <div id="login-box">
                <h2 class="login-caption">Login</h2>

                <form action="login-magister.php" class="login-form">
                    <p>Log in met je magister leerlingnummer</p>

                    <input autofocus="autofocus" name="magisteruser" type="text" placeholder="Leerlingnummer">
                    <input name="magisterpassword" type="password" placeholder="wachtwoord">

                    <input checked="checked" type="checkbox" id="remember" name="remember_me">
                    <label for="remember">Mijn gegevens onthouden</label>

                    <button class="margin-reset right" type="submit">Inloggen</button>

                </form>

                <div class="divider"></div>

                <button type="submit">Log in met je BcTutor account</button>
            </div>
        </div>
    </body>
</html>
