<nav>
    <div class="wrapper">
        <h1 class="logo left">BcTutor</h1>
        <ul class="right reset-margin text-align-right">
            <li><a href="bijles_geven.php">Bijles geven</a></li><!--
            --><li><a href="bijles_krijgen.php">Bijles krijgen</a></li><!--
            --><li><a href="settings.php">Instellingen</a></li>
            <?php 
                if(isset($_SESSION['user']) && ($_SESSION['user'] == true)) {
                        echo '<li><a href="logout.php">Logout</a></li>'; 
                }
            ?>
        </ul>
    </div>
</nav>

