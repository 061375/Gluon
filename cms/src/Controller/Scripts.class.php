<?php
namespace Gluon\Controller;
use Gluon\View\Render;
/**
 *  
 *  scripts
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class scripts {
    /**
     * @param array
     * @return void
     * */
    function js($scr)
    {
        $p = '';
        foreach($scr as $k => $s) {
            if($k < 2)continue;
            $p .= '/'.$s;
        }
        $p = @file_get_contents(ROOT.$p);
        if(false === $p){
            $m = "HTTP/1.0 404 Not Found";
        }else{
            $m = 'text/javascript';
        }
        Render::_script($p,$m);
    }
    /**
     * @param array
     * @return void
     * */
    function css($scr)
    {
        $p = '';
        foreach($scr as $k => $s) {
            if($k < 2)continue;
            $p .= '/'.$s;
        }
        $p = @file_get_contents(ROOT.$p);
        if(false === $p){
            $m = "HTTP/1.0 404 Not Found";
        }else{
            $m = 'text/css';
        }
        Render::_script($p,$m);
    }
}