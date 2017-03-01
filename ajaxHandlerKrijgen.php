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

                $result = mysql_query("SELECT Leerlingaanmeldingen.Vak AS laVak
                                       FROM Leerlingaanmeldingen
                                       WHERE Leerlingaanmeldingen.ID='$userid'
                                       UNION ALL
                                       SELECT Leerlingen.Vak AS lVak
                                       FROM Leerlingen
                                       WHERE Leerlingen.ID='$userid' ");

                if(isset($_POST['extravakken'])){
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                        foreach($vakken as $key => $vak){
                            if(($row['lVak'] == $vak) || ($row['laVak'] == $vak)){
                                unset($vakken[$key]);
                            }
                        }
                    }
                    foreach($vakken as $vak) {
                        mysql_query("INSERT INTO Leerlingaanmeldingen (ID, Vak, Datum, Keuze) VALUES ('$userid', '$vak', '$date', 'Leerling')");
                    }
                } else {
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                        if(($row['lVak'] == $vakken) || ($row['laVak'] == $vakken)){
                            break 3;
                        }
                  }  
                    mysql_query("INSERT INTO Leerlingaanmeldingen (ID, Vak, Datum, Keuze) VALUES ('$userid', '$hoofdvak', '$date', 'Leerling')");
                }
?>

