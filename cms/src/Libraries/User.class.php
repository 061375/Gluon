<?php
namespace Gluon\Libraries;
use \Gluon\Libraries\Encrypt;
use \Gluon\Model\User_mdl;
/**
 *  
 *  User
 *  handles user details and login, session 
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2016 
 *
 * */
class User
{
    /**
     * gets a session in the database
     * return string
     * */
    public static function get_session()
    {
        $ip = $this->getip();
        if(false === $ip)return false;
        $mdl = new User_mdl();
        return $mdl->get_session($ip);
    }
    /** 
     * updates a session in the database
     * @param string $u username 
     * return string
     * */
    public function update_session($u)
    {
        $ip = $this->getip();
        if(false === $ip)return false;
        $s = md5(strtotime('now').Encrypt::ps_make_salt(16));
        $mdl = new User_mdl();
        return $mdl->update_session($u,$ip,$s);
    }
    /**
     * destroys a session in the database
     * return string
     * */
    public function destroys_session($s)
    {
        $ip = $this->getip();
        if(false === $ip)return false;
        $mdl = new User_mdl();
        return $mdl->destroys_session($ip,$s);
    }
    /**
     * destroys old sessions in the database
     * return string
     * */
    public function destroyold_sessions($datetime = false)
    {
        if(false === $datetime) {
            $datetime = General::is_set($this->app['session_timeout']);
                if(false === $datetime)
                    $datetime = date('Y-m-d H:i:s',strtotime('-10 minutes'));
        }
        $mdl = new User_mdl();
        return $mdl->destroyold_sessions($datetime);
    }
    
    
    // private
    
    /**
     * gets the users ip if it is set
     * @return $ip
     * */
    private function getip()
    {
        $ip = General::is_set($_SERVER,'REMOTE_ADDR');
        if(false === $ip) {
            // set error
            $this->classes['error']->set_error_message($this->messages['error']['session']['noip']);
            return false;
        }
        return $ip;
    }
}