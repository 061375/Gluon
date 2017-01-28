<?php
namespace Gluon\Libraries;
use \Gluon\Libraries\Encrypt;
use \Gluon\Model\User;
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
    public static function create_session()
    {
        $s = strtotime('now').Encrypt::ps_make_salt(16);
        
    }
}