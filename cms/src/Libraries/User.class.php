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
    public static function check_credentials($username,$password)
    {
        $mdl = new User_mdl();
        $e = new Encrypt();
        $password = $e->encrypt($password);
        $result = $mdl->get_user($username);
        $result = isset($result[0]) ? $result[0] : false;
        if(false === $result) {
            // set error
            return false;
        }
        $password = $e->decrypt($password);
        $result['password'] = $e->decrypt($result['password']);
        if($result['username'] != $username) {
            // set error
            return false;
        }
        if($result['password'] != $password) {
            // set error
            return false;
        }
        unset($result['password']);
    
        return $result;
    }
    
    
    /**
     * gets a session in the database
     * return string
     * */
    public static function get_user($username)
    {
        $mdl = new User_mdl();
        $return = $mdl->get_user($username);
        return isset($return[0]) ? $return[0] : false;
    }
    /**
     * gets a session in the database
     * return string
     * */
    public static function get_session()
    {
        $ip = self::getip();
        if(false === $ip)return false;
        $mdl = new User_mdl();
        return $mdl->get_session($ip);
    }
    /** 
     * updates a session in the database
     * @param string $u username 
     * return string
     * */
    public function update_session($u,$new = false)
    {
        $ip = self::getip();
        if(false === $ip)return false;
        $mdl = new User_mdl();
        if(true === $new) {
            $s = md5(strtotime('now').Encrypt::ps_make_salt(16));
            return $mdl->create_session($u,$ip,$s);
        }else{
            return $mdl->update_session($u,$ip);
        }
    }
    /**
     * destroys a session in the database
     * return string
     * */
    public function destroy_session($u)
    {
        $ip = self::getip();
        if(false === $ip)return false;
        $mdl = new User_mdl();
        return $mdl->destroy_session($u,$ip);
    }
    /**
     * destroys old sessions in the database
     * return string
     * */
    public static function destroyold_sessions($datetime = false)
    {
        if(false === $datetime) {
            $datetime = General::recurse_array_get($GLOBALS,array('app','session_timeout'));
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
    public static function getip()
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