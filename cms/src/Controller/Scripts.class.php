<?php
namespace Gluon\Controller;
use Gluon\View\Render;
/**
 *  
 *  scripts
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright � 2017 
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
        $p = file_get_contents(ROOT.$p);
        Render::_script($p,'text/javascript');
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
        $p = file_get_contents(ROOT.$p);
        Render::_script($p,'text/css');
    }
}