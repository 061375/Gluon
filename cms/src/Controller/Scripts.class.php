<?php
namespace Gluon\Controller;;
class scripts {
    function js($s)
    {
        echo '<pre>';print_r($s );exit();/*REMOVE ME*/
        \Gluon\View\Render::_script($s,'text/javascript');
    }
}