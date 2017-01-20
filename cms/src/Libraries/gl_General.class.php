<?php
namespace Libraries;
class gl_General
{
    public static function get_variable($key,$else='')
    {
        if(false == defined("GET_STRING")){
            parse_str(($_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : ''), $_GET);
            define("GET_STRING",true);
        }
		$GET = self::cleanSuperGlobal($_GET,'clean_get');
        return isset($GET[$key]) ? $GET[$key] : $else;
    }
	/**
     *
     *  */
    public static function cleanSuperGlobal($elem,$globalkey='') {
	    if(isset($GLOBALS[$globalkey]))return $GLOBALS[$globalkey];
	    if(false == is_array($elem)) 
		    $elem = htmlentities($elem,ENT_QUOTES,"UTF-8"); 
	    else 
		    foreach ($elem as $key => $value) 
			    $elem[$key] =self::cleanSuperGlobal($value); 
	    return $elem; 
    } 
    /**
     *
     *  */
    public static function post_variable($key,$else='',$bool=false,$die=false,$redirect='',$message='')
    {
	$POST = self::cleanSuperGlobal($_POST,'clean_post');
        if($bool == false){
            $return = isset($POST[$key]) ? $POST[$key] : $else;
        }else{
            $return = isset($POST[$key]) ? 1 : 0;
        }
        if($return == '')
        {
            if($die == false){
                return $return;
            }else{
				if($redirect == ''){
					die($message);
				}else{
					self::Location($redirect);
				}
            }
        }
        return $return;
    }
    /**
     *
     *  */
    public static function get_query($var,$else='')
    {
        $return = self::get_variable($var,'');
        if($return == '')
        {
            return self::post_variable($var,$else);
        }
        return $return;
    }
    /**
     *
     *  */
    public static function get_request($key,$else=''){
	$REQUEST = self::cleanSuperGlobal($_REQUEST,'clean_request');
        return isset($REQUEST[$key]) ? $REQUEST[$key] : $else;
    }
    /**
     *
     *  */
    public static function getFunctionParam($array,$key,$default=''){
        return isset($array[$key]) ? $array[$key] : $default;
    }
    /**
     *
     *  */
    public static function is_set($array,$key,$default=''){
        return isset($array[$key]) ? $array[$key] : $default;
    }
    /**
     *
     *  */
    public static function is_defined($variable,$else = ''){
        return defined($variable) ? $variable : $else;
    }
    /**
     *
     *  */
    public static function get_session($key,$else=''){
        if (session_id() === '' && headers_sent() == false)session_start();
		if(is_array($key) == false){
			return isset($_SESSION[$key]) ? $_SESSION[$key] : $else;
		}else{
			switch(count($key)){
				case 2:
					return isset($_SESSION[$key[0]][$key[1]]) ? $_SESSION[$key[0]][$key[1]] : $else;
				break;
				case 3:
					return isset($_SESSION[$key[0]][$key[1]][$key[2]]) ? $_SESSION[$key[0]][$key[1]][$key[2]] : $else;
				break;
				case 4:
					return isset($_SESSION[$key[0]][$key[1]][$key[2]][$key[3]]) ? $_SESSION[$key[0]][$key[1]][$key[2]][$key[3]] : $else;
				break;
				default:
				return $else;
			}
		}
    }
    /**
     *
     *  */
    public static function set_session($key,$value) {
        if (session_id() == '' && headers_sent() == false)session_start();
		if(is_array($key) == false){
			$_SESSION[$key] = $value;
		}else{
			switch(count($key))
			{
				case 2:
					$_SESSION[$key[0]][$key[1]] = $value;
				break;
				case 3:
					$_SESSION[$key[0]][$key[1]][$key[2]] = $value;
				break;
				case 4:
					$_SESSION[$key[0]][$key[1]][$key[2]][$key[3]] = $value;
				break;
			}
		}
    }
    /**
     *	
     *  */
    public static function dateToMonthsCount($date_from) {
        $current_date = date('Y-m-d H:i:s',strtotime('now')); //current date
        $diff = strtotime($current_date) - strtotime($date_from);
        $months = floor(floatval($diff) / (60 * 60 * 24 * 365 / 12));
        return $months;
    }
    /**
     * returns true if date is format Y/m/d
     * @param string
     * return bool
     *  */
    public static function checkDateFormat($date) {
        if(preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $date)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * converts an object into a simple array
     * @param object $obj
     * return array $arr
     *  */
    public function simpleObjectToArray($obj = null) {
        if(empty($obj))return;
        $arrObj = is_object($obj) ? get_object_vars($obj) : $obj;
        $arr = array();
        foreach ($arrObj as $key => $val) {
                $val = (is_array($val) || is_object($val)) ? self::simpleObjectToArray($val) : $val;
                $arr[$key] = $val;
        }
        return $arr;
    }
    /**
     * creates a message from the message.yml file
     * @param string
     * @param array
     * @return string
     * */
    public static function message($level,$keys,$sprint)
    {
	$return = 'Gluon '.ucfirst($level).': ';
	$return .= \Libraries\gl_Cache::get_cache_byfile('messages.yml.php',$keys);
	foreach($sprint as $k => $v) {
		$return = str_replace('[#'.$k.'#]',$v,$return);
	}
	return $return."\n";
    }
    /**
     * recurse_array_get
     * @param array $array
     * @param $keys - the path to the array key of interest
     * 	      example: to find $array['a']['b']['c'] use: recurse_array_get($array,array('a','b','c'));
     * @param string $default
     * @return mixed (array, bool)
     * */
    public static function recurse_array_get($array,$keys,$default = '')
    {
		//
		if(false == is_array($keys))
			return self::is_set($array,$keys,$default);

		$result = '';
		foreach($keys as $i => $key)
		{
			if(isset($array[$key])) {
				if(is_array($array[$key])) {
					$result = self::recurse_array_get($array[$key],$keys);
					if(!is_array($result)) {
						return $result;
					}
				}else{
					return $array[$key];
				}
			}
		}
		return $default;
    }
}