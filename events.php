<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Pyrax Events Class
 * 
 * @category    events
 * @author      Ben Rogmans
 */
class Events_Pyrax {
    protected $ci;
    
    public function __construct() {
        $this->ci =& get_instance();

        Events::register('public_controller', array($this, 'init'));
     }
    
    public function init()
    {
        // you can load a model or etc here if you like using $this->ci->load();
        $this->ci->load->library('pyrax/pyrax');
        return;
    }
    
}
/* End of file events.php */