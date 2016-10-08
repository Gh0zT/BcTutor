<nav>
    <div class="wrapper">
        <h1 id="logo">BcTutor</h1>
        <ul>
            <li><p><a href="bijles_geven.php">Bijles geven</a></p></li>

            <li><p><a href="bijles_krijgen.php">Bijles krijgen</a></p></li>

            <li><p><a href="settings.php">Instellingen</a></p></li>

	<?php
	if(isset($_SESSION['user']) && ($_SESSION['user'] == true)) {
                echo '<li><p><a href="logout.php">Logout</a></p></li>';
        }
	?>

        </ul>
    </div>
</nav>

