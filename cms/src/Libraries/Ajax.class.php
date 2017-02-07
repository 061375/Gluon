<?php
namespace Gluon\Libraries;
use \Gluon\Core;
/**
 *  
 *  Ajax
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 to present 
 *
 * */
class Ajax extends Core {
    
    /**
     * validate that the function is ajax and that requirements are met
     * @param array $a a hash to compare to the database
     * @param bool if true the session will come from a user login *secure*
     * @return bool
     * */
    public function validate($a,$s = true) {
        // check if is ajax operation
        if(false === defined('ISAJAX')) {
           $this->classes['error']->set_error_message($this->messages['error']['ajax']['isajax']);
           return false;
        }
        // get hash from db
        
        // compare based on IP
        
        // if permissions check against
    }
}