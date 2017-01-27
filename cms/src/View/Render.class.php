<?php
namespace Gluon\View;
/**
 *  
 *  Render
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class Render
{
    /**
     * @param string $t the template
     * @param array values to be replaced with the template
     * @return void
     * */
    public static function _echo($t,$array) {
        $t = stripslashes($t);
        foreach($array as $key => $value) {
            $t = str_replace('[#'.$key.'#]',$value,$t);
        }
        die($t);
    }
    /**
     * renders a script file with MIME-TYPE header
     * @param string $s
     * @param string $mime a mime type ex 'text/css'
     * @return void
     * */
    public static function _script($s,$mime) {
        header($mime);
        die($s);
    }
    /**
     * renders as JSON with MIME-TYPE header
     * @param string $s
     * @return void
     * */
    public static function ajax($r) {
        header('application/json');
        $result = array(
                'success' => 1,
                'message' => $r
        );
        echo json_encode($result);
        die();
    }
}