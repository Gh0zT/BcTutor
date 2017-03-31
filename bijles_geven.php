<!DOCTYPE html>
<html>

<?php session_start();

require '../../dbconfig.php';
require 'dbconnect.php';

if(!($_SESSION['logged_in'] == true)) {
	header("Location: index.php");
} else { ?>

    <head>
        <title>BcTutor</title>

	<!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- SEMANTIC UI -->
        <link rel="stylesheet" type="text/css" href="Semantic-UI-CSS/semantic.min.css">
        <script src="Semantic-UI-CSS/semantic.min.js"></script>

	<!-- STYLE & FONTS -->
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <meta charset="UTF-8">

	<?php $page = bijlesgeven; ?>
     </head>

    <body>
        <?php include 'includes/navbar.php'; ?>

    <div class="ui vertical segment" style="padding: 90px 0 40px 0;">
	<div class="ui container">
            <div class="ui blue three large steps">
                <div class="step">
                    <i class="add user icon"></i>
		    <div class="content">
			<div class="title">Aanmelden</div>
                        <div class="description">Lijkt het je leuk om bijles te geven en wil je wat bijverdienen? Meld je dan hieronder aan! Check wel eerst even de vereisten!
			</div>
		    </div>
                </div>
		<div class="step">
                    <i class="talk icon"></i>
                    <div class="content">
                    	<div class="title">Gesprek</div>
                        <div class="description">Nadat je je hebt aangemeld word je uitgenodigd voor een gesprek. Hierbij wordt gekeken of je geschikt bent om bijles te geven.
			</div>
		    </div>
                </div>
		<div class="step">
                    <i class="student icon"></i>
                    <div class="content">
			<div class="title">Bijles geven</div>
                    	<div class="description">Zodra iemand zich aanmeldt om bijles te krijgen in het vak dat jij gekozen hebt, kan je beginnen! Je verdient 5 euro per uur en de school stelt een ruimte voor je beschikbaar!
		    	</div>
		    </div>	
                </div>
            </div>
	</div>
    </div>

    <div class="ui vertical segment" style="padding: 0px 0px 60px 0px;">
            <div class="grid2" type="button">
                <?php
                    $result = mysql_query("SELECT * FROM `Vakken` ORDER BY Vak");
                    while($row = mysql_fetch_assoc($result, MYSQL_ASSOC)) { ?>
			<div class='tile-wrapper'>
			    <div class='tile' style='background-image: url(source/images/vakken/<?php echo $row['Afbeelding']; ?>)'>
				<p>
				    <a><?php echo $row['Vak']; ?></a>
				</p>
				<span class="id hide"><?php echo $row['ID']; ?></span>
				<span class="afbeelding hide"><?php echo $row['Afbeelding']; ?></span>
				<span class="vak hide"><?php echo $row['Vak']; ?></span>
			   </div>
			</div>
			<?php
                   }
		?>
		<div style="clear: both"></div>
		
<script>
		//wait for page to load 
		$(document).ready(function(){
			
                    $('.tile').click(function() {
			
			//get variables from clicked tile
			var id = $(this).children('span.id').html();
			var afbeelding = $(this).children('span.afbeelding').html();
			var vak = $(this).children('span.vak').html();

			//set variables in the modal
			$('span.addvak').html(vak);
			var src = "/source/images/vakken/" + afbeelding;
			$('img.addafbeelding').attr("src", src);
			$('.addid').attr("value", id); 
			
			//simple ajax call
			/*$.post('bier.php', { 'id2' : id },
			  function(returnedData){
			    console.log(returnedData);
			  }
			);*/

			//variables are set, now open modal
                        $('#modalbijlesgeven')
                          .modal({
			    allowMultiple: true,
                            onDeny : function(){
			      $("#modalconfirm")
			      .modal({
                                allowMultiple: true,
                                onDeny : function(){},
                                onApprove : function (){
                                  $("#modalbijlesgeven").modal('hide');
                                }
                              })
                              .modal('setting', 'closable', false)
                              .modal('setting', 'transition', 'scale')
                              .modal('show');
                              return false;

                            },
                            onApprove : function(){
			      return false;
                            }
                          })
			.modal('setting', 'closable', false)
                        .modal('setting', 'transition', 'scale')
                        .modal('show');

                    });
		    
                    $('.dropdown')
                        .dropdown({
                            maxSelections: 5,
                            forceSelection: false
                        })
                    ;
                });
</script>
		<div class="ui small modal" id="modalconfirm">
		    <div class="header">Aanmelding voor bijles geven annuleren</div>
		    <div class="content">
			<p>Weet je zeker dat je je aanmelding wil annuleren?</p>
		    </div>
		    <div class="actions">
                          <div class="ui red cancel hide labeled icon button" name="annuleren" id="annuleren">
                              Niet annuleren
                              <i class="remove icon"></i>
                          </div>
                          <div class="ui green positive right labeled icon button" name="submit-bijlesgeven" id="submit-bijlesgeven">
                              Annuleer
                              <i class="checkmark icon"></i>
                          </div>
                      </div>
		</div>

		<div class="ui modal" id="modalbijlesgeven">
                    <div class="header">Aanmelden om bijles te geven in <span class="addvak"></span></div>
                        <div class="image content">
                            <div class="ui large image">
                                <img class="addafbeelding" src="">
                            </div>
                            <div class="description" style="width: 100%;">
                                <div class="container">
				    <div class="container fadecontainer invisible">
					<div class="ui active inverted dimmer" style="border-radius: 8px;">
    					    <div class="ui text loader">Bedankt voor je aanmelding! Je wordt doorverwezen naar het dashboard.</div>
  					</div>
				    </div>
                                    <form class="ui form" id="aanmeldingBijlesGeven" method="POST">
                                        <div class="field">
					    <input class="addid" type="hidden" name="hoofdvak" value="">
                                            <input type="text" style="position: fixed; left: -10000000px;" disabled/>
                                            <label class="fluid">Selecteer hier eventueel een extra vak</label>
                                            <select multiple="" class="ui fluid search dropdown" name="extravakken[]" data-validate="extravakken">  
                                                <option value="">Geen</option>
                                                <?php
                                                    $result2 = mysql_query("SELECT v.Vak 'vak', v.ID 'ID' FROM Vakken v ORDER BY v.Vak");
                                                    while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                                                        echo "<option value=\"" . $row2['ID'] . "\">" . $row2['vak'] . "</option>";
                                                    }
                                                ?>
                                            </select>
					</div>
                                            <div class="ui message">
                                                <div class="header">
                                                    Vereisten om bijles te geven
                                                </div>
                                                <ul class="list">
                                                    <li>Je moet minimaal een 7 gemiddeld staan voor het vak waarin je bijles wilt geven. Je moet vorig jaar ook met dit gemiddelde hebben afgesloten.</li>
                                                    <li>Je moet geduldig zijn en goed kunnen uitleggen.</li>
                                                    <li>Je moet je goed kunnen inleven in de problemen van de leerling met betrekking tot dat vak.</li>
                                                    <li>Je moet gedurende deze periode ook op "overgaan" blijven staan.</li>
                                                </ul>
                                            </div>
					    <div class="field">
                                                <div class="ui checkbox">
                                                    <input type="checkbox" name="terms">
                                                    <label>Ik voldoe aan deze eisen</label>
                                                </div>
					   </div>
				       <div class="ui error message"></div>    
                                   </form>
