<!DOCTYPE html>
<?php session_start();
include("register.php");
if(!(isset($_SESSION['user'])) && !(isset($_SESSION['logged_in']))) { ?>
<html>
    <head>
        <title>BcTutor</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <meta charset="UTF-8">
    </head>
    
    <body>
        <?php include 'includes/navbar.php'; ?>

        <!-- Register user popup -->
        <div class="popup">
            <div class="form-container">
                <h3>Registreer</h3>
		        <div class="close-popup"></div>
               	<form method="POST" action="register.php">
                    <input type="text" name="Voornaam" placeholder="Voornaam">
                    <input type="text" name="Tussenvoegsel" placeholder="Tussenvoegsel">
                    <input type="text" name="Achternaam" placeholder="Achternaam">
                    <input type="text" name="Geboortedatum" placeholder="Geboortedatum yyyy-mm-dd" onfocus="(this.type='date')">
                    <input type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam">
                    <input type="password" name="Wachtwoord" placeholder="Wachtwoord">
                    <input type="email" name="Email" placeholder="E-mail">

                        <select name="niveau" id="list-niveau">
                            <option>Selecteer...</option>
                            <option>MAVO</option>
                            <option>HAVO</option>
                            <option>VWO</option>
                        </select>
                        <select name="leerjaar" id="list-mavo-klassen">
                            <option>Klas 1</option>
                            <option>Klas 2</option>
                            <option>Klas 3</option>
                            <option>Klas 4</option>
                        </select>
                        <select name="leerjaar" id="list-havo-klassen">
                            <option>Klas 1</option>
                            <option>Klas 2</option>
                            <option>Klas 3</option>
                            <option>Klas 4</option>
                            <option>Klas 5</option>
                        </select>
                        <select name="leerjaar" id="list-vwo-klassen">
                            <option>Klas 1</option>
                            <option>Klas 2</option>
                            <option>Klas 3</option>
                            <option>Klas 4</option>
                            <option>Klas 5</option>
                            <option>Klas 6</option>
                        </select>
                        <script>
$(document).ready(function () {
    resetFields();
    $("#list-niveau").change(function () {
        resetFields();
    });

});
function resetFields() {
    if ($("#list-niveau").val() === "Selecteer...") {
        $("#list-mavo-klassen").hide();
        $("#list-havo-klassen").hide();
        $("#list-vwo-klassen").hide();
    } else if ($("#list-niveau").val() === "MAVO") {
        $("#list-mavo-klassen").show();
        $("#list-havo-klassen").hide();
        $("#list-vwo-klassen").hide();
    } else if ($("#list-niveau").val() === "HAVO") {
        $("#list-mavo-klassen").hide();
        $("#list-havo-klassen").show();
        $("#list-vwo-klassen").hide();
    } else if ($("#list-niveau").val() === "VWO") {
        $("#list-mavo-klassen").hide();
        $("#list-havo-klassen").hide();
        $("#list-vwo-klassen").show();
    }
}
                        </script>
		    <input style="text-transform: uppercase" type="text" name="Klas" placeholder="Klas">
		    <button type="sumbit" name="submit-registration">Registreer</button>
                </form>
		<?php SignUp(); ?>
            </div>
            <script>
                function createPopup(width, height) {
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
                            <td><a onclick="createPopup('400px', 'auto')" href="#" class="left">Account aanmaken</a></td>
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
<?php } else {
    header('Location: dashboard.php');
} ?>
