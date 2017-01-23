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
}