<?php session_start(); ?>

<html>
	<head>
		<title>TestPagina</title>
		<link rel="stylesheet" type="text/css" href="style/style.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        	<meta charset="UTF-8">
	</head>

	<body>

        <?php include 'includes/navbar.php'; ?>

	<div>
	<?php

	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {

		header('Location: index.php');
		exit();
	}
	else {

		echo 'Login succesvol! Welkom terug ' . $_SESSION['user'] . ' !';
	}

	?>
	</div>
	</body>
</html>
