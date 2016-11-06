<?php

$file = "/var/www/dbconfig.php";
require('/var/www/dbconfig.php');

require 'dbconnect.php';

function UserValues() {

    $Voornaam = $_POST['Voornaam'];
    $Tussenvoegsel = $_POST['Tussenvoegsel'];
    $Achternaam = $_POST['Achternaam'];
    $Geboortedatum = $_POST['Geboortedatum'];
    $Gebruikersnaam = $_POST['Gebruikersnaam'];
    $Wachtwoord = $_POST['Wachtwoord'];
    $Email = $_POST['Email'];

}
function NewUser() {

    if($_POST['Voornaam']=='' || $_POST['Achternaam']=='' || $_POST['Geboortedatum']=='' || $_POST['Gebruikersnaam']==''|| $_POST['Wachtwoord']==''|| $_POST['Email']=='') {
        echo "Vul alstublieft de verplichte velden in!";
    }
    else {
    
        $query = "INSERT INTO `Users` (Voornaam,Tussenvoegsel,Achternaam,Geboortedatum,Gebruikersnaam,Wachtwoord,Email) VALUES ('$_POST[Voornaam]', '$_POST[Tussenvoegsel]', '$_POST[Achternaam]', '$_POST[Geboortedatum]', '$_POST[Gebruikersnaam]', '$_POST[Wachtwoord]', '$_POST[Email]')";
        $sql = mysql_query ($query) or die (mysql_error());
    
    if($sql) {
        echo "U heeft zich succesvol geregistreerd!";
    }
    else {
        echo "Er is iets misgegaan tijdens de uitvoering!";
    }
}
}

function SignUp() {
    
if(!empty($_POST['Gebruikersnaam'])) { 
   
    $query = mysql_query("SELECT * FROM `Users` WHERE Gebruikersnaam = '$_POST[Gebruikersnaam]'") or die(mysql_error());
    
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
