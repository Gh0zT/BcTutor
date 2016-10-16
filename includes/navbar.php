<nav>
    <div class="wrapper">
        <h1 class="left reset-margin">BcTutor</h1>
        <ul class="right reset-margin text-align-right">
            <li><a href="bijles_geven.php">Bijles geven</a></li><!--
            --><li><a href="bijles_krijgen.php">Bijles krijgen</a></li><!--
            --><li><a href="settings.php">Instellingen</a></li>
            <?php 
                if(isset($_SESSION['user']) && ($_SESSION['user'] == true)) {
                        echo '<li><p><a href="logout.php">Logout</a></p></li>'; 
                }
            ?>
        </ul>
    </div>
</nav>

