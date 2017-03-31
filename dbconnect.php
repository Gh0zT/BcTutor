<?php

//dbconfig importeren
$file = "../../dbconfig.php";
require($file);

//maak verbinding met database en geef error als dit niet lukt
$conn = mysql_connect($host, $username, $password) or die("Unable to connect: " . mysql_error());

//selecteer de juiste database: BcTutorDB
$database = mysql_select_db("BcTutorDB", $conn) or die(mysql_error());

?>
