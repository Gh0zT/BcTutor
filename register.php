<?php

require '../../dbconfig.php';

function xUserValues() {

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

function xNewUser() {

$query = "INSERT INTO `Users` (Voornaam,Tussenvoegsel,Achternaam,Geboortedatum,Gebruikersnaam,Wachtwoord,Email,Niveau,Leerjaar,Klas) VALUES ('$_POST[Voornaam]', '$_POST[Tussenvoegsel]', '$_POST[Achternaam]', '$_POST[Geboortedatum]', '$_POST[Gebruikersnaam]', '$_POST[Wachtwoord]', '$_POST[Email]', '$_POST[niveau]', '$_POST[leerjaar]', '$_POST[Klas]')";

 $sql = mysql_query($query);

}

function xSignUp() {

if(!empty($_POST['Gebruikersnaam'])) {

    $query = mysql_query("SELECT * FROM `Users` WHERE Gebruikersnaam = '$_POST[Gebruikersnaam]'") or die(mysql_error());

    if(!$row = mysql_fetch_array($query)) {

        xNewUser();
    }
    else {
        echo "Sorry, deze gebruikersnaam is al in gebruik!";
    }
}
}

if(isset($_POST['postRegister'])) {
    xUserValues();
    xSignUp();
}

?>

