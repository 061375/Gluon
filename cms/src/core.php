<?php
namespace Gluon;

class Core {
    public static function install()
    {
        // init classes
        require_once('src/View/Render.class.php');
        require_once('src/Libraries/gl_Cache.class.php');
        require_once('src/Libraries/gl_ErrorHandler.class.php');
        require_once('src/Libraries/gl_General.class.php');
        $error = new \Libraries\gl_ErrorHandler;
        $cache = new \Libraries\gl_Cache($error);
        
        $install_template = \Libraries\gl_Cache::get_cache_byfile('admintheme.admin.yml.php',array('install.html.php'));
        
        \View\Render::_echo($install_template,array('page.title'=>'Welcome to Gluon!'));
    }
}