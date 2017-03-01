<html>
<div>
    <p>
	<a class='mailmij'>Mail mij!</a>
    </p>
</div>
<?php

function SendEmail() {


$to      = 'mike.schopman@hotmail.com';
$subject = 'Poging1';
$message = 'Hierbij mijn eerste poging om een mail te sturen';

mail($to, $subject, $message);

}


?>

<script>
  $(document).ready(function(){
    $('.mailmij').click(function() {
	<?php SendEmail(); ?>
    }
  }
</script>

</html>
