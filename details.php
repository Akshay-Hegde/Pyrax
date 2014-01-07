<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Pyrax Module
 *
 * @author Ben Rogmans
 */
class Module_Pyrax extends Module {

	public $version = '1.0.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Pyrax',
			),
			'description' => array(
				'en' => 'Pyrax helps you to ajaxify your site. Fast, clean and super easy to use. Needs jQuery to be included somewhere!',
			),
			'frontend' => false,
			'backend'  => false,
			'skip_xss' => false,
		);
	}


	public function install() {
		return true;
	}


	public function uninstall() {
		return true;
	}


	public function upgrade($old_version) {
		return true;
	}
}