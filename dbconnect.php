<?php

$file = "/var/www/dbconfig.php";
require($file);

$conn = mysql_connect($host, $username, $password) or die("Unable to connect: " . mysql_error());
echo "Succesfully connected to $dbname at $host";

$database = mysql_select_db("BcTutorDB", $conn) or die(mysql_error());

?>
