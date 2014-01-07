<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pyrax {

	public function __construct($params = null) {
        
        $this->ci =& get_instance();

        Asset::add_path('pyrax', base_url('addons/shared_addons/modules/pyrax').'/');
		$this->ci->template->append_js('pyrax::mustache.js');
		$this->ci->template->append_js('pyrax::history.js');
		$this->ci->template->append_js('pyrax::pyrax.js');

        $this->ci->load->config('pyrax/config');

		// Pyrax variables        
        $this->_title 	= Settings::get('site_name');
        $this->_data 	= array();
        
        
    }

    public function build($template, $data = null) {
		
		is_array($data) OR $data = (array) $data;
		$this->_data = array_merge($this->_data, $data);
		
		$data = array('data' => $this->_data);
		$data['template'] = $template;
		$data['title'] = $this->_title;
		$data['pageUrl'] = current_url();
		
		if($this->ci->input->is_ajax_request()) {
			
			print json_encode($data);
		
		} else {
		
			$appData = rawUrlEncode(json_encode($data));
		
			$this->ci->template->title($this->_title)
				->set('templatesPath', $this->ci->module_details['path'] . '/views/templates/')
				->set('appData', $appData)
				->build('pyrax/app');
		}

	}
	
	public function set($name, $value = null) {

		if (is_array($name) or is_object($name)) {
			foreach ($name as $item => $value) {
				$this->_data[$item] = $value;
			}
		} else {
			$this->_data[$name] = $value;
		}

		return $this;
	}

	public function title($title = false) {
		
		if(!$title) return $this->_title;
		
		$this->_title = $title;
		return $this;
	}
	
}

/* End of file pyrax.php */