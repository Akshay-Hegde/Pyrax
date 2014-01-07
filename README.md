Pyrax
=====

PyroCMS + AJAX

## Installation

1. Put the module in addons/shared_addons/modules.
2. In Admin, go to Addons and enable the module.
3. In your module or theme, create a folder named "templates" inside the "views" folder.


### Usage

For ajax pages or ajax parts of pages, create a template in your templates folder. It can look like this:

	<script id="template_<?=basename(__FILE__, '.php');?>" type="text/mustache-template">
		
		<!-- Here goes your HTML -->
		
	</script>

Make sure you're familiar with PyroCMS' Template Library:
http://docs.pyrocms.com/2.2/manual/developers/tools/template-library

If you want to use Ajax on a certain page, don't use the Template Library of PyroCMS to set() and build() your view, but use pyrax to set() and build() a template. Like this:

$this->pyrax->set($data)->build('example');

If you want to use append_js() or any other, you can still do that. This is possible for example:

$this->template->prepend_metadata('<script src="/js/jquery.js"></script>');
$this->pyrax->set($data)->build('example');