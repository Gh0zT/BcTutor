<!DOCTYPE HTML>
<html>
    <head>
        <title>Registreer!</title>
    </head>

    <body>
        <div>
            <fieldset><legend>Registratie</legend>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table border="0">
                        <tr>
                        <td>Voornaam</td><td> <input type="text" name="Voornaam"></td>
                        </tr>
                        <tr>
                        <td>Tussenvoegsel</td><td> <input type="text" name="Tussenvoegsel"></td>
                        </tr>
                        <tr>
                        <td>Achternaam</td><td> <input type="text" name="Achternaam"></td>
                        </tr>
                        <tr>
                        <td>Leeftijd</td><td> <input type="text" name="Leeftijd"></td>
                        </tr>
                        <tr>
                        <td>Gebruikersnaam</td><td><input type="text" name="Gebruikersnaam"></td>
                        </tr>
                        <tr>
                        <td>Wachtwoord</td><td><input type="password" name="Wachtwoord"></td>
                        </tr>
                        <tr>
                        <td>Email</td><td><input type="text" name="Email"></td>
                        </tr>
                        <tr>
                        <td><input id="button" type="submit" name="submit-registration" value="Registreer!"></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </body>
</html>

<?php

$file = "/var/www/dbconfig.php";
require($file);

require 'dbconnect.php';

function UserValues() {

    $Voornaam = $_POST['Voornaam'];
    $Tussenvoegsel = $_POST['Tussenvoegsel'];
    $Achternaam = $_POST['Achternaam'];
    $Leeftijd = $_POST['Leeftijd'];
    $Gebruikersnaam = $_POST['Gebruikersnaam'];
    $Wachtwoord = $_POST['Wachtwoord'];
    $Email = $_POST['Email'];

}
function NewUser() {

    if($_POST['Voornaam']=='' || $_POST['Achternaam']=='' || $_POST['Leeftijd']=='' || $_POST['Gebruikersnaam']==''|| $_POST['Wachtwoord']==''|| $_POST['Email']=='') {
        echo "Vul alstublieft de verplichte velden in!";
    }
    else {
    
        $query = "INSERT INTO `Register` (Voornaam,Tussenvoegsel,Achternaam,Leeftijd,Gebruikersnaam,Wachtwoord,Email) VALUES ('$_POST[Voornaam]', '$_POST[Tussenvoegsel]', '$_POST[Achternaam]', '$_POST[Leeftijd]', '$_POST[Gebruikersnaam]', '$_POST[Wachtwoord]', '$_POST[Email]')";
        $sql = mysql_query ($query) or die (mysql_error());
    
    if($sql) {
        echo "U heeft zich succelvol geregistreerd!";
    }
    else {
        echo "Er is iets misgegaan tijdens de uitvoering!";
    }
}
}

function SignUp() {
    
if(!empty($_POST['Gebruikersnaam'])) { 
   
    $query = mysql_query("SELECT * FROM `Register` WHERE Gebruikersnaam = '$_POST[Gebruikersnaam]'") or die(mysql_error());
    
    if(!$row = mysql_fetch_array($query)) {
        
        NewUser(); 
    } 
    
    else { 
        echo "Sorry, deze gebruikersnaam is al in gebruik!"; 
    } 
}
else {
	echo "Vul alstublieft de verplichte velden in!"; 
}      
}
       
if(isset($_POST['submit-registration'])) {
 
    UserValues();
    SignUp();
}
?>
