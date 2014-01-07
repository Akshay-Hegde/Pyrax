<?php
foreach (glob($templatesPath.'*.php') as $filename) :
    include $filename;
endforeach;
?>
<div id="applicationView">
<!-- This is where the magic happens -->
</div>
<script>
// Initialize application
$(document).ready(function(){
	var $myApplication = AjaxApplication(<?=$this->config->item('pyrax:ajaxify') ? 'true' : 'false';?>, 
										'applicationView',
										'<?=rawUrlEncode(json_encode($appview));?>');
});
</script>