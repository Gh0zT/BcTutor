<!DOCTYPE html>
<html>
    <head>
	<title>SEMANTIC</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- SEMANTIC -->
	<link rel="stylesheet" type="text/css" href="Semantic-UI-CSS/semantic.min.css">
	<script src="Semantic-UI-CSS/semantic.min.js"></script>
    </head>
    <body>
<div class="ui red menu">
    <h3 class="header item" href="#">SEMANTIC</h3>
    <a class="active item">tab1</a>
    <a class="active item">tab2</a>
    <a class="active item">tab3</a>
    <a class="active item">tab4</a>
</div>

<button class="ui button blue">Follow</button>


<select name="skills" multiple="" class="ui fluid dropdown">
  <option value="">Skills</option>
<option value="angular">Angular</option>
<option value="css">CSS</option>
<option value="design">Graphic Design</option>
<option value="ember">Ember</option>
<option value="html">HTML</option>
<option value="ia">Information Architecture</option>
<option value="javascript">Javascript</option>
<option value="mech">Mechanical Engineering</option>
<option value="meteor">Meteor</option>
<option value="node">NodeJS</option>
<option value="plumbing">Plumbing</option>
<option value="python">Python</option>
<option value="rails">Rails</option>
<option value="react">React</option>
<option value="repair">Kitchen Repair</option>
<option value="ruby">Ruby</option>
<option value="ui">UI Design</option>
<option value="ux">User Experience</option>
</select>
	
<script>
    $('.ui.dropdown').dropdown();
</script>
    </body>
</html>
