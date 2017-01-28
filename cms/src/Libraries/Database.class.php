<?php
namespace Gluon\Libraries;
use \Gluon\Libraries\Cache;
/**
 *  
 *  Database
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class Database
{
    public static function connect()
    {
        $params = Cache::get_cache_byfile('database.yml.php');
        $conn = array($params['param']['dsn'],$params['param']['username'],$params['param']['password']);
        $db = new $params['class'](new \Gluon\Libraries\ErrorHandler(),array(),false,0);
        $db->connect($conn);
        return $db;
    }
}