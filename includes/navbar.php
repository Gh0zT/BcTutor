<?php session_start(); ?>

<style>
.text-left {
    text-align: left;
}
.text-right {
    text-align: right;
}
.navbar {
    background-color: white !important;
    padding: 12px 0 12px 0;
}
.loginform {
    min-width: 280px !important;
}
.computer-only {
    display: none;
}
@media screen and (min-width: 992px) {
    .computer-only {
        display: initial;
    }
    .device-only {
	display: none;
    }
}

</style>

<!-- Mobile Sidebar -->
<div class="ui sidebar inverted vertical menu">
    <a class="item">1</a>
    <a class="item">2</a>
    <a class="item">3</a>
</div>
<script>
    function sidebar(){
        $('.ui.sidebar')
            .sidebar('toggle')
        ;
    }
</script>

<!-- Mobile Sidebar .pusher -->
<div class="pusher">
    <!-- Computer Only -->
    <div class="ui segment computer-only" style="background-color: transparent;">
        <div class="navbar ui large top fixed blue secondary pointing menu">
	    <div class="ui container">
    	        <h3 class="ui header item">BcTutor</h3>
    	        <div class="right menu">
   	            <a href="dashboard.php" class="<?php if($page == 'home'){ echo 'active '; } ?>item">Home</a>
        	    <a href="bijles_geven.php" class="<?php if($page == 'bijlesgeven'){ echo 'active '; } ?>item">Bijles geven</a>
        	    <a href="bijles_krijgen.php" class="<?php if($page == 'bijleskrijgen'){ echo 'active '; } ?>item">Bijles krijgen</a>
		<?php
		    if(isset($_SESSION['user']) && ($_SESSION['user'] == true)) {
		?>
		<a class="item item2">
		    Welkom <?php echo $_SESSION['user']; ?>
		    <i class="dropdown icon"></i>
		</a>
                <div class="ui popup">
                    <div class="item">Status</div>
                    <div class="item"><a href="logout.php">Uitloggen</a></div>
                </div>

		</div>
		<?php } else { ?>
		    <a class="item3 item"></>
			Log in
			<i class="dropdown icon"></i>
		    </a>
		<div class="ui popup loginform">
		    <form class="ui blue form">
		        <h4 class="ui dividing header">Log in</h4>
			<div class="field text-left">
			    <label>Gebruikersnaam</label>
			    <input type="text" name="myusername" placeholder="Gebruikersnaam">
			</div>
			<div class="field text-left">
			    <label>Wachtwoord</label>
			    <input type="password" name="mypassword" placeholder="Wachtwoord">
			</div>
			<div class="field">
			    <div class="ui fluid blue submit button">Log in</div>
			</div>
			<div class="field">
			    <p>Nog geen account? <a href="#">Registreren</a></p> 	
			</div>
		    </form>
		</div>
		</div>
		<?php
		    }
		?>
            </div>
	</div>
    </div>
</div>

<script>
$('.item3')
  .popup({
    inline : false,
    hoverable : true,
    delay: {
      show: 50,
      hide: 400
    }
  })
;
$('.item2')
  .popup({
    inline     : true,
    hoverable  : true,
    position   : 'bottom left',
    delay: {
      show: 50,
      hide: 400
    }
  })
;
</script>

