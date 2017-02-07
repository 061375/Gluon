<?php
namespace Gluon\Controller;
use Gluon\Libraries\Cache;
use Gluon\Libraries\Ajax;
use Gluon\Libraries\User;
use Gluon\View\Render;
/**
 *  
 *  Admin
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class admin {
    
    private $ajax;
    
    function __construct() {
        $this->ajax = new Ajax();    
    }
    /**
     * @param array
     * @return void
     * */
    function index($a)
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('admin.html.php'));
        Render::_echo($install_template,array('page.title'=>'Welcome to Gluon Admin!'));
    }
    function login($a) {
        
    }
    function logout($a) {
        
    }
    function pages($a)
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('pages.html.php'));
        Render::_echo($install_template,array('page.title'=>'Pages - Gluon'));
    }
    function blog($a)
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('blog.html.php'));
        Render::_echo($install_template,array('page.title'=>'Blog - Gluon'));
    }
    function plugins($a)
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('plugins.html.php'));
        Render::_echo($install_template,array('page.title'=>'Plugins - Gluon'));
    }
    function themes($a)
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('themes.html.php'));
        Render::_echo($install_template,array('page.title'=>'Themes - Gluon'));
    }
    function settings($a)
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('settings.html.php'));
        Render::_echo($install_template,array('page.title'=>'Settings - Gluon'));
    }
    function updates($a)
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('updates.html.php'));
        Render::_echo($install_template,array('page.title'=>'Updates - Gluon'));
    }
    
    
    /**
     * Ajax
     * */
    function test()
    {
        if(false === $this->ajax->validate('')) {
            return false;
        }
        //if(false === defined('ISAJAX'))die();
        //echo '<p>Got Here</p>';
    }
}