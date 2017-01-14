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
		$GET = gl_General::cleanSuperGlobal($_GET,'clean_get');
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
			    $elem[$key] =gl_General::cleanSuperGlobal($value); 
	    return $elem; 
    } 
    /**
     *
     *  */
    public static function post_variable($key,$else='',$bool=false,$die=false,$redirect='',$message='')
    {
		$POST = gl_General::cleanSuperGlobal($_POST,'clean_post');
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
					gl_General::Location($redirect);
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
        $return = gl_General::get_variable($var,'');
        if($return == '')
        {
            return gl_General::post_variable($var,$else);
        }
        return $return;
    }
    /**
     *
     *  */
	public static function get_request($key,$else=''){
		$REQUEST = gl_General::cleanSuperGlobal($_REQUEST,'clean_request');
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
    public static function is_set($variable,$else = ''){
        return isset($variable) ? $variable : $else;
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
        $current_date = date('Y-m-d H:i:s'); //current date
        $diff = strtotime($current_date) - strtotime($date_from);
        $months = floor(floatval($diff) / (60 * 60 * 24 * 365 / 12));
        return $months;
    }
    /**
     *
     *  */
    public static function checkDateFormat($date) {
        if(preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $date)){
            return true;
        }else{
            return false;
        }
    }
    /**
     *
     *  */
    public function simpleObjectToArray($obj = null) {
        if(empty($obj))return;
        $arrObj = is_object($obj) ? get_object_vars($obj) : $obj;
        $arr = array();
        foreach ($arrObj as $key => $val) {
                $val = (is_array($val) || is_object($val)) ? gl_General::simpleObjectToArray($val) : $val;
                $arr[$key] = $val;
        }
        return $arr;
    }
	public static function compare_version()
	{
		
	}
}