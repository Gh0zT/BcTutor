<?php

session_start();

  echo "Succesvol uitgelogd!";
  session_unset();
  session_destroy();
  header("Location: index.php");

?>
