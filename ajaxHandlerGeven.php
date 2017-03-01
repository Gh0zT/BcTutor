<?php

session_start();
require '../../dbconfig.php';
require 'dbconnect.php';

		$hoofdvak = $_POST['hoofdvak']; //string
                $vakken = $hoofdvak;
                if(isset($_POST['extravakken'])){
                    $extravakken = $_POST['extravakken']; //array
                    array_push($extravakken, $hoofdvak);
                    $vakken = $extravakken;
                }
                $userid = $_SESSION['ID']; //string
		$date = date('Y-m-d H:i:s');
		
		$result = mysql_query("SELECT Tutoraanmeldingen.Vak AS taVak
		  		       FROM Tutoraanmeldingen 
				       WHERE Tutoraanmeldingen.ID='$userid' 
				       UNION ALL
				       SELECT Tutors.Vak AS tVak	
				       FROM Tutors
				       WHERE Tutors.ID='$userid' ");

		if(isset($_POST['extravakken'])){
		    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			foreach($vakken as $key => $vak){
			    if(($row['tVak'] == $vak) || ($row['taVak'] == $vak)){
				unset($vakken[$key]);
			    }
			}
		    }
		    foreach($vakken as $vak) {
			mysql_query("INSERT INTO Tutoraanmeldingen (ID, Vak, Datum, Keuze) VALUES ('$userid', '$vak', '$date', 'Tutor')");
		    }
		} else {
		    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			if(($row['tVak'] == $vakken) || ($row['taVak'] == $vakken)){
                            break 3;
			}
		    }
		    mysql_query("INSERT INTO Tutoraanmeldingen (ID, Vak, Datum, Keuze) VALUES ('$userid', '$hoofdvak', '$date', 'Tutor')");
		}
?>
