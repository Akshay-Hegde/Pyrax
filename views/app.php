<div id="pyraxAppViewport">

	<!-- This is where the magic happens -->
	<!-- Content is loaded here -->

</div>
<script>
$(document).ready(function(){
	var $myApplication = new PyraxApp('pyraxAppViewport','<?=$appData;?>');
});
</script>
<?php
foreach (glob($templatesPath.'*.{html,php}', GLOB_BRACE) as $filename) :
    print '<script id="template_'.pathinfo($filename, PATHINFO_FILENAME).'" type="text/mustache-template">';
    	include_once($filename);
    print '</script>' . PHP_EOL;
endforeach;