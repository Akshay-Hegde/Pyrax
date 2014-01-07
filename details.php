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
				'en' => 'Ajaxify your entire site with Mustache templates.',
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