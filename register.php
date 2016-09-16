<?php

Include('../../dbconfig.php')
Include('dbconnect.php')

function NewUser() {
    
    $Voornaam = $_POST['Voornaam'];
    $Tussenvoegsel = $_POST['Tussenvoegsel'];
    $Achternaam = $_POST['Achternaam'];
    $Leeftijd = $_POST['Leeftijd'];
    $Gebruikersnaam = $_POST['Gebruikersnaam'];
    $Wachtwoord = $_POST['Wachtwoord'];
    $Email = $_POST['Email'];
    
    if($_POST['Voornaam']=='' || $_POST['Achternaam']=='' || $_POST['Leeftijd']=='' || $_POST['Gebruikersnaam']==''|| $_POST['Wachtwoord']==''|| $_POST['Email']=='') {
        echo "Vul alstublieft de verplichte velden in!";
    }
    else {
    
        $query = "INSERT INTO registration (Voornaam,Tussenvoegsel,Achternaam,Leeftijd,Gebruikersnaam,Wachtwoord,Email) VALUES ('Voornaam', 'Tussenvoegsel', 'Achternaam', 'Leeftijd', 'Gebruikersnaam', 'Wachtwoord', 'Email')";
        $sql = mysql_query ($query) or die (mysql_error());
    
    if($sql) {
        echo "U heeft zich succelvol geregistreerd!"
    }
    else {
        echo "Er is iets misgegaan tijdens de uitvoering!"
    }
}

function SignUp() {
    
if(!empty($_POST['Gebruikersnaam'])) { 
    
    $query = mysql_query("SELECT * FROM registration WHERE Gebruikersnaam = '$_POST[Gebruikersnaam]' AND Wachtwoord = '$_POST[Wachtwoord]'") or die(mysql_error());
    
    if(!$row = mysql_fetch_array($query) or die(mysql_error())) {
        
        NewUser(); 
    } 
    
    else { 
        echo "Sorry, U bent al geregistreed!"; 
    } 
} 
}
       
if(isset($_POST['submit-registration'])) {
    
    SignUp();
}
?>
