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

                if(isset($_POST['extravakken'])){
                $sql = "SELECT v.Tutoraanmeldingen 'Tutoraanmeldingen', v.ID 'ID' FROM Vakken v WHERE v.ID IN (" . implode(',',$vakken) . ")";
                } else {
                $sql = "SELECT v.Tutoraanmeldingen 'Tutoraanmeldingen', v.ID 'ID' FROM Vakken v WHERE v.ID='$hoofdvak'";
                }
                $result = mysql_query($sql);
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                        $matchFound = false;
                        $ids = explode(',',$row['Tutoraanmeldingen']);

                        foreach($ids as $id){
                                if($id == $userid){
                                        $matchFound = true;
                                }
                        }

                        if($matchFound == false){
                                $updatedCell = '';
                                if(!empty($row['Tutoraanmeldingen'])){
                                    $updatedCell = $row['Tutoraanmeldingen'] .  "," . $userid;
                                }else{
                                    $updatedCell = $userid;
                                }
                                $sql2 = "UPDATE Vakken v SET v.Tutoraanmeldingen='$updatedCell' WHERE v.ID='" . $row['ID'] . "'";
                                $result2 = mysql_query($sql2);
                        }
                }

?>

