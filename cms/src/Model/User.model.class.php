<?php
namespace Gluon\Model;
/**
 *  
 *  User
 *  handles user details and login, session 
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
use \Gluon\Core;
use \Gluon\Libraries\General;
class User_mdl extends Core
{
    /**
     * @param object
     * */
    private $db;
    
    function __construct() {
        $this->db = $GLOBALS['db'];
    }
    /**
     * create a session
     * @param string $u username
     * @param string $ip
     * @param string $s session hash
     * @return
     * */
    function create_session($u,$ip,$s)
    {
        $sql = "UPDATE `users` SET `session` = :session, `ip` = :ip WHERE `username` = :username";
        $result = $this->db->Query($sql,array(
            'username'=>$u,
            'ip'=>$ip,
            'session'=>$s
        ));
        if(false !== $result) {
            return $s;
        }
        return false;    
    }
    /**
     * update the session
     * @param string $u
     * @param string $ip
     * @return mixed
     * */
    function update_session($u,$ip)
    {
        $sql = "UPDATE `users` SET `date_modified` = '".date('Y-m-d H:i:s',strtotime('now'))."'
                WHERE `username` = :username AND `ip` = :ip";
        $result = $this->db->Query($sql,array(
            'username'=>$u,
            'ip'=>$ip
        ));
        if(false !== $result) {
            return $s;
        }
        return false;    
    }
    /**
     * get the session
     * @param string $ip
     * @return array
     * */
    function get_session($ip)
    {
        $sql = "SELECT `username`,`usernice`,`permissions`,`date_created` FROM `users` WHERE `ip` = :ip";
        $result = $this->db->Query($sql,array(
            'ip'=>$ip
        ),array('FetchAssoc'));
        return General::is_set($result,'FetchAssoc');    
    }
    /**
     * get credentials
     * @param string $username
     * @param string $password
     * @return array
     * */
    function get_username($username)
    {
        $sql = "SELECT `username`,`usernice`,`permissions`,`password`,`date_created` FROM `users`
                WHERE `username` = :username";
        $result = $this->db->Query($sql,array(
            'username'=>$username
        ),array('FetchAssoc'));
        return General::is_set($result,'FetchAssoc');    
        
    }
    /**
     * destroy session
     * @param string $u
     * @param string $ip
     * @return boo
     * */
    function destroy_session($u,$ip)
    {
        $sql = "UPDATE `users` SET `session` = ''
                WHERE `username` = :username OR `ip` = :ip";
        $result = $this->db->Query($sql,array(
            'username'=>$u,
            'ip'=>$ip
        ),array('RowsAffected'));
        if($result['RowsAffected'] < 1)return true;
        return false; 
    }
    function destroyold_sessions()
    {
        return true;
    }
}