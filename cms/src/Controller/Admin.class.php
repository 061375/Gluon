<?php
namespace Gluon\Controller;
class admin {
    function index($a)
    {
        $install_template = \Gluon\Libraries\Cache::get_cache_byfile('admintheme.admin.yml.php',array('admin.html.php'));
        \Gluon\View\Render::_echo($install_template,array('page.title'=>'Welcome to Gluon Admin!'));
    }
}