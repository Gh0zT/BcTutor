<!DOCTYPE html>
<html>

<?php session_start();

require '/var/www/dbconfig.php';
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

	<?php $page = bijleskrijgen; ?>

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
                        <div class="description">Heb je hulp nodig bij een bepaald vak, omdat je het vak te moeilijk vindt of omdat je je wilt verbeteren in dat vak? Meld je dan aan door hieronder op het vak te klikken waarin jij bijles wilt krijgen.
                        </div>
                    </div>
                </div>
                <div class="step">
                    <i class="users icon"></i>
                    <div class="content">
                        <div class="title">Afwachten</div>
                        <div class="description">Zodra je je aangemeld hebt voor het desbetreffende vak, wordt er gekeken naar welke behoeften je hebt en welke persoon hier het beste aan gekoppeld kan worden. Op basis van jouw gegevens gaan we een tutor zoeken die goed bij jou past.
                        </div>
                    </div>
                </div>
                <div class="step">
                    <i class="write icon"></i>
                    <div class="content">
                        <div class="title">Bijles krijgen</div>
                        <div class="description">Zodra er een tutor beschikbaar is die we aan jou kunnen koppelen, kan je direct aan de slag. Je betaalt wel een bedrag van 5 euro per uur, maar dat zal uiteindelijk moeten gaan lonen.
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
		<div style="clear:both;"></div>

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
                        $('#modalbijleskrijgen')
                          .modal({
                            allowMultiple: true,
                            onDeny : function(){
                              $("#modalconfirm")
                              .modal({
                                allowMultiple: true,
                                onDeny : function(){},
                                onApprove : function (){
                                  $("#modalbijleskrijgen").modal('hide');
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
                    <div class="header">Aanmelding voor het krijgen van bijles annuleren</div>
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

                <div class="ui modal" id="modalbijleskrijgen">
                    <div class="header">Aanmelden om bijles te krijgen in <span class="addvak"></span></div>
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
                                    <form class="ui form" id="aanmeldingBijlesKrijgen" method="POST">
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
                                                    Vereisten om bijles te krijgen
                                                </div>
                                                <ul class="list">
                                                    <li>Je hebt hulp nodig in een bepaald vak.</li>
						    <li>Je betaald een bedrag van 5 euro per uur.</li>
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
$('#aanmeldingBijlesKrijgen')
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
    onSuccess : function(){

     var form = $('#aanmeldingBijlesKrijgen');

      $.ajax({
        type: "POST",
        url: 'ajaxHandlerKrijgen.php',
        data: form.serialize(),
        success: function( response ) {
          console.log(response);
        }
      });

      $('#aanmeldingBijlesKrijgen').addClass('invisible');
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
                          <button name="postBijlesKrijgen" id="submit-formding" form="aanmeldingBijlesKrijgen" value="Submit" class="ui green ok right labeled icon button" type="submit">
                              Opslaan
                              <i class="checkmark icon"></i>
                          </button>
                      </div>
                  </div>
                </div>
            </div>
        </div>
	<?php include 'includes/footer.php'; ?>
    </body>
<script>
$('#submit-formding').click(function() {
    $('#aanmeldingBijlesKrijgen').submit();
	e.preventDefault();
	e.stopImmediatePropagation();
});
$('#aanmeldingBijlesKrijgen').submit(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});
</script>


</html>
<?php } ?>


