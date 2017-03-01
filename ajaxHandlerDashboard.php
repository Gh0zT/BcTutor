<?php

session_start();
require '../../dbconfig.php';
require 'dbconnect.php';

if(isset($_POST['checkbox'])){
    $result = mysql_query("SELECT Tutoraanmeldingen.ID, Tutoraanmeldingen.Vak, Tutoraanmeldingen.Keuze, Tutoraanmeldingen.Datum
		  	   FROM Tutoraanmeldingen
			   WHERE Tutoraanmeldingen.ID IN (" . implode(",",$_POST['checkbox']) . ")
			   UNION ALL
			   SELECT Leerlingaanmeldingen.ID, Leerlingaanmeldingen.Vak, Leerlingaanmeldingen.Keuze
			   FROM Leerlingaanmeldingen
			   WHERE Leerlingaanmeldingen.ID IN (" . implode(",",$_POST['checkbox']) . ")");
    
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	if($row['Keuze'] == "Tutor"){
	    mysql_query("INSERT INTO Tutors (Tutors.ID, Tutors.Vak, Tutors.Datum) VALUES ($row['ID'], $row['Vak'], $row['Datum'])");
	}
	if($row['Keuze'] == "Leerling"){
	    
	}
    }
}


?>
