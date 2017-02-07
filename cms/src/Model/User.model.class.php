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
class User_mdl
{
    private $db;
    
    function __construct() {
        $this->db = Core::get('db');
    }
    function create_session($u,$ip,$s)
    {
        $sql = "UPDATE `users` SET `session` = :session AND `ip` = :ip WHERE `username` = :username";
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
}