<script>
$('#aanmeldingBijlesGeven')
  .form({
    fields: {
      extravakken: {
        identifier: 'extravakken',
	optional: true,
        rules: [
          {
            type     : 'empty',
	    prompt   : 'Error, neem contact op met de makers'  
          }
        ]
      },  
      terms: {
        identifier: 'terms',
        rules: [
          {
            type   : 'checked',
            prompt : 'Je moet voldoen aan de gestelde eisen'
          }
        ]
      }
    },
    onSuccess : function(e){
      var form = $('#aanmeldingBijlesGeven');

      $.ajax({
        type: "POST",
        url: 'ajaxHandlerGeven.php',
        data: form.serialize(),
        success: function( response ) {
      	  console.log(response);
        }
      });

      $('#aanmeldingBijlesGeven').addClass('invisible');
      $('.fadecontainer').removeClass('invisible');
      setTimeout("window.location.href = 'index.php';", 2000);
    }
  })
;
</script>
                               </div>
                          </div>
                      </div>
                      <div class="actions">
                          <div class="ui red cancel hide labeled icon button">
                              Annuleren
                              <i class="remove icon"></i>
                          </div>
                          <button name="postBijlesGeven" id="submit-formding" form="aanmeldingBijlesGeven" value="Submit" class="ui green ok right labeled icon button" type="submit">
                              Opslaan
                              <i class="checkmark icon"></i>
                          </button>
                      </div>
                  </div>
		</div>
            </div>
	</div>
	<?php include 'includes/footer.php' ?>
    </body>
<script>
$('#submit-formding').click(function() {
    $('#aanmeldingBijlesGeven').submit(function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
    });
});
$('#aanmeldingBijlesGeven').submit(function(e){ 
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});
</script>
</html>
<?php } ?>
