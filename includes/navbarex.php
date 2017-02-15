<?php session_start(); ?>
<nav>
    <div class="wrapper">
        <h1 class="logo left">BcTutor</h1>
        <ul class="right reset-margin text-align-right">
	    <li><a href="index.php">Home</a></li>
            <li><a href="bijles_geven.php">Bijles geven</a></li>
            <li><a href="bijles_krijgen.php">Bijles krijgen</a></li>
	    <?php 
                if(isset($_SESSION['user']) && ($_SESSION['user'] == true)) { ?>
	    <li>
 		<a>Welkom <?php echo $_SESSION['user']; ?></a>
	        <ul class="dropdown">
		    <li><a>Status</a></li>
		    <li><a href="logout.php">Uitloggen</a></li>
              	</ul>
	    </li>
            <?php } ?>
        </ul>
    </div>
</nav>

